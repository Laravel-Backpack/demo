<?php

namespace Database\Factories;

use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendar::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title = $this->faker->randomElement([
            'Meeting with '.$this->faker->name,
            'Lunch with '.$this->faker->name,
            'Dinner with '.$this->faker->name,
            'Drink with '.$this->faker->name,
        ]);

        $start = Carbon::now()->addDays(30)->subMinutes(rand(0, Carbon::now()->diffInMinutes(Carbon::now()->subDays(90))))->floorHour();
        $end = rand(0, 2) ? $start->copy()->addMinutes($this->faker->randomElement([60, 60, 60, 120, 240])) : null;

        [$backgroundColor, $textColor] = $this->faker->randomElement([
            ['#5e9ecd', '#ffffff'],
            ['#009688', '#ffffff'],
        ]);

        return [
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'email' => $this->faker->email,
            'number' => $this->faker->phoneNumber,
            'background_color' => $backgroundColor,
            'text_color' => $textColor,
        ];
    }
}
