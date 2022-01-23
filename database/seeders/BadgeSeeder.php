<?php

namespace Database\Seeders;

use App\Models\PetShop\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Badge::factory()->count(5)->create();
    }
}
