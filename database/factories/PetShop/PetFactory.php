<?php

namespace Database\Factories\PetShop;

use App\Models\PetShop\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    protected $petNames = ['Juliet', 'Rose', 'Belle', 'Nicky', 'Stella', 'Bepi', 'Trix', 'Susy', 'Rex', 'Black', 'Chip', 'Charlie', 'Kobe', 'Alf', 'Arlo', 'Ben'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nickname' => Arr::random($this->petNames),
        ];
    }
}
