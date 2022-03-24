<?php

namespace Database\Factories\PetShop;

use App\Models\PetShop\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $skills = ['Jump', 'Sit', 'Bark', 'Lay Down', 'Fly', 'Run'];

        return [
            'name' => Arr::random($skills),
        ];
    }
}
