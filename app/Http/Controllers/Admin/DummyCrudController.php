<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DummyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class DummyCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DummyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        $this->crud->setModel(\App\Models\Dummy::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/dummy');
        $this->crud->setEntityNameStrings('dummy', 'dummies');
    }

    public function fetchProduct()
    {
        return $this->fetch(\App\Models\Product::class);
    }

    public function fetchProducts()
    {
        return $this->fetch(\App\Models\Product::class);
    }

    public function fetchIcon()
    {
        return $this->fetch(\App\Models\Icon::class);
    }

    protected function setupListOperation()
    {
        CRUD::addColumn('name');
        CRUD::addColumn('description');

        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::addColumn([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'array_count',
            ]);
        }
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DummyRequest::class);
        $this->crud->setOperationSetting('contentClass', 'col-md-12');

        CRUD::addField('name');
        CRUD::addField('description');

        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::addField([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'repeatable',
                'fake'     => true,
                'store_in' => 'extras',
                'fields'   => $groupFields,
            ]);
        }
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->crud->setOperationSetting('contentClass', 'col-md-12');

        // for field types that have multiple name (ex: date_range)
        // split those into two separate text columns
        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::removeColumn($groupKey);

            foreach ($groupFields as $key => $field) {
                if (is_array($field['name'])) {
                    foreach ($field['name'] as $name) {
                        $newField = $field;
                        $newField['name'] = $name;
                        $newField['type'] = 'text';
                        $groupFields[] = $newField;
                    }
                    unset($groupFields[$key]);
                }
            }

            // only consider fields that have both name and label (needed for table column)
            // reject custom_html fields (since they have no value)
            $validFields = collect($groupFields)->reject(function ($value, $key) {
                $is_custom_html_field = $value['type'] ?? '' == 'custom_html';
                $does_not_have_label = !isset($value['label']);
                $does_not_have_name = !isset($value['name']);

                return $is_custom_html_field || $does_not_have_label || $does_not_have_name;
            })->pluck('label', 'name');

            CRUD::addColumn([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'table',
                'columns'  => $validFields,
            ]);
        }

        CRUD::addColumn([
            'name' => 'created_at',
            'type' => 'datetime',
        ]);
        CRUD::addColumn([
            'name' => 'updated_at',
            'type' => 'datetime',
        ]);
    }

    protected function groups()
    {
        // instead of manually defining all the field type here too
        // let's pull all field types defined in MonsterCrudController instead
        // since they're already nicely split by tab,
        // we can split them exactly the same here, but into groups instead of tabs
        // (one repeatable field for each tab in MonsterCrudController)
        $groups['simple'] = MonsterCrudController::getFieldsArrayForSimpleTab();
        $groups['time_and_space'] = MonsterCrudController::getFieldsArrayForTimeAndSpaceTab();
        $groups['selects'] = MonsterCrudController::getFieldsArrayForSelectsTab();
        $groups['uploads'] = MonsterCrudController::getFieldsArrayForUploadsTab();
        $groups['big_texts'] = MonsterCrudController::getFieldsArrayForWysiwygEditorsTab();
        $groups['miscellaneous'] = MonsterCrudController::getFieldsArrayForMiscellaneousTab();

        // some fields do not make sense, or do not work inside repeatable, so let's exclude them
        $excludedFieldTypes = [
            'address', // TODO
            'address_algolia', // TODO
            'address_google', // TODO
            'checklist_dependency', // only available in PermissionManager package
            // 'custom_html', // this works (of course), it's only used for heading, but the page looks better without them
            'enum', // doesn't make sense inside repeatable
            'page_or_link', // only available in PageManager package
            'upload', // currently impossible to make it work inside repeatable;
            'upload_multiple',  // currently impossible to make it work inside repeatable;
        ];

        foreach ($groups as $groupKey => $fields) {
            $groups[$groupKey] = Arr::where($fields, function ($field) use ($excludedFieldTypes) {
                // eliminate fields that have 1-1 relationships
                // (determined by the fact that their names use dot notation)
                if (is_string($field['name']) && strpos($field['name'], '.') != 0) {
                    return false;
                }

                // eliminate the heading for 1-1 relationships
                // since those are not available inside repeatable, the heading should be hidden too
                if (is_string($field['name']) && $field['name'] == 'select_1_1_heading') {
                    return false;
                }

                // if no field type was set, the system will probably use text, number or relationship
                // and all of those are fine, they work well inside repeatable fields
                if (!isset($field['type'])) {
                    return true;
                }

                // exclude all field types that we KNOW don't work inside repeatable
                return !in_array($field['type'], $excludedFieldTypes);
            });
        }

        return $groups;
    }
}
