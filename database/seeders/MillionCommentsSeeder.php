<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PetShop\Owner;
use App\Models\PetShop\Pet;
use Faker\Generator;

class MillionCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $owners = Owner::all();
        $pets = Pet::all();
        $faker = app()->make(Generator::class);
        DB::beginTransaction();
        for($i = 1; $i <= 100; $i++) {
            $commentable_type = $i%2 == 0 ? $owners->random() : $pets->random();
            DB::table('comments')->insert($this->buildBulkComments($faker->text, get_class($commentable_type), $commentable_type->getKey()));
        }
        DB::commit();
        DB::enableQueryLog();
    }

    public function buildBulkComments($text, $commentable_type, $commentable_id)
    {
        return array_fill(0, 10000, ['body' => $text, 'commentable_type' => $commentable_type, 'commentable_id' => $commentable_id, 'user_id' => 1]);
    }
}
