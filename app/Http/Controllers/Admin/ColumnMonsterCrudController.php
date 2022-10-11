<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ColumnMonsterCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ColumnMonsterCrudController extends MonsterCrudController
{
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Monster::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/column-monster');
        CRUD::setEntityNameStrings('column monster', 'column monsters');
        $this->crud->set('show.setFromDb', false);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    public function setupListOperation()
    {
        $this->crud->disableResponsiveTable();

        $this->crud->addColumns(static::getFieldsArrayForSimpleTab());
        $this->crud->addColumns(static::getFieldsArrayForTimeAndSpaceTab());
        $this->crud->addColumns(static::getFieldsArrayForSelectsTab());
        $this->crud->addColumns(static::getFieldsArrayForRelationshipsTab());
        $this->crud->addColumns(static::getFieldsArrayForUploadsTab());
        $this->crud->addColumns(static::getFieldsArrayForWysiwygEditorsTab());
        $this->crud->addColumns(static::getFieldsArrayForMiscellaneousTab());

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);.
         */
    }

    public static function getFieldsArrayForTimeAndSpaceTab()
    {
        // -----------------
        // DATE, TIME AND SPACE tab
        // -----------------

        return [
            [   // Time
                'name'              => 'time',
                'label'             => 'Time'.backpack_free_badge(),
                'type'              => 'time',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
                'fake'              => true,
            ],
            [   // Month
                'name'              => 'week',
                'label'             => 'Week'.backpack_free_badge(),
                'type'              => 'week',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Month
                'name'              => 'month',
                'label'             => 'Month'.backpack_free_badge(),
                'type'              => 'month',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                'name'       => 'date',
                'label'      => 'Date (HTML5 spec)'.backpack_free_badge(),
                'type'       => 'date',
                'attributes' => [
                    'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
                    'placeholder' => 'yyyy-mm-dd',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                // <span class="badge badge-pill badge-primary">PRO</span>
                'name'  => 'date_picker',
                'label' => 'Date picker (jQuery plugin)'.backpack_pro_badge(),
                'type'  => 'date_picker',
                // optional:
                'date_picker_options' => [
                    'todayBtn' => true,
                    'format'   => 'dd-mm-yyyy',
                    'language' => 'en',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // DateTime
                'name'              => 'datetime',
                'label'             => 'Datetime (HTML5 spec)'.backpack_free_badge(),
                'type'              => 'datetime',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // DateTime
                'name'  => 'datetime_picker',
                'label' => 'Datetime picker (jQuery plugin)'.backpack_pro_badge(),
                'type'  => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format'   => 'DD/MM/YYYY HH:mm',
                    'language' => 'en',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // Address
                'name'  => 'address_algolia_string',
                'label' => 'Address_algolia (saved in db as string)'.backpack_pro_badge(),
                'type'  => 'address_algolia',
                'fake'  => true,
                // optional
                // 'store_as_json' => true,
                'tab'           => 'Time and space',
            ],
            [   // Address
                'name'  => 'address_algolia',
                'label' => 'Address_algolia (stored in db as json)'.backpack_pro_badge(),
                'type'  => 'address_algolia',
                // optional
                'store_as_json' => true,
                'tab'           => 'Time and space',
            ],
        ];
    }
}
