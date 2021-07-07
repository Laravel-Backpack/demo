<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Monster;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use Backpack\Settings\database\seeds\SettingsTableSeeder;
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
        // Static seeders
        $this->call([
            IconsTableSeeder::class,
            SettingsTableSeeder::class,
            PermissionManagerTablesSeeder::class,
            UsersTableSeeder::class,
        ]);

        // Faker factories
        Tag::truncate();
        Tag::factory()->count(21)->create();

        Category::truncate();
        Category::factory()->count(4)->create();

        Article::truncate();
        Article::factory()->count(1031)->create();

        Product::truncate();
        Product::factory()->count(210)->create();

        Monster::truncate();
        Monster::factory()->count(140)->create();

        Page::truncate();
        Page::factory()->count(16)->create();

        MenuItem::truncate();
        MenuItem::factory()->count(7)->create();
    }
}
