<?php

namespace App\Models\PetShop;

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
        return $this->hasMany(\App\Models\PetShop\Invoice::class);
    }

    public function pets()
    {
        return $this->belongsToMany(\App\Models\PetShop\Pet::class)->withPivot('role');
    }

    public function avatar()
    {
        return $this->morphOne(\App\Models\PetShop\Avatar::class, 'avatarable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\PetShop\Comment::class, 'commentable', null, null, 'user_id');
    }

    public function badges()
    {
        return $this->morphToMany(\App\Models\PetShop\Badge::class, 'badgeable')->withPivot('note');
    }
}
