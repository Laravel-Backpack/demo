<?php

namespace Database\Factories\PetShop;

use App\Models\PetShop\Invoice;
use App\Models\PetShop\Owner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->date();

        return [
            'owner_id'      => Owner::factory(),
            'series'        => Arr::random(['SRV', 'PRD']),
            'number'        => $this->faker->randomNumber(4),
            'issuance_date' => $date,
            'due_date'      => Carbon::parse($date)->addDays(15),
        ];
    }
}
