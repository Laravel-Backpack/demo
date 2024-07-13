<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Meeting;
use App\Models\MenuItem;
use App\Models\Monster;
use App\Models\Page;
use App\Models\PostalBoxer;
use App\Models\Product;
use App\Models\Recommend;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IconsTableSeeder::class,
            \Backpack\Settings\database\seeds\SettingsTableSeeder::class,
            PermissionManagerTablesSeeder::class,
            UsersTableSeeder::class,
            CountryTableSeeder::class,
            UniversesSeeder::class,
            PetShopSeeder::class,
        ]);

        // Faker factories
        Recommend::factory()->count(30)->create();

        PostalBoxer::factory()->count(30)->create();

        Bill::factory()->count(30)->create();

        Tag::factory()->count(21)->create();

        Category::factory()->count(40)->create();

        Article::factory()->count(1031)->create();

        Product::factory()->count(210)->create();

        Monster::factory()->count(140)->create();

        Page::factory()->count(16)->create();

        MenuItem::factory()->count(7)->create();

        Meeting::factory()->count(50)->create();
    }
}
