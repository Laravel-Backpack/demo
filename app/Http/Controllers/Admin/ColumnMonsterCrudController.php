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

        foreach ($timeSpaceColumns as $columnKey => $column) {
            // transform field array names into comma separated string
            if (is_array($column['name'])) {
                $timeSpaceColumns[$columnKey]['name'] = implode(',', $column['name']);
            }
        }

        $this->crud->addColumns(static::getFieldsArrayForSimpleTab());
        $this->crud->addColumns($timeSpaceColumns);
        $this->crud->addColumns(static::getFieldsArrayForSelectsTab());
        $this->crud->addColumns(static::getFieldsArrayForRelationshipsTab());
        $this->crud->addColumns(static::getFieldsArrayForUploadsTab());
        $this->crud->addColumns(static::getFieldsArrayForWysiwygEditorsTab());
        $this->crud->addColumns(static::getFieldsArrayForMiscellaneousTab());

        foreach ($this->crud->columns() as $columnKey => $column) {
            // remove all custom_html columns
            if (isset($column['type']) && $column['type'] === 'custom_html') {
                $this->crud->removeColumn($columnKey);
                continue;
            }
            // unset the `col-` bootstrap size classes as they would break the columns in the table.
            if (isset($column['wrapper']['class'])) {
                $column['wrapper']['class'] = $this->removeBootstrapSizingClasses($column['wrapper']['class']);
            }

            if (isset($column['subfields'])) {
                $subfields = $column['subfields'];
                foreach ($subfields as $subfieldKey => $subfield) {
                    if (isset($subfield['wrapper']['class'])) {
                        $subfields[$subfieldKey]['wrapper']['class'] = $this->removeBootstrapSizingClasses($subfield['wrapper']['class']);
                    }
                }
                $column['subfields'] = $subfields;
            }
            $this->crud->modifyColumn($columnKey, $column);
        }
    }

    private function removeBootstrapSizingClasses($classes)
    {
        $classes = explode(' ', $classes);
        $newClasses = [];
        foreach ($classes as $class) {
            if (!str_starts_with($class, 'col-')) {
                array_push($newClasses, $class);
            }
        }

        return implode(' ', $newClasses);
    }
}
