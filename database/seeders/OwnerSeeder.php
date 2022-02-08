<?php

namespace Database\Seeders;

use App\Models\PetShop\Owner;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::factory()->count(5)->create();
    }
}
