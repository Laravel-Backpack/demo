<?php

namespace App\Http\Controllers\Admin\PetShop;

use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

class OwnerPetsCrudController extends PetCrudController
{
    use CreateOperation {store as traitStore; }
    use UpdateOperation {update as traitUpdate; }

    private int $owner;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();

        // get the owner parameter
        $this->owner = \Route::current()->parameter('owner');

        // set a different route for the admin panel
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/owner/'.$this->owner.'/pets');

        // show only that owner's pets
        CRUD::addBaseClause(function (Builder $query) {
            $query->whereHas('owners', function (Builder $query) {
                $query->where('owner_id', $this->owner)
                  ->where('role', 'Owner');
            });
        });
    }

    protected function setupCreateOperation()
    {
        parent::setupCreateOperation();
        // remove the relationship field
        CRUD::removeField('owners');
        // add an hidden field so that our stripRequest allow that key to go through.
        CRUD::field('owners')->type('hidden');
    }

    protected function setupUpdateOperation()
    {
        parent::setupUpdateOperation();
        // remove the relationship field
        CRUD::removeField('owners');
        // add an hidden field so that our stripRequest allow that key to go through.
        CRUD::field('owners')->type('hidden');
    }

    public function store()
    {
        CRUD::setRequest($this->addOwnerToRequest());

        return $this->traitStore();
    }

    public function update()
    {
        CRUD::setRequest($this->addOwnerToRequest());

        return $this->traitUpdate();
    }

    private function addOwnerToRequest()
    {
        return CRUD::getRequest()->merge([
            'owners' => [
                [
                    'owners' => $this->owner,
                    'role'   => 'Owner',
                ],
            ],
        ]);
    }
}
