<?php

use Illuminate\Database\Seeder;

class NewsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Backpack\NewsCRUD\app\Models\Category::class, 4)->create();
        factory(Backpack\NewsCRUD\app\Models\Article::class, 1031)->create();
        factory(Backpack\NewsCRUD\app\Models\Tag::class, 21)->create();
    }
}
