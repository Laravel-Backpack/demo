<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SnippetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SnippetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CreatorSnippetCrudController extends SnippetCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $user_id = \Route::current()->parameter('user_id');

        $this->crud->setModel('App\Models\Snippet');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/creator/'.$user_id.'/snippet');
        $this->crud->setEntityNameStrings('snippet', 'snippets');

        // filter List operation (with search) to only show this users' entries
        $this->crud->addClause('where', 'created_by', $user_id);
    }
}
