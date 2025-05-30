<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\OwnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

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
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function fetchComments()
    {
        return $this->fetch('App\Models\PetShop\Comment');
    }

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
        CRUD::column('pets')->label('Pets')->linkTo('pet.show');
        CRUD::column('invoices')->linkTo('invoice.show');
        CRUD::column('badges')->label('Badges')->linkTo('badge.show');

        CRUD::button('view_pets')->stack('line')->view('crud::buttons.quick')->meta([
            'access'  => true,
            'label'   => 'View Pets',
            'icon'    => 'la la-paw',
            'wrapper' => [
                'href' => function ($entry, $crud) {
                    return url($crud->route.'/'.$entry->getKey().'/pets');
                },
                'title' => 'view owner pets',
            ],
        ]);
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
        CRUD::field('comments')->ajax('true')->hint('<small class="float-right">Choose related entries with a <code>morphMany</code> relationship (1-n).</small>');
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

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        Widget::add([
            'type'       => 'datatable',
            'controller' => 'App\Http\Controllers\Admin\PetShop\PetCrudController',
            'name'       => 'pets_crud',
            'section'    => 'after_content',
            'wrapper'    => ['class' => 'mt-3'],
            'content'    => [
                'header' => 'Pets for this owner',
                // COULD-DO: maybe add support for a subheader?
                // 'subheader' => 'This is a list of all pets owned by this owner.',
            ],
            // MUST-DO: How the fuck do I make this only show related pets?!?!
            'configure' => function ($crud, $parent) {
                 // only show the pets of this owner (owner is an n-n relationship)
                if ($parent) {
                    $crud->addClause('whereHas', 'owners', function ($query) use ($parent) {
                        $query->where('id', $parent->id);
                    });
                }
            },
            // SHOULD-DO: how do I make a new entry automatically related to the owner?
        ]);

        \Log::info($this->crud->settings());

       Widget::add([
            'type'       => 'datatable',
            'controller' => 'App\Http\Controllers\Admin\PetShop\InvoiceCrudController',
            'name'       => 'invoices_crud',
            'section'    => 'after_content',
            'wrapper'    => ['class' => 'mt-3'],
            'content'    => [
                'header' => 'Invoices for this owner',
            ],
            // MUST-DO: How the fuck do I make this only show related pets?!?!
             'configure' => function ($crud, $parent) {
                \Log::info('running configure with parent? ' . isset($parent) ? 'true' : 'false');
                 // only show the pets of this owner (owner is an n-n relationship)
                 if ($parent) {
                     $crud->addClause('where', 'owner_id', $parent->id);
                 }
             },
        ]);
    }
}
