<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Models\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use CrudTrait;
    use LogsActivity;
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
    protected $fillable = ['name', 'description', 'details', 'features', 'price', 'category_id', 'extras', 'status', 'condition', 'gallery', 'main_image', 'privacy_policy', 'specifications'];

    // protected $hidden = [];
    public $translatable = ['name', 'description', 'details', 'features', 'extras'];

    public $casts = [
        'features'       => 'object',
        'extra_features' => 'object',
        'status'         => ProductStatus::class,
        'gallery'        => 'json',
        'specifications' => 'array',
    ];

    public function mainImage(): Attribute
    {
        return Attribute::make(
            set: function ($item) {
                if (app('env') === 'production') {
                    return null;
                }

                return $item;
            },
        );
    }

    public function privacyPolicy(): Attribute
    {
        return Attribute::make(
            set: function ($item) {
                if (app('env') === 'production') {
                    return null;
                }

                return $item;
            },
        );
    }

    public function specifications(): Attribute
    {
        return Attribute::make(
            set: function ($item) {
                if (app('env') === 'production') {
                    return null;
                }

                return json_encode($item);
            },
        );
    }

    public function gallery(): Attribute
    {
        return Attribute::make(
            set: function ($item) {
                if (app('env') === 'production') {
                    $item = is_string($item) ? json_decode($item, true) : ($item ?? []);
                    array_walk($item, function (&$row) {
                        unset($row['gallery_image'], $row['gallery_image_drm'], $row['gallery_image_specifications'], $row['gallery_image_certificates']);

                        return $row;
                    });
                }

                return json_encode($item);
            },
        );
    }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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
