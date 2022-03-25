<?php

namespace Database\Seeders;

use App\Models\PetShop\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BadgeSeeder extends Seeder
{
    private $badges = ['Hero', 'First', 'Cleanest', 'Healer', 'Boring'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Badge::insert(array_map(function ($badge) { return ['name' => $badge, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]; }, $this->badges));
    }
}
