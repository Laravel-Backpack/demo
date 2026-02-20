<?php

namespace Tests\Feature\Admin\PetShop\CommentCrud;

use App\Http\Controllers\Admin\PetShop\CommentCrudController;
use App\Models\PetShop\Comment;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = CommentCrudController::class;
    public string $model = Comment::class;
    public string $route = 'pet-shop/comment';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
