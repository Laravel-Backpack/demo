<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tests';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['address', 'base64_image', 'browse', 'checkbox', 'wysiwyg', 'color', 'color_picker', 'date', 'date_picker', 'start_date', 'end_date', 'datetime', 'datetime_picker', 'email', 'hidden', 'icon_picker', 'image', 'month', 'number', 'float', 'password', 'radio', 'range', 'select', 'select_from_array', 'select2', 'select2_from_ajax', 'select2_from_array', 'simplemde', 'summernote', 'table', 'textarea', 'text', 'tinymce', 'upload', 'upload_multiple', 'url', 'video', 'week', 'extras'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'address' => 'array',
    ];

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

    public function article()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Article', 'select2_from_ajax');
    }

    public function articles()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Article', 'test_article');
    }

    public function category()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'select');
    }

    public function categories()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Category', 'test_category');
    }

    public function tags()
    {
        return $this->belongsToMany('Backpack\NewsCRUD\app\Models\Tag', 'test_tag');
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
