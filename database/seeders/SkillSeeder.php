<?php

namespace Database\Seeders;

use App\Models\PetShop\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::factory()->count(5)->create();
    }
}
