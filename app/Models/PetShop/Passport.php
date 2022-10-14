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
        'lat',
        'lng',
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

    protected function location(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => json_encode(['lat' => $attributes['lat'] ?? '', 'lng' => $attributes['lng'] ?? '', 'formatted_address' => $attributes['full_address'] ?? ''], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR),
            set: function ($value) {
                $location = json_decode($value);

                return [
                    'lat'          => $location->lat ?? '',
                    'lng'          => $location->lng ?? '',
                    'full_address' => $location->formatted_address ?? '',
                ];
            }
        );
    }
}
