<?php

namespace Tests\Feature\Admin\PetShop\CommentCrud;

use App\Http\Controllers\Admin\PetShop\CommentCrudController;
use App\Models\PetShop\Comment;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = CommentCrudController::class;
    public string $model = Comment::class;
    public string $route = 'pet-shop/comment';
    public ?string $entityName = 'comment';
    public ?string $entityNamePlural = 'comments';
}
