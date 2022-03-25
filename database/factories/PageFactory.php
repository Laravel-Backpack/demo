<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ucfirst($this->faker->unique()->words(rand(2, 5), true));

        return [
            'template' => $this->faker->randomElement(['services', 'about_us']),
            'name'     => $title,
            'title'    => $title,
            'slug'     => Str::slug($title),
            'content'  => $this->faker->paragraphs(rand(3, 18), true),
        ];
    }
}
