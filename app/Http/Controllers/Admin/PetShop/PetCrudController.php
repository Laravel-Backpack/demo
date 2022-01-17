<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\PetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PetCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PetCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Pet::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/pet');
        CRUD::setEntityNameStrings('pet', 'pets');
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
        CRUD::column('nickname');
        CRUD::column('passport');
        CRUD::column('skills');
        CRUD::column('avatar.url')->type('image')->label('Avatar');

        CRUD::addButtonFromView('top', 'passports', 'passports');
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
        CRUD::setValidation(PetRequest::class);

        CRUD::field('nickname');
        CRUD::field('avatar.url')->type('browse')->label('Avatar');
        CRUD::field('owners')->subfields([['name' => 'role', 'type' => 'text']]);
        CRUD::field('skills');
        CRUD::field('passport')->subfields(\App\Http\Controllers\Admin\PetShop\PassportCrudController::passportFields());
        CRUD::field('comments');
        CRUD::field('badges');
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
