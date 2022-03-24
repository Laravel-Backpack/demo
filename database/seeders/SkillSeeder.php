<?php

namespace Database\Seeders;

use App\Models\PetShop\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Jump', 'Sit', 'Bark', 'Lay Down', 'Fly', 'Run'];
        Skill::insert(array_map(function ($skill) { return ['name' => $skill, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]; }, $skills));
    }
}
