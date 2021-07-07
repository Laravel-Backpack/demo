<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = ucfirst($this->faker->unique()->words(rand(1, 3), true));
        $type = $this->faker->randomElement([MenuItem::$pageLink, MenuItem::$externalLink, MenuItem::$internalLink]);

        $link = null;
        $page_id = null;

        switch ($type) {
            case MenuItem::$externalLink:
                $link = $this->faker->url;
                break;

            case MenuItem::$internalLink:
                $link = $this->faker->slug;
                break;

            case MenuItem::$pageLink:
                $page_id = Page::all()->random()->id;
                break;
        }

        return [
            'name'    => $name,
            'type'    => $type,
            'link'    => $link,
            'page_id' => $page_id,
        ];
    }
}
