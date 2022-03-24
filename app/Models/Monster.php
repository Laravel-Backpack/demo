<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Monster extends Model
{
    use CrudTrait;
    use HasRoles;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'monsters';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['address_algolia', 'base64_image', 'browse', 'browse_multiple', 'checkbox', 'wysiwyg', 'color', 'color_picker', 'date', 'date_picker', 'easymde', 'start_date', 'end_date', 'datetime', 'datetime_picker', 'email', 'hidden', 'icon_picker', 'image', 'month', 'number', 'float', 'password', 'radio', 'range', 'select', 'select_from_array', 'select2', 'select2_from_ajax', 'select2_from_array', 'summernote', 'table', 'textarea', 'text', 'tinymce', 'upload', 'upload_multiple', 'url', 'video', 'week', 'extras', 'icon_id'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'address_algolia'       => 'object',
        'video'                 => 'array',
        'upload_multiple'       => 'array',
        'browse_multiple'       => 'array',
        // optional casts for select from array fields that allow multiple selection
        // 'select_from_array'     => 'array',
        // 'select2_from_array'    => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-search"></i> Google it</a>';
    }

    public function getCategory()
    {
        return $this->category;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function article()
    {
        return $this->belongsTo(\Backpack\NewsCRUD\app\Models\Article::class, 'select2_from_ajax');
    }

    public function wish()
    {
        return $this->hasOne(\App\Models\Wish::class);
    }

    public function address()
    {
        return $this->hasOne(\App\Models\Address::class);
    }

    public function cave()
    {
        return $this->belongsTo(\App\Models\Cave::class, 'cave_id');
    }

    public function hero()
    {
        return $this->belongsTo(\App\Models\Hero::class, 'hero_id');
    }

    public function story()
    {
        return $this->belongsTo(\App\Models\Story::class, 'story_id');
    }

    public function graffiti()
    {
        return $this->belongsTo(\App\Models\Graffiti::class, 'graffiti_id');
    }

    public function category()
    {
        return $this->belongsTo(\Backpack\NewsCRUD\app\Models\Category::class, 'select');
    }

    public function categorySelect2()
    {
        return $this->belongsTo(\Backpack\NewsCRUD\app\Models\Category::class, 'select2');
    }

    public function icon()
    {
        return $this->belongsTo(\App\Models\Icon::class, 'icon_id');
    }

    public function icondummy()
    {
        return $this->belongsTo(\App\Models\Icon::class, 'belongs_to_non_nullable');
    }

    public function postalboxes()
    {
        return $this->hasMany(\App\Models\PostalBox::class);
    }

    public function postalboxer()
    {
        return $this->hasMany(\App\Models\PostalBoxer::class);
    }

    public function articles()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Article::class, 'monster_article');
    }

    public function categories()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Category::class, 'monster_category');
    }

    public function tags()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Tag::class, 'monster_tag');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'monster_product');
    }

    public function dummyproducts()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'monster_productdummy')->withPivot('notes');
    }

    public function countries()
    {
        return $this->belongsToMany(\App\Models\Country::class, 'countries_monsters');
    }

    public function sentiment()
    {
        return $this->morphOne(\App\Models\Sentiment::class, 'sentimentable');
    }

    public function ball()
    {
        return $this->morphOne(\App\Models\Ball::class, 'ballable');
    }

    public function recommends()
    {
        return $this->morphToMany(\App\Models\Recommend::class, 'recommendable')->withPivot('text');
    }

    public function bills()
    {
        return $this->morphToMany(\App\Models\Bill::class, 'billable');
    }

    public function stars()
    {
        return $this->morphMany(\App\Models\Star::class, 'starable');
    }

    public function universes()
    {
        return $this->morphMany(\App\Models\Universe::class, 'universable');
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

    public function getTextAndEmailAttribute()
    {
        return $this->text.' '.$this->email;
    }

    /**
     * Because we don't trust that the 'easymde' db column does not already
     * have some JS or HTML stored inside it, we will run strip_tags() on
     * the value before it's ever used (both in Backpack and in the app).
     */
    public function getEasymdeAttribute($value)
    {
        return strip_tags($value);
    }

    /**
     * Because we don't trust that the 'summernote' db column does not already
     * have some JS stored inside the HTML, we will sanitize the output using
     * https://github.com/mewebstudio/Purifier.
     */
    public function getSummernoteAttribute($value)
    {
        return clean($value);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setBase64ImageAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the base64 images don\'t get stored.');

            return true;
        }

        $this->attributes['base64_image'] = $value;
    }

    public function setImageAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the images don\'t get uploaded.')->flash();

            return true;
        }

        $attribute_name = 'image';
        $disk = 'public'; // use Backpack's root disk; or your own
        $destination_path = 'uploads/monsters/image_field';

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setUploadAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the files don\'t get uploaded.');

            return true;
        }

        $attribute_name = 'upload';
        $disk = 'public';
        $destination_path = 'uploads/monsters/upload_field';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function setUploadMultipleAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the files don\'t get uploaded.')->flash();

            return true;
        }

        $attribute_name = 'upload_multiple';
        $disk = 'public';
        $destination_path = 'uploads/monsters/upload_multiple_field';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
