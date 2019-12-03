<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SnippetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SnippetCrudController.
 *
 * @property-read CrudPanel $crud
 */
class SnippetCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Snippet');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/snippet');
        $this->crud->setEntityNameStrings('snippet', 'snippets');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn('name');
        $this->crud->addColumn([
            'label'     => 'Category',
            'type'      => 'select',
            'name'      => 'category_id',
            'entity'    => 'category',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'label'     => 'Created by',
            'type'      => 'select',
            'name'      => 'created_by',
            'entity'    => 'creator',
            'attribute' => 'name',
        ]);

        $this->crud->addColumn([
            'label'     => 'Updated by',
            'type'      => 'select',
            'name'      => 'updated_by',
            'entity'    => 'updater',
            'attribute' => 'name',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->addColumn('description');
        $this->crud->addColumn('content');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(SnippetRequest::class);

        $this->crud->addField([
            'type'              => 'text',
            'name'              => 'name',
            'label'             => 'Name',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'label'             => 'Category',
            'type'              => 'select',
            'name'              => 'category_id',
            'entity'            => 'category',
            'attribute'         => 'name',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'type'  => 'simplemde',
            'name'  => 'description',
            'label' => 'Description',
        ]);
        $this->crud->addField([
            'type'  => 'textarea',
            'name'  => 'content',
            'label' => 'Content',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
