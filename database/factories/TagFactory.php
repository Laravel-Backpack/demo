<?php

namespace Database\Factories;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => ucfirst($this->faker->unique()->word),
            'created_at' => Carbon::now()->subDays(rand(0, 30)),
        ];
    }
}
