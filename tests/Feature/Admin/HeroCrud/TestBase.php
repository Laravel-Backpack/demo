<?php

namespace Tests\Feature\Admin\HeroCrud;

use App\Http\Controllers\Admin\HeroCrudController;
use App\Models\Hero;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = HeroCrudController::class;
    public string $model = Hero::class;
    public string $route = 'hero';
    public ?string $entityName = 'hero';
    public ?string $entityNamePlural = 'heroes';
}
