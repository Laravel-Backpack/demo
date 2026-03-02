<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\HeroCrudController;
use App\Models\Hero;

class HeroCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = HeroCrudController::class;
    public string $model = Hero::class;
    public string $route = 'hero';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
