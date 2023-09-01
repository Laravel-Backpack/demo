<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cave extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location', 'lat', 'lng', 'full_address',
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

    protected function location(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value, $attributes) {
                return json_encode([
                    'lat'               => $attributes['lat'],
                    'lng'               => $attributes['lng'],
                    'formatted_address' => $attributes['full_address'] ?? '',
                ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR);
            },
            set: function ($value) {
                $location = json_decode($value);

                return [
                    'lat'          => $location->lat,
                    'lng'          => $location->lng,
                    'full_address' => $location->formatted_address ?? '',
                ];
            }
        );
    }
}
