<?php

$factory->define(Backpack\NewsCRUD\app\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'category_id' => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
        'title'    => ucfirst($faker->unique()->sentence()),
        'content'  => $faker->text(800),
        'status'   => $faker->shuffle(['PUBLISHED', 'DRAFT'])[0],
        'date'     => $faker->date(),
        'featured' => $faker->boolean(),
    ];
});
