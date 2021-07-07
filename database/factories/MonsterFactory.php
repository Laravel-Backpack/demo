<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Monster;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonsterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Monster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text'            => ucfirst($this->faker->unique()->sentence()),
            'wysiwyg'         => $this->faker->text(800),
            'simplemde'       => $this->faker->text(800),
            'summernote'      => $this->faker->text(800),
            'tinymce'         => $this->faker->text(800),
            'textarea'        => $this->faker->text(250),
            'text'            => $this->faker->text(120),
            'date'            => $this->faker->date(),
            'start_date'      => $this->faker->date(),
            'end_date'        => $this->faker->date(),
            'datetime'        => $this->faker->datetime(),
            'datetime_picker' => $this->faker->datetime(),
            'email'           => $this->faker->email(),
            'checkbox'        => $this->faker->boolean(),
            'number'          => rand(),
            'float'           => rand(),
            'select'          => function () {
                if (rand(1, 100) % 50 == 0) {
                    return Category::factory()->create()->id;
                } else {
                    return rand(1, 10);
                }
            },
        ];
    }
}
