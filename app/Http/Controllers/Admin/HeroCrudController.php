<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HeroRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class HeroCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class HeroCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Hero::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/hero');
        CRUD::setEntityNameStrings('hero', 'heroes');
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
        CRUD::column('monster');
        CRUD::column('stories');
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
        CRUD::setValidation(HeroRequest::class);
        CRUD::setOperationSetting('contentClass', 'col-md-12');

        CRUD::field('name');
        CRUD::field('stories')
            ->label('Stories <span class="badge badge-pill badge-warning">New</span>')
            ->subfields(self::getMonsterSubfields())
            ->hint('<small class="float-right">Select the related Story over a <code>belongsToMany</code> relationship (n-n) with extra pivot fields.</small>');
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
        $subfields = CaveCrudController::getMonsterSubfields();

        foreach ($subfields as $key => $subfield) {
            // fake fields don't work here for some reason
            // TODO: fix the problem and remove this
            if (isset($subfield['fake']) && $subfield['fake']) {
                unset($subfields[$key]);
                continue;
            }
            // multiple fields don't work here for some reason
            // TODO: fix the problem and remove this
            if (isset($subfield['pivot']) && $subfield['pivot']) {
                unset($subfields[$key]);
                continue;
            }
            // fields from the "relationship" tab don't work here for some reason
            // TODO: fix the problem and remove this
            if (isset($subfield['tab']) && $subfield['tab'] == 'Relationships') {
                unset($subfields[$key]);
                continue;
            }
        }

        return $subfields;
    }
}
