<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MonsterRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;

class MonsterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        $this->crud->setModel(\App\Models\Monster::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/monster');
        $this->crud->setEntityNameStrings('monster', 'monsters');

        $this->crud->set('show.setFromDb', false);
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

    public function setupListOperation()
    {
        $this->crud->addColumns([
            'text',
            'textarea',
            'articles', // relationship column
            [
                'name'  => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type'  => 'image',
            ],
            [
                'name'  => 'base64_image', // The db column name
                'label' => 'Base64 Image', // Table column heading
                'type'  => 'image',
            ],
            [
                'name'  => 'checkbox',
                'label' => 'Boolean',
                'type'  => 'boolean',
                // optionally override the Yes/No texts
                'options' => [0 => 'Yes', 1 => 'No'],
                'wrapper' => [
                    'element' => 'span',
                    'class'   => function ($crud, $column, $entry, $related_key) {
                        if ($column['text'] == 'Yes') {
                            return 'badge badge-success';
                        }

                        return 'badge badge-default';
                    },
                ],
            ],
            [
                'name'  => 'checkbox', // The db column name
                'key'   => 'check',
                'label' => 'Agreed', // Table column heading
                'type'  => 'check',
            ],
            [
                'name'     => 'created_at',
                'label'    => 'Created At',
                'type'     => 'closure',
                'function' => function ($entry) {
                    return 'Created on '.$entry->created_at;
                },
            ],
            [
                'name'  => 'name', // The db column name
                'label' => 'Date', // Table column heading
                'type'  => 'date',
            ],
            [
                'name'  => 'name', // The db column name
                'label' => 'Datetime', // Table column heading
                'type'  => 'datetime',
            ],
            [
                'name'  => 'email', // The db column name
                'label' => 'Email Address', // Table column heading
                'type'  => 'email',
            ],
            [
                // show both text and email values in one column
                // this column is here to demo and test the custom searchLogic functionality
                'name'          => 'model_function',
                'label'         => 'Text and Email', // Table column heading
                'type'          => 'model_function',
                'function_name' => 'getTextAndEmailAttribute', // the method in your Model
                'searchLogic'   => function ($query, $column, $searchTerm) {
                    $query->orWhere('email', 'like', '%'.$searchTerm.'%');
                    $query->orWhere('text', 'like', '%'.$searchTerm.'%');
                },
                'escaped'       => true,
            ],
            [
                'name'  => 'number', // The db column name
                'label' => 'Number', // Table column heading
                'type'  => 'number',
            ],
            [
                'name'        => 'radio',
                'label'       => 'Radio',
                'type'        => 'radio',
                'options'     => [0 => 'Draft', 1 => 'Published', 2 => 'Other'],
            ],
            [   // 1-n relationship
                'label'     => 'Select', // Table column heading
                'type'      => 'select',
                'name'      => 'select', // the column that contains the ID of that connected entity;
                'entity'    => 'category', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Category", // foreign key model
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category/'.$related_key.'/show');
                    },
                ],
            ],
            [   // select_from_array
                'name'    => 'select_from_array',
                'label'   => 'Select_from_array',
                'type'    => 'select_from_array',
                'options' => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
            ],
            [   // select_multiple: n-n relationship (with pivot table)
                'label'     => 'Select_multiple', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'tags', // the method that defines the relationship in your Model
                'entity'    => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ],
            ],
            [   // select_multiple: n-n relationship (with pivot table)
                'label'     => 'Relationship_count', // Table column heading
                'type'      => 'relationship_count',
                'name'      => 'categories', // the method that defines the relationship in your Model
                'entity'    => 'categories', // the method that defines the relationship in your Model
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category');
                    },
                ],
            ],
            [
                'name'  => 'video', // The db column name
                'label' => 'Video', // Table column heading
                'type'  => 'video',
            ],
        ]);

        $this->crud->enableDetailsRow();
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row.monster');
        $this->crud->enableExportButtons();
        $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');

        $this->addCustomCrudFilters();
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();

        $this->crud->set('show.contentClass', 'col-md-12');

        $this->crud->addColumn([   // SimpleMDE
            'name'    => 'simplemde',
            'label'   => 'Markdown (SimpleMDE)',
            'type'    => 'markdown',
        ]);

        $this->crud->addColumn([
            'name'            => 'table',
            'label'           => 'Table',
            'type'            => 'table',
            'columns'         => [
                'name'  => 'Name',
                'desc'  => 'Description',
                'price' => 'Price',
            ],
        ]);

        $this->crud->addColumn([
            'name'  => 'table', // The db column name
            'key'   => 'table_count',
            'label' => 'Array count', // Table column heading
            'type'  => 'array_count',
        ]);

        $this->crud->addColumn([
            'name'        => 'table', // The db column name
            'key'         => 'multidimensional_array',
            'label'       => 'Multidimensional Array', // Table column heading
            'type'        => 'multidimensional_array',
            'visible_key' => 'name',
        ]);

        $this->crud->addColumn([
            'name'          => 'category',
            'key'           => 'category_name',
            'label'         => 'Model Function Attribute', // Table column heading
            'type'          => 'model_function_attribute',
            'function_name' => 'getCategory', // the method in your Model
            'attribute'     => 'name',
        ]);

        $this->crud->addColumn([
            'name'  => 'number', // The db column name
            'key'   => 'phone',
            'label' => 'Phone', // Table column heading
            'type'  => 'phone',
        ]);

        $this->crud->addColumn([   // Upload
            'name'   => 'upload_multiple',
            'label'  => 'Upload Multiple',
            'type'   => 'upload_multiple',
            // 'prefix' => 'uploads/',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        $this->crud->setOperationSetting('contentClass', 'col-md-12 bold-labels');

        $this->crud->addFields(static::getFieldsArrayForSimpleTab());
        $this->crud->addFields(static::getFieldsArrayForTimeAndSpaceTab());
        $this->crud->addFields(static::getFieldsArrayForRelationshipsTab());
        $this->crud->addFields(static::getFieldsArrayForSelectsTab());
        $this->crud->addFields(static::getFieldsArrayForUploadsTab());
        $this->crud->addFields(static::getFieldsArrayForBigTextsTab());
        $this->crud->addFields(static::getFieldsArrayForMiscellaneousTab());

        $this->crud->removeField('url');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function addCustomCrudFilters()
    {
        $this->crud->addFilter(
            [ // add a "simple" filter called Draft
                'type'  => 'simple',
                'name'  => 'checkbox',
                'label' => 'Simple',
            ],
            false, // the simple filter has no values, just the "Draft" label specified above
        function () { // if the filter is active (the GET parameter "draft" exits)
            $this->crud->addClause('where', 'checkbox', '1');
        }
        );

        $this->crud->addFilter([ // dropdown filter
            'name' => 'select_from_array',
            'type' => 'dropdown',
            'label'=> 'Dropdown',
        ], ['one' => 'One', 'two' => 'Two', 'three' => 'Three'], function ($value) {
            // if the filter is active
            $this->crud->addClause('where', 'select_from_array', $value);
        });

        $this->crud->addFilter(
            [ // text filter
                'type'  => 'text',
                'name'  => 'text',
                'label' => 'Text',
            ],
            false,
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'text', 'LIKE', "%$value%");
            }
        );

        $this->crud->addFilter(
            [
                'name'       => 'number',
                'type'       => 'range',
                'label'      => 'Range',
                'label_from' => 'min value',
                'label_to'   => 'max value',
            ],
            false,
            function ($value) { // if the filter is active
                $range = json_decode($value);
                if ($range->from && $range->to) {
                    $this->crud->addClause('where', 'number', '>=', (float) $range->from);
                    $this->crud->addClause('where', 'number', '<=', (float) $range->to);
                }
            }
        );

        $this->crud->addFilter(
            [ // date filter
                'type'  => 'date',
                'name'  => 'date',
                'label' => 'Date',
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $this->crud->addClause('where', 'date', '=', $value);
            }
        );

        $this->crud->addFilter(
            [ // daterange filter
                'type' => 'date_range',
                'name' => 'date_range',
                'label'=> 'Date range',
                // 'date_range_options' => [
                // 'format' => 'YYYY/MM/DD',
                // 'locale' => ['format' => 'YYYY/MM/DD'],
                // 'showDropdowns' => true,
                // 'showWeekNumbers' => true
                // ]
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'date', '>=', $dates->from);
                $this->crud->addClause('where', 'date', '<=', $dates->to);
            }
        );

        $this->crud->addFilter([ // select2 filter
            'name' => 'select2',
            'type' => 'select2',
            'label'=> 'Select2',
        ], function () {
            return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'select2', $value);
        });

        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'select2_multiple',
            'type' => 'select2_multiple',
            'label'=> 'S2 multiple',
        ], function () {
            return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                $this->crud->addClause('orWhere', 'select2', $value);
            }
        });

        $this->crud->addFilter(
            [ // select2_ajax filter
                'name'        => 'select2_from_ajax',
                'type'        => 'select2_ajax',
                'label'       => 'S2 Ajax',
                'placeholder' => 'Pick an article',
            ],
            url('api/article-search'), // the ajax route
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'select2_from_ajax', $value);
            }
        );
    }

    public static function getFieldsArrayForSimpleTab()
    {
        return [
            [
                'name'              => 'text',
                'label'             => 'Text',
                'type'              => 'text',
                'tab'               => 'Simple',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name'              => 'email',
                'label'             => 'Email',
                'type'              => 'email',
                'tab'               => 'Simple',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [   // Textarea
                'name'  => 'textarea',
                'label' => 'Textarea',
                'type'  => 'textarea',
                'tab'   => 'Simple',
            ],
            [   // Number
                'name'              => 'number',
                'label'             => 'Number',
                'type'              => 'number',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'float',
                'label'             => 'Float',
                'type'              => 'number',
                'attributes'        => ['step' => 'any'], // allow decimals
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'number_with_prefix',
                'label'             => 'Number with prefix',
                'type'              => 'number',
                'prefix'            => '$',
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'number_with_suffix',
                'label'             => 'Number with suffix',
                'type'              => 'number',
                'suffix'            => '.00',
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'text_with_both_prefix_and_suffix',
                'label'             => 'Text with both prefix and suffix',
                'type'              => 'number',
                'prefix'            => '@',
                'suffix'            => "<i class='fa fa-home'></i>",
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Password
                'name'              => 'password',
                'label'             => 'Password',
                'type'              => 'password',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [
                'name'    => 'radio', // the name of the db column
                'label'   => 'Status (radio)', // the input label
                'type'    => 'radio',
                'options' => [ // the key will be stored in the db, the value will be shown as label;
                    0 => 'Draft',
                    1 => 'Published',
                    2 => 'Other',
                ],
                // optional
                'inline' => true, // show the radios all on the same line?
                'tab'    => 'Simple',
            ],
            [   // Checkbox
                'name'  => 'checkbox',
                'label' => 'I have not read the terms and conditions and I never will (checkbox)',
                'type'  => 'checkbox',
                'tab'   => 'Simple',
            ],
            [   // Hidden
                'name'    => 'hidden',
                'type'    => 'hidden',
                'default' => '6318',
                'tab'     => 'Simple',
            ],
        ];
    }

    public static function getFieldsArrayForTimeAndSpaceTab()
    {
        // -----------------
        // DATE, TIME AND SPACE tab
        // -----------------

        return [
            [   // Time
                'name'              => 'time',
                'label'             => 'Time',
                'type'              => 'time',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
                'fake'              => true,
            ],
            [   // Month
                'name'              => 'week',
                'label'             => 'Week',
                'type'              => 'week',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Month
                'name'              => 'month',
                'label'             => 'Month',
                'type'              => 'month',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                'name'       => 'date',
                'label'      => 'Date (HTML5 spec)',
                'type'       => 'date',
                'attributes' => [
                    'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
                    'placeholder' => 'yyyy-mm-dd',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                'name'  => 'date_picker',
                'label' => 'Date picker (jQuery plugin)',
                'type'  => 'date_picker',
                // optional:
                'date_picker_options' => [
                    'todayBtn' => true,
                    'format'   => 'dd-mm-yyyy',
                    'language' => 'en',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // DateTime
                'name'              => 'datetime',
                'label'             => 'Datetime (HTML5 spec)',
                'type'              => 'datetime',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // DateTime
                'name'  => 'datetime_picker',
                'label' => 'Datetime picker (jQuery plugin)',
                'type'  => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format'   => 'DD/MM/YYYY HH:mm',
                    'language' => 'en',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [ // Date_range
                'name'       => ['start_date', 'end_date'], // a unique name for this field
                'label'      => 'Date Range',
                'type'       => 'date_range',
                'default'    => ['2020-03-28 01:01', '2020-04-05 02:00'],
                // OPTIONALS
                'date_range_options' => [ // options sent to daterangepicker.js
                    'timePicker' => true,
                    'locale'     => ['format' => 'DD/MM/YYYY HH:mm'],
                ],
                'tab' => 'Time and space',
            ],
            [   // Address
                'name'  => 'address_algolia_string',
                'label' => 'Address_algolia (saved in db as string)',
                'type'  => 'address_algolia',
                'fake'  => true,
                // optional
                // 'store_as_json' => true,
                'tab'           => 'Time and space',
            ],
            [   // Address
                'name'  => 'address_algolia',
                'label' => 'Address_algolia (stored in db as json)',
                'type'  => 'address_algolia',
                // optional
                'store_as_json' => true,
                'tab'           => 'Time and space',
            ],
        ];
    }

    public static function getFieldsArrayForRelationshipsTab()
    {
        // -----------------
        // RELATIONSHIPS tab
        // -----------------

        return [
            // -----------------
            // n-n relationships
            // -----------------
            [   // CustomHTML
                'name'  => 'select_n_n_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 mt-3 text-primary">n-n Relationship with Pivot Table (HasMany, BelongsToMany)</h5>',
                'tab'   => 'Relationships',
            ],
            [       // Select_Multiple = n-n relationship
                'label'     => 'Select_multiple',
                'type'      => 'select_multiple',
                'name'      => 'tags', // the method that defines the relationship in your Model
                'entity'    => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'       => 'Relationships',
                // 'wrapperAttributes' => ['class' => 'form-group col-md-12'],
            ],
            [       // Select2Multiple = n-n relationship (with pivot table)
                'label'             => 'Select2_multiple',
                'type'              => 'select2_multiple',
                'name'              => 'categories', // the method that defines the relationship in your Model
                'entity'            => 'categories', // the method that defines the relationship in your Model
                'attribute'         => 'name', // foreign key attribute that is shown to user
                'model'             => "Backpack\NewsCRUD\app\Models\Category", // foreign key model
                'allows_null'       => true,
                'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'               => 'Relationships',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // Select2_from_ajax_multiple: n-n relationship with pivot table
                'label'                => 'Select2_from_ajax_multiple', // Table column heading
                'type'                 => 'select2_from_ajax_multiple',
                'name'                 => 'articles', // the column that contains the ID of that connected entity;
                'entity'               => 'articles', // the method that defines the relationship in your Model
                'attribute'            => 'title', // foreign key attribute that is shown to user
                'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
                'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
                'placeholder'          => 'Select one or more articles', // placeholder for the select
                'minimum_input_length' => 2, // minimum characters to type before querying results
                'pivot'                => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'                  => 'Relationships',
                'wrapperAttributes'    => ['class' => 'form-group col-md-6'],
            ],
            [    // Relationship
                'label'     => 'Relationship (also uses InlineCreate; Fetch using AJAX) <span class="badge badge-warning">New in 4.1</span>',
                'type'      => 'relationship',
                'name'      => 'products',
                'entity'    => 'products',
                // 'attribute' => 'name',
                'tab'       => 'Relationships',
                'ajax'      => true,
                // 'inline_create' => true, // TODO: make it work like this too
                'inline_create'     => [
                    'entity'      => 'product',
                    'modal_class' => 'modal-dialog modal-xl',
                ],
                'data_source'       => backpack_url('monster/fetch/product'),
                // 'wrapperAttributes' => ['class' => 'form-group col-md-12'],
            ],
            [
                'label'     => 'Checklist',
                'type'      => 'checklist',
                'name'      => 'roles',
                'entity'    => 'roles',
                'attribute' => 'name',
                'model'     => "Backpack\PermissionManager\app\Models\Role",
                'pivot'     => true,
                'tab'       => 'Relationships',
            ],

            // -----------------
            // 1-n relationships
            // -----------------
            [   // CustomHTML
                'name'  => 'select_1_n_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary">1-n Relationships (HasOne, BelongsTo)</h5>',
                'tab'   => 'Relationships',
            ],
            [    // SELECT
                'label'             => 'Select',
                'type'              => 'select',
                'name'              => 'select',
                'entity'            => 'category',
                'attribute'         => 'name',
                'model'             => "Backpack\NewsCRUD\app\Models\Category",
                'tab'               => 'Relationships',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // select_grouped
                'label'                      => 'Select_grouped',
                'type'                       => 'select_grouped', //https://github.com/Laravel-Backpack/CRUD/issues/502
                'name'                       => 'select_grouped_id',
                'fake'                       => true,
                'entity'                     => 'article',
                'model'                      => 'Backpack\NewsCRUD\app\Models\Article',
                'attribute'                  => 'title',
                'group_by'                   => 'category', // the relationship to entity you want to use for grouping
                'group_by_attribute'         => 'name', // the attribute on related model, that you want shown
                'group_by_relationship_back' => 'articles', // relationship from related model back to this model
                'tab'                        => 'Relationships',
                'wrapperAttributes'          => ['class' => 'form-group col-md-6'],
            ],
            [    // SELECT2
                'label'             => 'Select2',
                'type'              => 'select2',
                'name'              => 'select2',
                'entity'            => 'category',
                'attribute'         => 'name',
                'model'             => "Backpack\NewsCRUD\app\Models\Category",
                'tab'               => 'Relationships',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [   // select2_grouped
                'label'                      => 'Select2_grouped',
                'type'                       => 'select2_grouped', //https://github.com/Laravel-Backpack/CRUD/issues/502
                'name'                       => 'select2_grouped_id',
                'fake'                       => true,
                'entity'                     => 'article',
                'model'                      => 'Backpack\NewsCRUD\app\Models\Article',
                'attribute'                  => 'title',
                'group_by'                   => 'category', // the relationship to entity you want to use for grouping
                'group_by_attribute'         => 'name', // the attribute on related model, that you want shown
                'group_by_relationship_back' => 'articles', // relationship from related model back to this model
                'tab'                        => 'Relationships',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [   // select2_nested
                'name'                       => 'select2_nested_id',
                'label'                      => 'Select2_nested',
                'type'                       => 'select2_nested',
                'fake'                       => true,
                'entity'                     => 'category', // the method that defines the relationship in your Model
                'attribute'                  => 'name', // foreign key attribute that is shown to user
                'model'                      => "Backpack\NewsCRUD\app\Models\Category", // force foreign key model
                'tab'                        => 'Relationships',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [ // select2_from_ajax: 1-n relationship
                'label'                => 'Select2_from_ajax', // Table column heading
                'type'                 => 'select2_from_ajax',
                'name'                 => 'select2_from_ajax', // the column that contains the ID of that connected entity;
                'entity'               => 'article', // the method that defines the relationship in your Model
                'attribute'            => 'title', // foreign key attribute that is shown to user
                'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
                'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
                'placeholder'          => 'Select an article', // placeholder for the select
                'minimum_input_length' => 2, // minimum characters to type before querying results
                'tab'                  => 'Relationships',
                'wrapperAttributes'    => ['class' => 'form-group col-md-12'],
            ],
            [    // Relationship - nothing is explicitly defined, not even the field type
                'label'         => 'Relationship (no AJAX, inferred attributes) <span class="badge badge-warning">New in 4.1</span>',
                'name'          => 'icon',
                'tab'           => 'Relationships',
                // 'data_source' => backpack_url('monster/fetch/icon'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [    // Relationship - everything is explicitly defined
                'label'         => 'Relationship (no AJAX; also uses InlineCreate) <span class="badge badge-warning">New in 4.1</span>',
                'type'          => 'relationship',
                'name'          => 'fallback_icon',
                'fake'          => true,
                'entity'        => 'icon',
                'attribute'     => 'name',
                'tab'           => 'Relationships',
                'inline_create' => true,
                // 'data_source' => backpack_url('monster/fetch/icon'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            // -----------------
            // 1-1 relationships
            // -----------------
            [   // CustomHTML
                'name'  => 'select_1_1_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary">1-1 Relationships (HasOne)</h5> ',
                'tab'   => 'Relationships',
            ],
            [
                'name'    => 'address.street',
                'label'   => 'Address.street (auto-detected field type)',
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'tab'   => 'Relationships',
            ],
            [
                'name'    => 'address.country',
                'label'   => 'Address.country  (auto-detected field type)',
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'tab'   => 'Relationships',
            ],
            [
                'name'    => 'address.icon',
                'label'   => 'Address.icon  (auto-detected field type)',
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'tab'   => 'Relationships',
            ],

        ];
    }

    public static function getFieldsArrayForSelectsTab()
    {
        // -----------------
        // SELECTS tab
        // -----------------

        return [
            [ // CustomHTML
                'name'  => 'select_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary">No Relationship</h5>',
                'tab'   => 'Selects',
            ],
            [ // select_from_array
                'name'              => 'select_from_array',
                'label'             => 'Select_from_array (no relationship, 1-1 or 1-n)',
                'type'              => 'select_from_array',
                'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
                'allows_null'       => true,
                'tab'               => 'Selects',
                'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // select2_from_array
                'name'              => 'select2_from_array',
                'label'             => 'Select2_from_array (no relationship, 1-1 or 1-n)',
                'type'              => 'select2_from_array',
                'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
                'allows_null'       => true,
                'tab'               => 'Selects',
                'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // select_and_order
                'name'    => 'select_and_order',
                'label'   => 'Select_and_order',
                'type'    => 'select_and_order',
                'options' => [
                    1 => 'Option 1',
                    2 => 'Option 2',
                    3 => 'Option 3',
                    4 => 'Option 4',
                    5 => 'Option 5',
                    6 => 'Option 6',
                    7 => 'Option 7',
                    8 => 'Option 8',
                    9 => 'Option 9',
                ],
                'fake' => true,
                'tab'  => 'Selects',
            ],
        ];
    }

    public static function getFieldsArrayForUploadsTab()
    {
        // -----------------
        // UPLOADS tab
        // -----------------

        $fields = [];

        if (app('env') == 'production') {
            $fields[] = [   // CustomHTML
                'name'      => 'separator',
                'type'      => 'custom_html',
                'value'     => '<p><small><strong>Note: </strong>In the online demo we\'ve restricted the upload and media library fields a lot, or hidden them entirely. To test them out, you can <a target="_blank" href="https://backpackforlaravel.com/docs/demo">download and install this demo admin panel</a> in your local environment.</small></p>',
                'tab'       => 'Uploads',
            ];
        }

        $fields[] = [   // Browse
            'name'  => 'browse',
            'label' => 'Browse (using elFinder)',
            'type'  => 'browse',
            'tab'   => 'Uploads',
        ];

        $fields[] = [   // Browse multiple
            'name'     => 'browse_multiple',
            'label'    => 'Browse multiple',
            'type'     => 'browse_multiple',
            'tab'      => 'Uploads',
            'sortable' => true,
            // 'multiple' => true, // enable/disable the multiple selection functionality
            // 'mime_types' => null, // visible mime prefixes; ex. ['image'] or ['application/pdf']
        ];

        $fields[] = [   // Upload
            'name'   => 'upload',
            'label'  => 'Upload',
            'type'   => 'upload',
            'upload' => true,
            'disk'   => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ];

        $fields[] = [   // Upload
            'name'   => 'upload_multiple',
            'label'  => 'Upload Multiple',
            'type'   => 'upload_multiple',
            'upload' => true,
            // 'disk' => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ];

        $fields[] = [ // base64_image
            'label'        => 'Base64 Image - includes cropping',
            'name'         => 'base64_image',
            'filename'     => null, // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'src'          => null, // null to read straight from DB, otherwise set to model accessor function
            'tab'          => 'Uploads',
        ];

        $fields[] = [ // image
            'label'        => 'Image - includes cropping',
            'name'         => 'image',
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => config('backpack.base.root_disk_name'), // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            'tab' => 'Uploads',
        ];

        return $fields;
    }

    public static function getFieldsArrayForBigTextsTab()
    {
        // -----------------
        // BIG TEXTS tab
        // -----------------

        return [
            [   // SimpleMDE
                'name'  => 'easymde',
                'label' => 'EasyMDE - markdown editor (well-maintained fork of SimpleMDE)',
                'type'  => 'easymde',
                'tab'   => 'Big texts',
                'fake'  => true,
            ],
            [   // Summernote
                'name'  => 'summernote',
                'label' => 'Summernote editor',
                'type'  => 'summernote',
                'tab'   => 'Big texts',
            ],
            [   // CKEditor
                'name'  => 'wysiwyg',
                'label' => 'CKEditor - also called the WYSIWYG field',
                'type'  => 'ckeditor',
                'tab'   => 'Big texts',
            ],
            [   // TinyMCE
                'name'  => 'tinymce',
                'label' => 'TinyMCE',
                'type'  => 'tinymce',
                'tab'   => 'Big texts',
            ],
            [   // SimpleMDE
                'name'  => 'simplemde',
                'label' => 'SimpleMDE',
                'type'  => 'easymde',
                'tab'   => 'Big texts',
            ],
        ];
    }

    public static function getFieldsArrayForMiscellaneousTab()
    {
        // -----------------
        // MISCELLANEOUS tab
        // -----------------

        return [
            [   // Color
                'name'  => 'color',
                'label' => 'Color picker (HTML5 spec)',
                'type'  => 'color',
                // 'wrapperAttributes' => ['class' => 'col-md-6'],
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Color
                'name'  => 'color_picker',
                'label' => 'Color picker (jQuery plugin)',
                'type'  => 'color_picker',
                // 'wrapperAttributes' => ['class' => 'col-md-6'],
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // URL
                'name'              => 'video',
                'label'             => 'Video - link to video file on Youtube or Vimeo',
                'type'              => 'video',
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
            ],
            [   // Range
                'name'  => 'range',
                'label' => 'Range',
                'type'  => 'range',
                //optional
                'attributes' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
            ],
            [
                'label'             => 'Icon Picker',
                'name'              => 'icon_picker',
                'type'              => 'icon_picker',
                'iconset'           => 'fontawesome', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [ // Table
                'name'            => 'table',
                'label'           => 'Table',
                'type'            => 'table',
                'entity_singular' => 'subentry', // used on the "Add X" button
                'columns'         => [
                    'name'  => 'Name',
                    'desc'  => 'Description',
                    'price' => 'Price',
                ],
                'max' => 5, // maximum rows allowed in the table
                'min' => 0, // minimum rows allowed in the table
                'tab' => 'Miscellaneous',
            ],
            [ // Table
                'name'            => 'fake_table',
                'label'           => 'Fake Table',
                'type'            => 'table',
                'entity_singular' => 'subentry', // used on the "Add X" button
                'columns'         => [
                    'name'  => 'Name',
                    'desc'  => 'Description',
                    'price' => 'Price',
                ],
                'fake' => true,
                'max'  => 5, // maximum rows allowed in the table
                'min'  => 0, // minimum rows allowed in the table
                'tab'  => 'Miscellaneous',
            ],
            [
                'name'  => 'url',
                'type'  => 'url',
                'label' => 'URL',
                'tab'   => 'Miscellaneous',
            ],
        ];
    }
}
