<?php

$factory->define(Backpack\NewsCRUD\app\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});
