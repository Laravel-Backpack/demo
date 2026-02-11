<?php

namespace Tests\Feature\Admin\PetShop\CommentCrud;

use App\Http\Controllers\Admin\PetShop\CommentCrudController;
use App\Models\PetShop\Comment;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class CommentCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = CommentCrudController::class;
    protected string $route = 'pet-shop/comment';
    protected string $model = Comment::class;
    protected ?string $entityName = 'comment';
    protected ?string $entityNamePlural = 'comments';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
