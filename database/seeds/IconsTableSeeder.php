<?php

use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconsTableSeeder extends Seeder
{
    protected $icons = [
        [
            'name' => 'Tao',
            'icon' => 'fa-fas fa-adjust',
        ],
        [
            'name' => 'Left',
            'icon' => 'fa-fas fa-angle-left',
        ],
        [
            'name' => 'Right',
            'icon' => 'fa-fas fa-angle-right',
        ],
        [
            'name' => 'Home page',
            'icon' => 'fa-fas fa-home',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->icons as $icon) {
            Icon::create($icon);
        }

        $entry = Icon::find(rand(1, 4));
        $initialName = $entry->name;
        $entry->name = $initialName.' 2';
        $entry->save();
        $entry->name = $initialName.' 3';
        $entry->save();
        $entry->name = $initialName.' 4';
        $entry->save();
        $entry->name = $initialName.' 5';
        $entry->save();
        $entry->name = $initialName;
        $entry->save();

        $entry = Icon::find(rand(1, 4));
        $initialName = $entry->name;
        $entry->name = $initialName.' modified';
        $entry->save();
        $entry->name = $initialName;
        $entry->save();

        $entry = Icon::find(rand(1, 4));
        $entry->name = 'Archive';
        $entry->icon = 'fa-fas fa-archive';
        $entry->save();
    }
}
