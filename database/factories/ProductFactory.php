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
            'price'       => $this->faker->randomFloat(2, 1, 100),
            'category_id' => function () {
                if (rand(1, 100) % 50 == 0) {
                    return Category::factory()->create()->id;
                } else {
                    return Category::all()->random()->id;
                }
            },
        ];
    }
}
