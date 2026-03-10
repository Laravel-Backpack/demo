<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\CommentCrudController;
use App\Models\PetShop\Comment;

class CommentCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = CommentCrudController::class;
    public string $model = Comment::class;
    public string $route = 'pet-shop/comment';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
