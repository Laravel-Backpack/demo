<?php

namespace Database\Factories;

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
            'text'                    => ucfirst($this->faker->unique()->sentence()),
            'wysiwyg'                 => $this->faker->text(800),
            'summernote'              => $this->faker->text(800),
            'tinymce'                 => $this->faker->text(800),
            'textarea'                => $this->faker->text(250),
            'text'                    => $this->faker->text(120),
            'date'                    => $this->faker->date(),
            'start_date'              => $this->faker->date(),
            'end_date'                => $this->faker->date(),
            'datetime'                => $this->faker->datetime(),
            'datetime_picker'         => $this->faker->datetime(),
            'email'                   => $this->faker->email(),
            'checkbox'                => $this->faker->boolean(),
            'number'                  => rand(),
            'float'                   => rand(),
            'belongs_to_non_nullable' => 0,
            'select'                  => rand(1, 40),
            'icon_id'                 => rand(1, 4),
        ];
    }
}
