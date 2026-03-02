<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\IconCrudController;
use App\Models\Icon;

class IconCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;

    public string $controller = IconCrudController::class;
    public string $model = Icon::class;
    public string $route = 'icon';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
