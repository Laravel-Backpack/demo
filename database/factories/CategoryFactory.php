<?php

$factory->define(Backpack\NewsCRUD\app\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});
