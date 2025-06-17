<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IconRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;

class IconCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\ReviseOperation\ReviseOperation;

    public function setup()
    {
        $this->crud->setModel(\App\Models\Icon::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/icon');
        $this->crud->setEntityNameStrings('icon', 'icons');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns(['name', 'icon']);

        $this->crud->addFilter([
            'type'  => 'date_range',
            'name'  => 'created_at',
            'label' => 'Created At',
        ], null, function ($value) {
            $value = json_decode($value, true);

            // if the filter is active
            if ($value) {
                $this->crud->addClause('where', 'created_at', '>=', $value['from']);
                $this->crud->addClause('where', 'created_at', '<=', $value['to']);
            }
        });

        $this->crud->removeButton('update');
        $this->crud->addButton('line', 'inline_edit_icon', 'view', 'crud::buttons.inline_edit_icon', 'beginning');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        $this->crud->addField('name');
        $this->crud->addField([
            'label'   => 'Icon',
            'name'    => 'icon',
            'type'    => 'icon_picker',
            'iconset' => 'fontawesome4', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
