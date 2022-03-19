<?php

namespace Database\Seeders;

use App\Models\PetShop\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceItem::factory()->count(5)->create();
    }
}
