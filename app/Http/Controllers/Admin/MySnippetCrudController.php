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
class MySnippetCrudController extends SnippetCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Snippet');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/my-snippet');
        $this->crud->setEntityNameStrings('snippet', 'snippets');

        // filter List operation (with search) to only show this users' entries
        $this->crud->addClause('where', 'created_by', backpack_auth()->user()->id);

        // if the user tries to access somone else's entries, block him
        $entry = $this->crud->getCurrentEntry();
        
        if ($entry && $entry->created_by != backpack_auth()->user()->id) {
            abort(403, "You don't have access to this entry.");
        }
    }
}
