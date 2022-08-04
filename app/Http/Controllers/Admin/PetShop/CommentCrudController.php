<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\CommentRequest;
use App\Models\PetShop\Pet;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommentCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use FetchOperation;

    public function fetchPets()
    {
        return $this->fetch(Pet::class);
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PetShop\Comment::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/comment');
        CRUD::setEntityNameStrings('comment', 'comments');
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
        CRUD::column('body');
        // CRUD::column('commentable_type');
        // CRUD::column('commentable_id');
        CRUD::column('user');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);.
         */
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
        CRUD::setValidation(CommentRequest::class);

        CRUD::field('body');

        CRUD::field('commentable')
            ->addMorphOption('App\Models\PetShop\Owner', 'Owners')
            ->addMorphOption('monster')
            ->addMorphOption('App\Models\PetShop\Pet', 'Pets', [
                'data_source'          => backpack_url('pet-shop/comment/fetch/pets'),
                'minimum_input_length' => 2,
                'placeholder'          => 'select a fluffy pet',
            ])
            ->addMorphOption('user', 'Users');

        CRUD::field('user_id');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));.
         */
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
