<?php

namespace Database\Factories;

use App\Models\PetShop\Invoice;
use App\Models\PetShop\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'invoice_id'  => Invoice::factory(),
            'order'       => $this->faker->randomNumber(),
            'description' => $this->faker->text,
            'quantity'    => $this->faker->randomFloat(0, 0, 9999999999.),
            'unit_price'  => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
