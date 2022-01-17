<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_id' => Invoice::factory(),
            'order' => $this->faker->randomNumber(),
            'description' => $this->faker->text,
            'quantity' => $this->faker->randomFloat(0, 0, 9999999999.),
            'unit_price' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
