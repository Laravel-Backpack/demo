<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
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

    public function invoices()
    {
        return $this->hasMany(\App\Models\Invoice::class);
    }

    public function pets()
    {
        return $this->belongsToMany(\App\Models\Pet::class)->withPivot('role');
    }

    public function avatar()
    {
        return $this->morphOne(\App\Models\Avatar::class, 'avatarable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    public function badges()
    {
        return $this->morphToMany(\App\Models\Badge::class, 'badgeable')->withPivot('note');
    }
}
