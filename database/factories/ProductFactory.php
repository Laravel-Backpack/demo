<?php

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
