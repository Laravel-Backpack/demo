<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use CrudTrait;
    use HasTranslations;
    use HasFactory;
    use InteractsWithMedia;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'description', 'details', 'features', 'price', 'category_id', 'extras', 'status', 'condition', 'main_image', 'secondary_image', 'specifications', 'image_drm', 'gallery'];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['name', 'description', 'details', 'features', 'extras'];
    public $casts = [
        'features'       => 'object',
        'extra_features' => 'object',
        'status'         => ProductStatus::class,
    ];

    public static function boot()
    {
        parent::boot();
        // since we don't have this fields in the model, we remove them before saving.
        static::saving(function ($model) {
            unset($model->attributes['secondary_image']);
            unset($model->attributes['specifications']);

            unset($model->attributeCastCache['image_drm']);
            unset($model->attributes['image_drm']);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function secondaryImage(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value, $attributes) {
                $image = $this->getFirstMedia('product_images', function ($media) { return $media->name === 'secondary_image'; });

                return $image ? $image->getUrl() : null;
            },
            set: function ($value) {
                $previousImage = $this->getFirstMedia('product_images', function ($media) {
                    return $media->name === 'secondary_image';
                });

                if ($value) {
                    if ($previousImage && \Str::startsWith($value, 'data:image')) {
                        $previousImage->delete();
                    }
                    if (\Str::startsWith($value, 'data:image')) {
                        $extension = '.'.\Str::after(mime_content_type($value), '/');
                        $this
                            ->addMediaFromBase64($value)
                            ->usingName('secondary_image')
                            ->usingFileName('secondary_image'.$extension)
                            ->toMediaCollection('product_images', 'products');
                    }

                    return;
                }

                if ($previousImage) {
                    $previousImage->delete();
                }
            }
        );
    }

    public function mainImage(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function () {
                $image = $this->getFirstMedia('product_images', function ($media) { return $media->name === 'main_image'; });

                return $image ? $image->getUrl() : null;
            },
            set: function ($value) {
                $previousImage = $this->getFirstMedia('product_images', function ($media) {
                    return $media->name === 'main_image';
                });

                if ($value) {
                    if ($previousImage && \Str::startsWith($value, 'data:image')) {
                        $previousImage->delete();
                    }
                    if (\Str::startsWith($value, 'data:image')) {
                        $extension = '.'.\Str::after(mime_content_type($value), '/');
                        $uploadedMedia = $this
                            ->addMediaFromBase64($value)
                            ->usingName('main_image')
                            ->usingFileName('main_image'.$extension)
                            ->toMediaCollection('product_images', 'products');
                    }

                    return $uploadedMedia->id ?? $previousImage->id;
                }

                if ($previousImage) {
                    $previousImage->delete();
                }
            }
        );
    }

    public function specifications(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function () {
                return $this
                    ->getMedia('product_documents', function ($media) { return $media->name === 'specification_document'; })
                    ->map(function ($media) {
                        return \Str::after($media->getUrl(), \Storage::disk('products')->url(''));
                    })
                    ->toArray();
            },
            set: function ($value) {
                $filesToDelete = request()->get('clear_specifications');

                $previousImages = $this->getMedia('product_documents', function ($media) {
                    return $media->name === 'specification_document';
                });

                if ($filesToDelete) {
                    foreach ($previousImages as $previousImage) {
                        $storageBasePath = \Storage::disk('products')->url('');
                        if (in_array(\Str::after($previousImage->getUrl(), $storageBasePath), $filesToDelete)) {
                            $previousImage->delete();
                        }
                    }
                }

                foreach ($value ?? [] as $file) {
                    if (is_file($file)) {
                        $this
                            ->addMedia($file)
                            ->usingName('specification_document')
                            ->toMediaCollection('product_documents', 'products');
                    }
                }
            }
        );
    }

    public function imageDrm(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function () {
                $drm = $this->getFirstMedia('product_documents', function ($media) { return $media->name === 'image_drm'; });

                return !empty($drm) ? $drm->getUrl() : null;
            },
            set: function ($value) {
                $previousDocument = $this->getFirstMedia('product_documents', function ($media) { return $media->name === 'image_drm'; });

                if ($previousDocument && (!$value || is_file($value))) {
                    $previousDocument->delete();
                }

                if (is_file($value)) {
                    $this
                    ->addMedia($value)
                    ->usingName('image_drm')
                    ->toMediaCollection('product_documents', 'products');
                }
            },
        );
    }

    public function gallery(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value) {
                $galleryImages = $this
                                    ->getMedia('product_images', function ($media) { return $media->name === 'gallery_image'; })
                                    ->transform(function ($media, $key) {
                                        $origin = substr(\Storage::disk('products')->url('/'), 0, -1);

                                        return ['image' => str_replace($origin, '', $media->getUrl()), 'repeatableRow' => $media->getCustomProperty('repeatableRow')];
                                    })->sortBy('repeatableRow')->keyBy('repeatableRow')->toArray();

                $value = json_decode($value, true) ?? [];

                return array_merge_recursive_distinct($value, $galleryImages);
            },
            set: function ($value) {
                $galleryImages = $this->getMedia('product_images', function ($media) { return $media->name === 'gallery_image'; });

                $sentImages = collect($value)
                                ->pluck('image')
                                ->map(function ($image) {
                                    if (!\Str::startsWith($image, 'data:image')) {
                                        return \Str::afterLast(\Str::beforeLast($image, '/'), '/').'/'.\Str::afterLast($image, '/');
                                    }

                                    return $image;
                                })
                                ->toArray();

                foreach ($sentImages as $row => $image) {
                    if (is_string($image)) {
                        if (\Str::startsWith($image, 'data:image')) {
                            $extension = '.'.\Str::after(mime_content_type($image), '/');
                            $this
                                ->addMediaFromBase64($image)
                                ->usingName('gallery_image')
                                ->usingFileName(\Str::random().$extension)
                                ->withCustomProperties(['repeatableRow' => $row])
                                ->preservingOriginal()
                                ->toMediaCollection('product_images', 'products');

                            unset($value[$row]['image']);
                            continue;
                        }
                        $currentImageGallery = $galleryImages->where('id', \Str::before($image, '/'))->where('file_name', \Str::after($image, '/'))->first();
                        if ($currentImageGallery) {
                            if ($currentImageGallery->getCustomProperty('repeatableRow') !== $row) {
                                $currentImageGallery->setCustomProperty('repeatableRow', $row);
                                $currentImageGallery->save();
                            }
                            unset($value[$row]['image']);
                        }
                    }
                }

                foreach ($galleryImages as $media) {
                    $mediaIdentifier = $media->id.'/'.$media->file_name;
                    if (!in_array($mediaIdentifier, $sentImages)) {
                        $media->delete();
                    }
                }

                return json_encode($value);
            },
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'category_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
