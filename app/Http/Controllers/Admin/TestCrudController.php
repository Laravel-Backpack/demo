<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TestRequest as StoreRequest;
use App\Http\Requests\TestRequest as UpdateRequest;

class TestCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Test');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/test');
        $this->crud->setEntityNameStrings('test', 'tests');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn('text'); // add a single column, at the end of the stack
        $this->crud->addColumn('textarea'); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);


        // ------ CRUD FIELDS
        $this->crud->addField([   // Address
            'name' => 'address',
            'label' => 'Address',
            'type' => 'address',
            // optional
            'store_as_json' => true
        ], 'both'); // the second parameter for the addField method is the form it should place this field in; specify either 'create', 'update' or 'both'; default is 'both', so you might aswell not mention it;

        // $table->binary('base64_image')->nullable;
        // $table->string('browse')->nullable;
        // $table->boolean('checkbox')->nullable;
        // $table->text('wysiwyg')->nullable;
        // $table->string('color')->nullable;
        // $table->string('color_picker')->nullable;
        // $table->date('date')->nullable;
        // $table->date('date_picker')->nullable;
        // $table->date('start_date')->nullable;
        // $table->date('end_date')->nullable;
        // $table->dateTime('datetime')->nullable;
        // $table->dateTime('datetime_picker')->nullable;
        // $table->string('email')->nullable;
        // $table->integer('hidden')->nullable;
        // $table->string('icon_picker')->nullable;
        // $table->string('image')->nullable;
        // $table->string('month')->nullable;
        // $table->integer('number')->nullable;
        // $table->float('float')->nullable;
        // $table->string('password')->nullable;
        // $table->string('radio')->nullable;
        // $table->string('range')->nullable;
        // $table->integer('select')->nullable;
        // $table->string('select_from_array')->nullable;
        // $table->string('select_from_ajax')->nullable;
        // // select_multiple
        // $table->string('select2_from_array')->nullable;
        // // select2_from_ajax_multiple
        // $table->text('simplemde')->nullable;
        // $table->text('summernote')->nullable;
        // $table->text('table')->nullable;
        // $table->text('textarea')->nullable;
        // $table->string('text');
        $this->crud->addField('text'); // shorthand for adding a simple text field
        // $table->text('tinymce')->nullable;
        // $table->string('upload')->nullable;
        // $table->string('upload_multiple')->nullable;
        // $table->string('url')->nullable;
        // $table->text('video')->nullable;
        // $table->string('week')->nullable;


        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
