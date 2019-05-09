<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Monster extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'monsters';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['address', 'base64_image', 'browse', 'checkbox', 'wysiwyg', 'color', 'color_picker', 'date', 'date_picker', 'start_date', 'end_date', 'datetime', 'datetime_picker', 'email', 'hidden', 'icon_picker', 'image', 'month', 'number', 'float', 'password', 'radio', 'range', 'select', 'select_from_array', 'select2', 'select2_from_ajax', 'select2_from_array', 'simplemde', 'summernote', 'table', 'textarea', 'text', 'tinymce', 'upload', 'upload_multiple', 'url', 'video', 'week', 'extras'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'address' => 'array',
        'video'   => 'array',
        // optional casts for select from array fields that allow multiple selection
        // 'select_from_array' => 'array',
        // 'select2_from_array' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function openGoogle($crud = false)
    {
        return '<a class="btn btn-xs btn-default" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function article()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Article', 'select2_from_ajax');
    }

    public function articles()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Article', 'monster_article');
    }

    public function category()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'select');
    }

    public function categories()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Category', 'monster_category');
    }

    public function tags()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Tag', 'monster_tag');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = config('backpack.base.root_disk_name'); // use Backpack's root disk; or your own
        $destination_path = 'public/uploads/monster_images';

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }
}
