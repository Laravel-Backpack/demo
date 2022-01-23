<?php

namespace App\Models\PetShop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function owners()
    {
        return $this->belongsToMany(\App\Models\PetShop\Owner::class)->withPivot('role');
    }

    public function skills()
    {
        return $this->belongsToMany(\App\Models\PetShop\Skill::class);
    }

    public function passport()
    {
        return $this->hasOne(\App\Models\PetShop\Passport::class);
    }

    public function avatar()
    {
        return $this->morphOne(\App\Models\PetShop\Avatar::class, 'avatarable');
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\PetShop\Comment::class, 'commentable');
    }

    public function badges()
    {
        return $this->morphToMany(\App\Models\PetShop\Badge::class, 'badgeable')->withPivot('note');
    }
}
