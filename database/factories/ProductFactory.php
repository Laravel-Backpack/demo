<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => ucfirst($this->faker->unique()->sentence()),
            'description' => $this->faker->text(50),
            'details'     => $this->faker->text(800),
            'price'       => random_int(10, 1000),
            'category_id' => function () {
                if (rand(1, 100) % 50 == 0) {
                    return Category::factory()->create()->id;
                } else {
                    return Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id;
                }
            },
            'extras' => [
                'en' => [
                    'meta_title'       => $this->faker->sentence(),
                    'meta_keywords'    => implode(', ', $this->faker->words(5)),
                    'extra_features'   => null,
                    'meta_description' => $this->faker->sentence(),
                ],
            ],
            'gallery'    => [],
            'features'   => null,
        ];
    }
}
