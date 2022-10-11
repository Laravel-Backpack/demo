<?php

namespace Database\Seeders;

use App\Models\PetShop\Owner;
use App\Models\PetShop\Pet;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MillionCommentsSeeder extends Seeder
{
    public $faker;
    public $owners;
    public $pets;
    public $texts;

    public function __construct()
    {
        $this->faker = app()->make(Generator::class);
        $this->owners = Owner::all();
        $this->pets = Pet::all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::beginTransaction();

        for ($i = 1; $i <= 1000; $i++) {
            $body = $this->faker->text;
            $commentable = $i % 2 == 0 ? $this->owners->random() : $this->pets->random();
            $commentable_type = get_class($commentable);
            $commentable_id = $commentable->getKey();

            $comments = array_fill(0, 1000, [
                'body'             => $body,
                'commentable_type' => $commentable_type,
                'commentable_id'   => $commentable_id,
                'user_id'          => rand(1, 50),
            ]);

            DB::table('comments')->insertOrIgnore($comments);
        }

        DB::commit();
        DB::enableQueryLog();
    }
}
