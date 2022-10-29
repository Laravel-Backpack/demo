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

        $timeSpaceColumns = static::getFieldsArrayForTimeAndSpaceTab();
        // Changed "time_range" column definition (changed "name" in comma separeated & convert "name" key in column definition)
        if ($timeSpaceColumns) {
            foreach ($timeSpaceColumns as $columnKey => $timeSpaceColumn) {
                if ($timeSpaceColumn['type'] == 'date_range') {
                    $dateRangeFieldName = $timeSpaceColumn['name'];
                    $dateRangeColumnName = implode(',', $dateRangeFieldName);
                    unset($timeSpaceColumns[$columnKey]);

                    // Creating new variable array to over-ride date_range column as that is "unset" above
                    $timeSpaceColumnDateRange = ['name' => $dateRangeColumnName, 'label' => $timeSpaceColumn['label'], 'type' => $timeSpaceColumn['type']];
                    $timeSpaceColumns[$columnKey] = $timeSpaceColumnDateRange;
                }
            }
        }

        $relationshipColumns = static::getFieldsArrayForRelationshipsTab();
        // Removing "custom_html" column definition
        if ($relationshipColumns) {
            foreach ($relationshipColumns as $columnKey => $relationshipColumn) {
                if (isset($relationshipColumn['type']) && ($relationshipColumn['type'] == 'custom_html')) {
                    unset($relationshipColumns[$columnKey]);
                }
            }
        }

        $miscellaneousColumns = static::getFieldsArrayForMiscellaneousTab();
        // Adding extra attributes in "range" column definition
        if ($miscellaneousColumns) {
            foreach ($miscellaneousColumns as $columnKey => $miscellaneousColumn) {
                if ($miscellaneousColumn['type'] == 'range') {
                    // Creating new variable array to over-ride date_range column as that is "unset" above
                    $miscColumnRange = [
                        'name'              => $miscellaneousColumn['name'],
                        'label'             => $miscellaneousColumn['label'],
                        'type'              => $miscellaneousColumn['type'],
                        'progress_class'    => 'bg-success',
                        'is_striped'        => '1',
                        'attributes'        => $miscellaneousColumn['attributes'],
                        'tab'               => $miscellaneousColumn['tab'],
                        'wrapperAttributes' => $miscellaneousColumn['wrapperAttributes'],
                    ];

                    $miscellaneousColumns[$columnKey] = $miscColumnRange;
                } elseif ($miscellaneousColumn['type'] == 'color' || $miscellaneousColumn['type'] == 'color_picker') {
                    // Creating new variable array to over-ride date_range column as that is "unset" above
                    // Over-write Show color hex setting by variable
                    $showColorHex = '0';

                    $miscColumnRange = [
                        'name'              => $miscellaneousColumn['name'],
                        'label'             => $miscellaneousColumn['label'],
                        'type'              => $miscellaneousColumn['type'],
                        'showColorHex'      => isset($miscellaneousColumn['showColorHex']) ? '1' : $showColorHex,
                        'tab'               => $miscellaneousColumn['tab'],
                        'wrapperAttributes' => $miscellaneousColumn['wrapperAttributes'],
                    ];

                    $miscellaneousColumns[$columnKey] = $miscColumnRange;
                }
            }
        }

        $this->crud->addColumns(static::getFieldsArrayForSimpleTab());
        $this->crud->addColumns($timeSpaceColumns);
        $this->crud->addColumns(static::getFieldsArrayForSelectsTab());
        $this->crud->addColumns($relationshipColumns);
        $this->crud->addColumns(static::getFieldsArrayForUploadsTab());
        $this->crud->addColumns(static::getFieldsArrayForWysiwygEditorsTab());
        $this->crud->addColumns($miscellaneousColumns);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);.
         */
    }
}
