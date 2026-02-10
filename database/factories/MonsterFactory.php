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
            'summernote'              => '<p>'.$this->faker->text(800).'</p>',
            'tinymce'                 => $this->faker->text(800),
            'textarea'                => $this->faker->text(250),
            'text'                    => $this->faker->text(120),
            'date'                    => $this->faker->date(),
            'start_date'              => $this->faker->date(),
            'end_date'                => $this->faker->date(),
            'datetime'                => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'datetime_picker'         => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'email'                   => $this->faker->email(),
            'checkbox'                => 0,
            'number'                  => rand(),
            'float'                   => rand(),
            'belongs_to_non_nullable' => 0,
            'select'                  => null,
            'icon_id'                 => null,
            'status'                  => \App\Enums\MonsterStatus::WORKING->value,
            'select2_json_from_api'   => null,
            'select2_json_from_api_simple' => null,
        ];
    }
}
