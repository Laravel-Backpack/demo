<?php

namespace Database\Factories;

use App\Models\Cave;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cave::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
