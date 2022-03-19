<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\OwnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OwnerCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OwnerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PetShop\Owner::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/owner');
        CRUD::setEntityNameStrings('owner', 'owners');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('avatar.url')->type('image')->label('Avatar');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OwnerRequest::class);

        CRUD::field('name');
        CRUD::field('avatar.url')->type('browse')->label('Avatar')->hint('<small class="float-right">Edit one attribute on a <code>morphOne</code> related item (1-1).</small>');
        CRUD::field('pets')->subfields([
            ['name' => 'role', 'type' => 'text'],
        ])->hint('<small class="float-right">Choose related entries with a <code>belongsToMany</code> relationship and pivot fields (n-n with pivot).</small>');
        CRUD::field('comments')->hint('<small class="float-right">Choose related entries with a <code>morphMany</code> relationship (1-n).</small>');
        CRUD::field('badges')->subfields([
            ['name' => 'note', 'type' => 'text'],
        ])->hint('<small class="float-right">Choose related entries with a <code>morphToMany</code> relationship and pivot fields (n-n with pivot).</small>');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
