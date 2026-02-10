<?php

namespace Tests\Feature\CommentCrud;

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
        $this->actingAsAdmin();

        // Clear filters to avoid duplication conflict when the request is run
        if ($this->app->bound('crud')) {
            $this->app['crud']->clearFilters();
        }

        if(config('backpack.testing.configurations.'.$this->controller)) {
            $this->testConfig = new (config('backpack.testing.configurations.'.$this->controller))();
        }
    }
}
