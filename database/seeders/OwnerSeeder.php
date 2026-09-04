<?php

namespace Database\Seeders;

use App\Models\PetShop\Owner;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Owners only (the factory adds their avatars). Their invoices come from
     * ReportDemoSeeder, which spreads realistic entries over the last 24 months.
     *
     * @return void
     */
    public function run()
    {
        Owner::factory()->count(5)->create();
    }
}
