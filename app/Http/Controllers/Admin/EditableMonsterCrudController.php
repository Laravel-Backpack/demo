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
            ->type('editable_text');

        CRUD::column('email')
            ->label('Email')
            ->type('editable_text');

        // demo editable_switch column
        CRUD::column('checkbox')
            ->label('Editable Switch')
            ->type('editable_switch');

        // demo editable_checkbox column
        // CRUD::column('editable_checkbox')
        //     ->label('Editable checkbox')
        //     ->type('editable_checkbox')
        //     ->fake(true);

        // demo editable_select column
        CRUD::column('select_from_array')
                ->label('Editable Select')
                ->type('editable_select')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three']);

        CRUD::column('text_and_email');
    }

    protected function setupMinorUpdateOperation()
    {
        $this->crud->setValidation(MonsterRequest::class);
    }
}
