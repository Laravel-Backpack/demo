<?php

namespace Database\Factories;

use App\Models\Recommend;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recommend::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ucfirst($this->faker->unique()->words(rand(1, 3), true));

        return [
            'title' => $title,
        ];
    }
}
