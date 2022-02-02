<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CaveRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CaveCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CaveCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cave::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/cave');
        CRUD::setEntityNameStrings('cave', 'caves');
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
        CRUD::column('monster')->attribute('text');
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
        CRUD::setValidation(CaveRequest::class);
        CRUD::setOperationSetting('contentClass', 'col-md-12');

        CRUD::field('name');
        CRUD::field('monster')
            ->label('Monster <span class="badge badge-pill badge-warning">New</span>')
            ->subfields(self::getMonsterSubfields())
            ->hint('<small class="float-right">Define the related Monster over a <code>hasOne</code> relationship (1-1).</small>');
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
        $field_types_that_dont_work = [
            'date_range', // TODO
            'upload',
            'upload_multiple',
            'select_and_order',
        ];

        $subfields = array_merge(
            MonsterCrudController::getFieldsArrayForSimpleTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForTimeAndSpaceTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForSelectsTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForRelationshipsTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForUploadsTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForWysiwygEditorsTab(),
            [[   // CustomHTML
                'name'  => 'separator',
                'type'  => 'custom_html',
                'value' => '<hr>',
            ]],
            MonsterCrudController::getFieldsArrayForMiscellaneousTab(),
        );

        foreach ($subfields as $key => $subfield) {
            if (isset($subfield['subfields'])) {
                unset($subfields[$key]);
            }

            if (!isset($subfield['type'])) {
                continue;
            }

            if (in_array($subfield['type'], $field_types_that_dont_work)) {
                unset($subfields[$key]);
            }
        }

        return $subfields;
    }
}
