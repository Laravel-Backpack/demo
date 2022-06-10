<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MonsterRequest;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EditableMonsterCrudController extends MonsterCrudController
{
    use \Backpack\EditableColumns\Http\Controllers\Operations\MinorUpdateOperation;

    public function setup()
    {
        parent::setup();

        CRUD::setRoute(config('backpack.base.route_prefix').'/editable-monster');
        CRUD::setEntityNameStrings('editable monster', 'editable monsters');
    }

    public function setupListOperation()
    {
        // demo editable_text column
        CRUD::column('text')
            ->label('Text')
            ->type('view')->view('backpack.editable-columns::columns.editable_text');
        CRUD::column('email')
            ->label('Email')
            ->type('view')->view('backpack.editable-columns::columns.editable_text');

        // demo editable_switch column
        CRUD::column('checkbox')
            ->label('Editable Switch')
            ->type('view')->view('backpack.editable-columns::columns.editable_switch');

        // demo editable_checkbox column
        // CRUD::column('editable_checkbox')
        //     ->label('Editable checkbox')
        //     ->type('view')->view('backpack.editable-columns::columns.editable_checkbox')
        //     ->fake(true);

        // demo editable_select column
        CRUD::column('select_from_array')
                ->label('Editable Select')
                ->type('view')->view('backpack.editable-columns::columns.editable_select')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three']);

        CRUD::column('text_and_email');
    }

    protected function setupMinorUpdateOperation()
    {
        $this->crud->setValidation(MonsterRequest::class);
    }
}
