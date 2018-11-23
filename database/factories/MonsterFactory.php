<?php

$factory->define(App\Models\Monster::class, function (Faker\Generator $faker) {
    return [
        'text'            => ucfirst($faker->unique()->sentence()),
        'wysiwyg'         => $faker->text(800),
        'simplemde'       => $faker->text(800),
        'summernote'      => $faker->text(800),
        'tinymce'         => $faker->text(800),
        'textarea'        => $faker->text(250),
        'text'            => $faker->text(120),
        'date'            => $faker->date(),
        'start_date'      => $faker->date(),
        'end_date'        => $faker->date(),
        'datetime'        => $faker->datetime(),
        'datetime_picker' => $faker->datetime(),
        'email'           => $faker->email(),
        'checkbox'        => $faker->boolean(),
        'number'          => rand(),
        'float'           => rand(),
        'select'          => function () {
            if (rand(1, 100) % 50 == 0) {
                return factory(Backpack\NewsCRUD\app\Models\Category::class)->create()->id;
            } else {
                return rand(1, 10);
            }
        },
    ];
});
