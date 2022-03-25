<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function monsters()
    {
        return $this->hasMany(\App\Models\Monster::class);
    }

    public function heroes()
    {
        return $this->belongsToMany(\App\Models\Hero::class, 'monsters')
                    ->withPivot((new \App\Models\Monster())->getFillable());
    }
}
