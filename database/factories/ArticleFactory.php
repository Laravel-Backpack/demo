<?php

namespace Database\Factories;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 8),
            'title'       => ucfirst($this->faker->unique()->sentence()),
            'content'     => $this->faker->text(800),
            'status'      => $this->faker->randomElement(['PUBLISHED', 'DRAFT']),
            'date'        => $this->faker->date(),
            'featured'    => $this->faker->boolean(),
            'created_at'  => Carbon::now()->subDays(rand(0, 30)),
        ];
    }
}
