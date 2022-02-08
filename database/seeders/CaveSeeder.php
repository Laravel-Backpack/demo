<?php

namespace Database\Seeders;

use App\Models\Cave;
use Illuminate\Database\Seeder;

class CaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cave::factory()->count(5)->create();
    }
}
