<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
        'address'    => 'array',
        'table'      => 'object',
        'fake_table' => 'object',
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
}
