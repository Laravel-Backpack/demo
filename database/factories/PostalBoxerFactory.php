<?php

namespace Database\Factories;

use App\Models\PostalBoxer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostalBoxerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostalBoxer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ucfirst($this->faker->unique()->words(rand(1, 3), true));

        return [
            'postal_name' => $title,
        ];
    }
}
