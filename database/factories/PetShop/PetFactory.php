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

    protected $petNames = ['Juliet', 'Rose', 'Belle', 'Nicky', 'Stella', 'Bepi', 'Trix', 'Susy', 'Rex', 'Black', 'Chip', 'Charlie', 'Kobe', 'Alf', 'Arlo', 'Ben', 'Snowflake', 'Curly', 'Rover', 'Slick', 'Yoda', 'Yogi', 'Bosco', 'Lucky', 'Snoopy', 'Bud', 'Zeus', 'Tyson', 'Booster', 'Blanche', 'Lady', 'Lexie', 'Tess', 'Dusty', 'Duffy', 'Cupcake', 'Clover', 'Dakota', 'Bullet', 'Foxy', 'Freckles', 'Giant', 'Gracie', 'Fuzzy', 'Fritz', 'Furball', 'Garfield', 'Flint', 'Fifi', 'Nosy', 'Mack', 'Magic', 'Napoleon', 'Muffin', 'Shorty', 'Scooter', 'Shadow', 'Simba', 'Rusty', 'Roscoe', 'Rolex', 'Ringo', 'Rico', 'Rex', 'Rags', 'Turbo', 'Tux', 'Ying', 'Yang', 'Violet', 'Teddy', 'T-bone', 'T-bird', 'Stuart', 'Spike', 'Troy', 'Whitie'];

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
