<?php

namespace Database\Factories\PetShop;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\PetShop\Owner;
use App\Models\PetShop\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

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
