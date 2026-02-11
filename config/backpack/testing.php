<?php

return [
    'controllers_path' => app_path('Http/Controllers'),
    'configurations'   => [
        App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController::class => Tests\Config\OwnerPetsConfig::class,
        App\Http\Controllers\Admin\PetShop\PetCrudController::class       => Tests\Config\PetConfig::class,
        App\Http\Controllers\Admin\PetShop\PassportCrudController::class  => Tests\Config\PassportConfig::class,
        App\Http\Controllers\Admin\PetShop\OwnerCrudController::class     => Tests\Config\OwnerConfig::class,
        App\Http\Controllers\Admin\FluentMonsterCrudController::class     => Tests\Config\MonsterConfig::class,
        App\Http\Controllers\Admin\MonsterCrudController::class           => Tests\Config\MonsterConfig::class,
        App\Http\Controllers\Admin\ColumnMonsterCrudController::class     => Tests\Config\MonsterConfig::class,
        App\Http\Controllers\Admin\EditableMonsterCrudController::class   => Tests\Config\MonsterConfig::class,
        App\Http\Controllers\Admin\FieldMonsterCrudController::class      => Tests\Config\MonsterConfig::class,
        App\Http\Controllers\Admin\UserCrudController::class              => Tests\Config\UserConfig::class,
    ],
];
