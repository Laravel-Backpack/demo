<?php

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
        $this->call(NewsTablesSeeder::class);
        $this->call(IconsTableSeeder::class);
        $this->call(\Backpack\Settings\database\seeds\SettingsTableSeeder::class);

        $this->call(PermissionManagerTablesSeeder::class);
        $this->call(UsersTableSeeder::class);

        factory(App\Models\Product::class, 210)->create();
        factory(App\Models\Monster::class, 140)->create();
        factory(Backpack\PageManager\app\Models\Page::class, 16)->create();
        factory(Backpack\MenuCRUD\app\Models\MenuItem::class, 7)->create();
    }
}
