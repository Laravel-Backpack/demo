<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ProductCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Product');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/product');
        $this->crud->setEntityNameStrings('product', 'products');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        $this->crud->addField([  // Select2
           'label'     => 'Category',
           'type'      => 'select2',
           'name'      => 'category_id', // the db column for the foreign key
           'entity'    => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           // 'wrapperAttributes' => [
           //     'class' => 'form-group col-md-6'
           //   ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            'tab' => 'Basic Info',
        ]);

        $this->crud->addField([   // Number
            'name'  => 'price',
            'label' => 'Price',
            'type'  => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            'prefix' => '$',
            'suffix' => '.00',
            // 'wrapperAttributes' => [
            //    'class' => 'form-group col-md-6'
            //  ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            'tab' => 'Basic Info',
        ]);

        $this->crud->addField([ // Text
            'name'  => 'name',
            'label' => 'Name',
            'type'  => 'text',
            'tab'   => 'Texts',

            // optional
            //'prefix' => '',
            //'suffix' => '',
            //'default'    => 'some value', // default value
            //'hint'       => 'Some hint text', // helpful text, show up after input
            //'attributes' => [
               //'placeholder' => 'Some text when empty',
               //'class' => 'form-control some-class'
             //], // extra HTML attributes and values your input might need
             //'wrapperAttributes' => [
               //'class' => 'form-group col-md-12'
             //], // extra HTML attributes for the field wrapper - mostly for resizing fields
             //'readonly'=>'readonly',
        ]);

        $this->crud->addField([   // Textarea
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
            'tab'   => 'Texts',
        ]);

        $this->crud->addField([   // Wysiwyg
            'name'  => 'details',
            'label' => 'Details',
            'type'  => 'wysiwyg',
            'tab'   => 'Texts',
        ]);

        $this->crud->addField([ // Table
            'name'            => 'features',
            'label'           => 'Features',
            'type'            => 'table',
            'entity_singular' => 'feature', // used on the "Add X" button
            'columns'         => [
                'name' => 'Feature',
                'desc' => 'Value',
            ],
            'max' => 25, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
            'tab' => 'Texts',
        ]);

        $this->crud->addField([ // Table
            'name'            => 'extra_features',
            'label'           => 'Extra Features',
            'type'            => 'table',
            'entity_singular' => 'extra feature', // used on the "Add X" button
            'columns'         => [
                'name' => 'Feature',
                'desc' => 'Value',
            ],
            'fake' => true,
            'max'  => 25, // maximum rows allowed in the table
            'min'  => 0, // minimum rows allowed in the table
            'tab'  => 'Texts',
        ]);

        $this->crud->addFields([
            [ // Text
                'name'  => 'meta_title',
                'label' => 'Meta Title',
                'type'  => 'text',
                'fake'  => true,
                'tab'   => 'Metas',
            ],
            [ // Text
                'name'  => 'meta_description',
                'label' => 'Meta Description',
                'type'  => 'text',
                'fake'  => true,
                'tab'   => 'Metas',
            ],
            [ // Text
                'name'  => 'meta_keywords',
                'label' => 'Meta Keywords',
                'type'  => 'text',
                'fake'  => true,
                'tab'   => 'Metas',
            ],
        ]);

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        $this->crud->addColumns(['name', 'description', 'price']); // add multiple columns, at the end of the stack
        $this->crud->addColumn([
           // 1-n relationship
           'label'     => 'Category', // Table column heading
           'type'      => 'select',
           'name'      => 'category_id', // the column that contains the ID of that connected entity;
           'entity'    => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

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
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
