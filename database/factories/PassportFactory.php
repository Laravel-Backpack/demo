<?php

namespace Database\Factories;

use App\Models\PetShop\Passport;
use App\Models\PetShop\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Passport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pet_id'        => Pet::factory(),
            'number'        => $this->faker->word,
            'issuance_date' => $this->faker->date(),
            'expiry_date'   => $this->faker->date(),
            'first_name'    => $this->faker->firstName,
            'middle_name'   => $this->faker->word,
            'last_name'     => $this->faker->lastName,
            'birth_date'    => $this->faker->date(),
            'species'       => $this->faker->word,
            'breed'         => $this->faker->word,
            'colour'        => $this->faker->word,
            'notes'         => $this->faker->text,
            'country'       => $this->faker->country,
        ];
    }
}
