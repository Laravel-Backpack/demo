<?php

namespace Database\Seeders;

use App\Models\PetShop\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pet::factory()->count(5)->create();
    }
}
