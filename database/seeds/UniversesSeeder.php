<?php

use App\Models\Universe;
use Illuminate\Database\Seeder;

class UniversesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Universe::insert([
            [
                'title'            => 'universe 1',
                'universable_type' => '',
                'universable_id'   => 0,
            ],
            [
                'title'            => 'universe 2',
                'universable_type' => '',
                'universable_id'   => 0,
            ],
            [
                'title'            => 'universe 3',
                'universable_type' => '',
                'universable_id'   => 0,
            ],
        ]);
    }
}
