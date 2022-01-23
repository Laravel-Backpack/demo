<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
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
        'story_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function monster()
    {
        return $this->hasOne(\App\Models\Monster::class);
    }

    public function stories()
    {
        return $this->belongsToMany(\App\Models\Story::class, 'monsters')
                    ->withPivot((new \App\Models\Monster())->getFillable());
    }
}
