<?php

namespace Database\Factories;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'password'          => bcrypt(Str::random(10)),
            'remember_token'    => Str::random(10),
            'created_at'        => Carbon::now()->subDays(rand(0, 7)),
            'email_verified_at' => random_int(1, 999) % 2 == 0 ? now() : null,
        ];
    }
}
