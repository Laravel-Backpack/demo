<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
 * Authentication - Users, Roles, Permissions.
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt(Str::random(10)),
        'remember_token' => Str::random(10),
        'created_at'     => Carbon::now()->subDays(rand(0, 7)),
    ];
});

/*
 * NewsCRUD
 */

$factory->define(Backpack\NewsCRUD\app\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'           => ucfirst($faker->unique()->word),
        'created_at'     => Carbon::now()->subDays(rand(0, 30)),
    ];
});

$factory->define(Backpack\NewsCRUD\app\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name'          => ucfirst($faker->unique()->word),
        'created_at'    => Carbon::now()->subDays(rand(0, 30)),
    ];
});

$factory->define(Backpack\NewsCRUD\app\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'category_id' => rand(1, 8),
        'title'       => ucfirst($faker->unique()->sentence()),
        'content'     => $faker->text(800),
        'status'      => $faker->shuffle(['PUBLISHED', 'DRAFT'])[0],
        'date'        => $faker->date(),
        'featured'    => $faker->boolean(),
        'created_at'  => Carbon::now()->subDays(rand(0, 30)),
    ];
});

/*
 * PageManager and MenuCRUD
 */

$factory->define(Backpack\PageManager\app\Models\Page::class, function (Faker\Generator $faker) {
    $title = ucfirst($faker->unique()->words(rand(1, 3), true));

    return [
        'template' => $faker->randomElement(['services', 'about_us']),
        'name'     => $title,
        'title'    => $title,
        // 'slug' = ,
        'content' => $faker->paragraphs(rand(3, 18), true),
        // 'extras' => ,
    ];
});

$factory->define(Backpack\MenuCRUD\app\Models\MenuItem::class, function (Faker\Generator $faker) {
    $name = ucfirst($faker->unique()->words(rand(1, 3), true));
    $type = $faker->randomElement(['page_link', 'external_link', 'internal_link']);

    switch ($type) {
        case 'external_link':
            $link = $faker->url;
            $page_id = null;
            break;

        case 'internal_link':
            $link = $faker->slug;
            $page_id = null;
            // code...
            break;

        default: // page_link
            $link = null;
            $page_id = rand(1, 5);
            break;
    }

    return [
        'name'    => $name,
        'type'    => $type,
        'link'    => $link,
        'page_id' => $page_id,
    ];
});

/*
 * Demo Entities
 */

$factory->define(App\Models\Monster::class, function (Faker\Generator $faker) {
    return [
        'text'                    => ucfirst($faker->unique()->sentence()),
        'wysiwyg'                 => $faker->text(800),
        'summernote'              => $faker->text(800),
        'tinymce'                 => $faker->text(800),
        'textarea'                => $faker->text(250),
        'text'                    => $faker->text(120),
        'date'                    => $faker->date(),
        'start_date'              => $faker->date(),
        'end_date'                => $faker->date(),
        'datetime'                => $faker->datetime(),
        'datetime_picker'         => $faker->datetime(),
        'email'                   => $faker->email(),
        'checkbox'                => $faker->boolean(),
        'number'                  => rand(),
        'float'                   => rand(),
        'belongs_to_non_nullable' => 0,
        'select'                  => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name'        => ucfirst($faker->unique()->sentence()),
        'description' => $faker->text(50),
        'details'     => $faker->text(800),
        // 'features',

        'price'       => rand(),
        'category_id' => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
    ];
});

$factory->define(App\Models\Recommend::class, function (Faker\Generator $faker) {
    $title = ucfirst($faker->unique()->words(rand(1, 3), true));

    return [
        'title' => $title,
    ];
});

$factory->define(App\Models\Bill::class, function (Faker\Generator $faker) {
    $title = ucfirst($faker->unique()->words(rand(1, 3), true));

    return [
        'title' => $title,
    ];
});

$factory->define(App\Models\PostalBoxer::class, function (Faker\Generator $faker) {
    $title = ucfirst($faker->unique()->words(rand(1, 3), true));

    return [
        'postal_name' => $title,
    ];
});
