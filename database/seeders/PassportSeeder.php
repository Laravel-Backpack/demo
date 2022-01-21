<?php

namespace Database\Seeders;

use App\Models\PetShop\Passport;
use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Passport::factory()->count(5)->create();
    }
}
