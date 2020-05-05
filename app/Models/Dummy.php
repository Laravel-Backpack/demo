<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Dummy extends Model
{
    use CrudTrait;
    use HasRoles;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'dummies';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'extras' => 'array',
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
        return $this->belongsTo(\Backpack\NewsCRUD\app\Models\Article::class, 'select2_from_ajax');
    }

    public function category()
    {
        return $this->belongsTo(\Backpack\NewsCRUD\app\Models\Category::class, 'select');
    }

    public function categories()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Category::class, 'monster_category', 'monster_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Tag::class, 'monster_tag', 'monster_id', 'category_id');
    }

    public function icon()
    {
        return $this->belongsTo(\App\Models\Icon::class, 'icon_id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'monster_product', 'monster_id', 'product_id');
    }

    public function articles()
    {
        return $this->belongsToMany(\Backpack\NewsCRUD\app\Models\Article::class, 'monster_article', 'monster_id', 'article_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
