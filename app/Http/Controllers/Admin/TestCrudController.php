<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TestRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TestRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class TestCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Test');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/test');
        $this->crud->setEntityNameStrings('test', 'tests');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn('text'); // add a text column, at the end of the stack
        $this->crud->addColumn('textarea'); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // -------------------------
        // ------ CRUD FIELDS ------
        // -------------------------

        // ----------
        // SIMPLE tab
        // ----------
        $this->crud->addField([
            'name'  => 'text',
            'label' => 'Text',
            'type'  => 'text',
            'tab'   => 'Simple',
        ]);

        $this->crud->addField([
            'name'  => 'email',
            'label' => 'Email',
            'type'  => 'email',
            'tab'   => 'Simple',
        ]);

        $this->crud->addField([   // Textarea
            'name'  => 'textarea',
            'label' => 'Textarea',
            'type'  => 'textarea',
            'tab'   => 'Simple',
        ]);

        $this->crud->addField([   // Number
            'name'  => 'number',
            'label' => 'Number',
            'type'  => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00",
            'tab' => 'Simple',
        ]);

        $this->crud->addField([   // Number
            'name'  => 'float',
            'label' => 'Float',
            'type'  => 'number',
            // optionals
            'attributes' => ['step' => 'any'], // allow decimals
            // 'prefix' => "$",
            // 'suffix' => ".00",
            'tab' => 'Simple',
        ]);

        $this->crud->addField([   // Number
            'name'  => 'number_with_prefix',
            'label' => 'Number with prefix',
            'type'  => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            'prefix' => '$',
            // 'suffix' => ".00",
            'fake'     => true,
            'store_in' => 'extras',
            'tab'      => 'Simple',
        ]);

        $this->crud->addField([   // Number
            'name'  => 'number_with_suffix',
            'label' => 'Number with suffix',
            'type'  => 'number',
            // optionals
            // 'attributes' => ["step" => "any"], // allow decimals
            // 'prefix' => "$",
            'suffix'   => '.00',
            'fake'     => true,
            'store_in' => 'extras',
            'tab'      => 'Simple',
        ]);

        $this->crud->addField([   // Number
            'name'     => 'text_with_both_prefix_and_suffix',
            'label'    => 'Text with both prefix and suffix',
            'type'     => 'number',
            'prefix'   => '@',
            'suffix'   => "<i class='fa fa-home'></i>",
            'fake'     => true,
            'store_in' => 'extras',
            'tab'      => 'Simple',
        ]);

        $this->crud->addField([   // Password
            'name'  => 'password',
            'label' => 'Password',
            'type'  => 'password',
            'tab'   => 'Simple',
        ]);

        $this->crud->addField([
            'name'        => 'radio', // the name of the db column
            'label'       => 'Status (radio)', // the input label
            'type'        => 'radio',
            'options'     => [ // the key will be stored in the db, the value will be shown as label;
                                0 => 'Draft',
                                1 => 'Published',
                                2 => 'Other',
                            ],
            // optional
            'inline'      => true, // show the radios all on the same line?
            'tab'         => 'Simple',
        ]);

        $this->crud->addField([   // Checkbox
            'name'  => 'checkbox',
            'label' => 'I have not read the terms and conditions and I never will (checkbox)',
            'type'  => 'checkbox',
            'tab'   => 'Simple',
        ]);

        $this->crud->addField([   // Hidden
            'name'    => 'hidden',
            'type'    => 'hidden',
            'default' => 'hidden value',
            'tab'     => 'Simple',
        ]);

        // -----------------
        // DATE, TIME AND SPACE tab
        // -----------------

        $this->crud->addField([   // Month
            'name'  => 'week',
            'label' => 'Week',
            'type'  => 'week',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([   // Month
            'name'  => 'month',
            'label' => 'Month',
            'type'  => 'month',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([   // Date
            'name'  => 'date',
            'label' => 'Date (HTML5 spec)',
            'type'  => 'date',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([   // Date
            'name'  => 'date_picker',
            'label' => 'Date (jQuery plugin)',
            'type'  => 'date_picker',
            // optional:
            'date_picker_options' => [
                'todayBtn' => true,
                'format'   => 'dd-mm-yyyy',
                'language' => 'en',
            ],
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([   // DateTime
            'name'  => 'datetime',
            'label' => 'Datetime (HTML5 spec)',
            'type'  => 'datetime',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);
        $this->crud->addField([   // DateTime
            'name'  => 'datetime_picker',
            'label' => 'Datetime picker (jQuery plugin)',
            'type'  => 'datetime_picker',
            // optional:
            'datetime_picker_options' => [
                'format'   => 'DD/MM/YYYY HH:mm',
                'language' => 'en',
            ],
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([ // Date_range
            'name'       => 'date_range', // a unique name for this field
            'start_name' => 'start_date', // the db column that holds the start_date
            'end_name'   => 'end_date', // the db column that holds the end_date
            'label'      => 'Date Range',
            'type'       => 'date_range',
            // OPTIONALS
            'start_default'      => '2017-03-28 01:01', // default value for start_date
            'end_default'        => '2017-04-05 02:00', // default value for end_date
            'date_range_options' => [ // options sent to daterangepicker.js
                'timePicker' => true,
                'locale'     => ['format' => 'DD/MM/YYYY HH:mm'],
            ],
            'tab' => 'Time and space',
        ]);

        $this->crud->addField([   // Address
            'name'  => 'address',
            'label' => 'Address (Algolia Places search)',
            'type'  => 'address',
            // optional
            'store_as_json' => true,
            'tab'           => 'Time and space',
        ], 'both'); // the second parameter for the addField method is the form it should place this field in; specify either 'create', 'update' or 'both'; default is 'both', so you might aswell not mention it;

        // -----------------
        // SELECTS tab
        // -----------------
        //
        // $table->string('range')->nullable;
        // $table->integer('select')->nullable;
        // $table->string('select_from_array')->nullable;
        // $table->string('select_from_ajax')->nullable;
        // // select_multiple
        // $table->string('select2_from_array')->nullable;
        // // select2_from_ajax_multiple

        // -----------------
        // UPLOADS tab
        // -----------------
        $this->crud->addField([   // Browse
            'name'  => 'browse',
            'label' => 'Browse (using elFinder)',
            'type'  => 'browse',
            'tab'   => 'Uploads',
        ]);

        $this->crud->addField([ // base64_image
            'label'        => 'Base64 Image - includes cropping',
            'name'         => 'base64_image',
            'filename'     => null, // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'src'          => null, // null to read straight from DB, otherwise set to model accessor function
            'tab'          => 'Uploads',
        ]);

        // $table->string('image')->nullable;
        // $table->string('upload')->nullable;
        // $table->string('upload_multiple')->nullable;

        // -----------------
        // BIG TEXTS tab
        // -----------------
        $this->crud->addField([   // SimpleMDE
            'name'  => 'simplemde',
            'label' => 'SimpleMDE - markdown editor',
            'type'  => 'simplemde',
            'tab'   => 'Big texts',
        ]);

        $this->crud->addField([   // Summernote
            'name'  => 'summernote',
            'label' => 'Summernote editor',
            'type'  => 'summernote',
            'tab'   => 'Big texts',
        ]);

        $this->crud->addField([   // CKEditor
            'name'  => 'wysiwyg',
            'label' => 'CKEditor - also called the WYSIWYG field',
            'type'  => 'ckeditor',
            'tab'   => 'Big texts',
        ]);

        $this->crud->addField([   // TinyMCE
            'name'  => 'tinymce',
            'label' => 'TinyMCE',
            'type'  => 'tinymce',
            'tab'   => 'Big texts',
        ]);

        // -----------------
        // MISCELLANEOUS tab
        // -----------------
        $this->crud->addField([   // Color
            'name'  => 'color',
            'label' => 'Color picker (HTML5 spec)',
            'type'  => 'color',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Miscellaneous',
        ]);
        $this->crud->addField([   // Color
            'name'  => 'color_picker',
            'label' => 'Color picker (jQuery plugin)',
            'type'  => 'color_picker',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab' => 'Miscellaneous',
        ]);

        $this->crud->addField([
            'label'   => 'Icon Picker',
            'name'    => 'icon_picker',
            'type'    => 'icon_picker',
            'iconset' => 'fontawesome', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
            'tab'     => 'Miscellaneous',
        ]);

        // $table->text('table')->nullable;
        // $table->string('url')->nullable;
        // $table->text('video')->nullable;

        // $this->crud->removeField('name', 'update/create/both');

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD DETAILS ROW
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row.test');

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

        $this->addCustomCrudFilters();
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

    public function addCustomCrudFilters()
    {
        $this->crud->addFilter([ // add a "simple" filter called Draft
          'type' => 'simple',
          'name' => 'checkbox',
          'label'=> 'Checked',
        ],
        false, // the simple filter has no values, just the "Draft" label specified above
        function () { // if the filter is active (the GET parameter "draft" exits)
            $this->crud->addClause('where', 'checkbox', '1');
        });
    }
}
