<?php

namespace Database\Seeders;

use App\Models\PetShop\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory()->count(5)->create();
    }
}
