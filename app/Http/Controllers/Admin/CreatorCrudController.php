<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CreatorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CreatorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Creator');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/creator');
        $this->crud->setEntityNameStrings('creator', 'creators');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn('name');
        $this->crud->addColumn([
            'type' => 'relationship_count',
            'name' => 'snippets',
            'label' => 'Snippets',
            'suffix' => ' snippets',
            'link' => function($entry) {
                return backpack_url('creator/'.$entry->id.'/snippet');
            }
        ]);
    }
}
