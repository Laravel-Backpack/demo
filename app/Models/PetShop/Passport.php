<?php

namespace App\Models\PetShop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pet_id',
        'number',
        'issuance_date',
        'expiry_date',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'species',
        'breed',
        'colour',
        'notes',
        'country',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'pet_id'        => 'integer',
        'issuance_date' => 'date',
        'expiry_date'   => 'date',
        'birth_date'    => 'date',
    ];

    public function pet()
    {
        return $this->belongsTo(\App\Models\PetShop\Pet::class, 'pet_id');
    }
}
