<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StoryCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StoryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Story::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/story');
        CRUD::setEntityNameStrings('story', 'stories');
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
        CRUD::column('monsters')->attribute('text');
        CRUD::column('heroes');
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
        CRUD::setValidation(StoryRequest::class);
        CRUD::setOperationSetting('contentClass', 'col-md-12');

        CRUD::field('name');
        CRUD::field('monsters')
            ->label('Monsters <span class="badge badge-pill badge-warning">New</span>')
            ->subfields(self::getMonsterSubfields())
            ->hint('<small class="float-right">Create/update/delete related Monsters over a <code>hasMany</code> relationship (1-n).</small>');
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

    public static function getMonsterSubfields()
    {
        return CaveCrudController::getMonsterSubfields();
    }
}
