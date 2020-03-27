<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MonsterRequest as StoreRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class FluentMonsterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        CRUD::setModel('App\Models\Monster');
        CRUD::setRoute(config('backpack.base.route_prefix').'/fluent-monster');
        CRUD::setEntityNameStrings('fluent monster', 'fluent monsters');
    }

    public function fetchProduct()
    {
        return $this->fetch(\App\Models\Product::class);
    }

    public function fetchIcon()
    {
        return $this->fetch(\App\Models\Icon::class);
    }

    public function setupListOperation()
    {
        CRUD::column('text');
        CRUD::column('textarea');
        CRUD::column('image')->type('image');
        CRUD::column('base64_image')->type('image')->label('Base64 Image');
        CRUD::column('checkbox')
                ->type('boolean')
                ->label('Boolean')
                ->options([0 => 'Yes', 1 => 'No'])
                ->wrapper([
                    'element' => 'span',
                    'class'   => function ($crud, $column, $entry, $related_key) {
                        if ($column['text'] == 'Yes') {
                            return 'badge badge-success';
                        }

                        return 'badge badge-default';
                    },
                ]);
        CRUD::column('checkbox')->key('check')->label('Agreed')->type('check');
        CRUD::column('created_at')->type('closure')->function(function ($entry) {
                    return 'Created on '.$entry->created_at;
                });
        CRUD::column('date')->type('date');
        CRUD::column('datetime')->type('datetime');
        CRUD::column('email')->type('email')->label('Email Address');
        // show both text and email values in one column
        // this column is here to demo and test the custom searchLogic functionality
        CRUD::column('model_function')
                ->type('model_function')
                ->label('Text and Email')
                ->function_name('getTextAndEmailAttribute')
                ->searchLogic(function ($query, $column, $searchTerm) {
                    $query->orWhere('email', 'like', '%'.$searchTerm.'%');
                    $query->orWhere('text', 'like', '%'.$searchTerm.'%');
                });
        CRUD::column('number')->type('number');
        CRUD::column('radio')
                ->type('radio')
                ->options([0 => 'Draft', 1 => 'Published', 2 => 'Other']);
        CRUD::column('select')
                ->type('select')
                ->entity('category')
                ->attribute('name')
                ->model("Backpack\NewsCRUD\app\Models\Category")
                ->wrapper([
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category/'.$related_key.'/show');
                    },
                ]);
        CRUD::column('select_from_array')
                ->type('select_from_array')
                ->label('Select_from_array')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three']);
        CRUD::column('tags')
                ->type('select_multiple')
                ->label('Select_multiple')
                ->entity('tags')
                ->attribute('name')
                ->model('Backpack\NewsCRUD\app\Models\Tag')
                ->wrapper([
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ]);
        CRUD::column('video')->type('video');

        CRUD::enableDetailsRow();
        CRUD::setDetailsRowView('vendor.backpack.crud.details_row.monster');
        CRUD::enableExportButtons();
        CRUD::addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');

        $this->addCustomCrudFilters();
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::set('show.contentClass', 'col-md-12');

        CRUD::column('simplemde')->type('markdown')->label('Markdown (SimpleMDE)');
        CRUD::column('table')->type('table')->columns([
                    'name'  => 'Name',
                    'desc'  => 'Description',
                    'price' => 'Price',
                ]);
        CRUD::column('name')->type('array_count')->key('table_count')->label('Array count');
        CRUD::column('extras')->type('array')->key('array')->label('Array');
        // CRUD::column('name')
        //         ->type('multidimensional_array')
        //         ->key('multidimensional_array')
        //         ->visible_key('name');
        CRUD::column('category')
                ->label('Model Function Attribute')
                ->type('model_function_attribute')
                ->function_name('getCategory')
                ->attribute('name');
        CRUD::column('number')->type('phone')->label('Phone')->key('phone');
        CRUD::column('upload_multiple')->type('upload_multiple')->prefix('uploads/');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StoreRequest::class);
        CRUD::setOperationSetting('contentClass', 'col-md-12');

        CRUD::field('text')->type('text')->label('Text')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-6', ]);

        CRUD::field('email')->type('email')->label('Email')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-6', ]);

        CRUD::field('textarea')->type('textarea')->label('Textarea')->tab('Simple');
        CRUD::field('number')->type('number')->label('Number')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-3', ]);

        CRUD::field('float')->type('number')->label('Float')->attributes(['step' => 'any'])
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-3', ]);

        CRUD::field('number_with_prefix')->type('number')
            ->prefix('$')->fake(true)->store_in('extras')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-3', ]);

        CRUD::field('number_with_suffix')->type('number')
            ->suffix('.00')->fake(true)->store_in('extras')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-3', ]);

        CRUD::field('text_with_both_prefix_and_suffix')->type('number')
            ->prefix('@')->suffix("<i class='la la-home'></i>")->fake(true)->store_in('extras')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-6', ]);

        CRUD::field('password')->type('password')
            ->tab('Simple')->wrapperAttributes([ 'class' => 'form-group col-md-6', ]);

        CRUD::field('radio')->type('radio')->label('Status (radio)')->options([ 
                // the key will be stored in the db, the value will be shown as label;
                0 => 'Draft',
                1 => 'Published',
                2 => 'Other',
            ])->inline(true)->tab('Simple');

        CRUD::field('checkbox')->type('checkbox')->label('I have not read the termins and conditions and I never will (checkbox)')->tab('Simple');

        CRUD::field('hidden')->type('hidden')->default('hidden value')->tab('Simple');

        // -----------------
        // DATE, TIME AND SPACE tab
        // -----------------

        CRUD::addField([   // Month
            'name'              => 'week',
            'label'             => 'Week',
            'type'              => 'week',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'tab'               => 'Time and space',
        ]);

        CRUD::addField([   // Month
            'name'              => 'month',
            'label'             => 'Month',
            'type'              => 'month',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'tab'               => 'Time and space',
        ]);

        CRUD::addField([   // Date
            'name'       => 'date',
            'label'      => 'Date (HTML5 spec)',
            'type'       => 'date',
            'attributes' => [
                'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
                'placeholder' => 'yyyy-mm-dd',
            ],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'tab'               => 'Time and space',
        ]);

        CRUD::addField([   // Date
            'name'  => 'date_picker',
            'label' => 'Date (jQuery plugin)',
            'type'  => 'date_picker',
            // optional:
            'date_picker_options' => [
                'todayBtn' => true,
                'format'   => 'dd-mm-yyyy',
                'language' => 'en',
            ],
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'tab'               => 'Time and space',
        ]);

        CRUD::addField([   // DateTime
            'name'              => 'datetime',
            'label'             => 'Datetime (HTML5 spec)',
            'type'              => 'datetime',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            'tab'               => 'Time and space',
        ]);

        CRUD::addField([   // DateTime
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
        ]);

        CRUD::addField([ // Date_range
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
        ]);

        CRUD::addField([   // Address
            'name'  => 'address',
            'label' => 'Address (Algolia Places search)',
            'type'  => 'address',
            // optional
            'store_as_json' => true,
            'tab'           => 'Time and space',
        ]); // the second parameter for the addField method is the form it should place this field in; specify either 'create', 'update' or 'both'; default is 'both', so you might aswell not mention it;

        // -----------------
        // SELECTS tab
        // -----------------

        CRUD::addField([   // CustomHTML
            'name'  => 'select_1_n_heading',
            'type'  => 'custom_html',
            'value' => '<h5 class="mb-0 text-primary">1-n Relationships (HasOne, BelongsTo)</h5>',
            'tab'   => 'Selects',
        ]);

        CRUD::addField([    // SELECT
            'label'     => 'Select (HTML Spec Select Input for 1-n relationship)',
            'type'      => 'select',
            'name'      => 'select',
            'entity'    => 'category',
            'attribute' => 'name',
            'model'     => "Backpack\NewsCRUD\app\Models\Category",
            'tab'       => 'Selects',
        ]);

        CRUD::addField([    // SELECT2
            'label'             => 'Select2 (1-n relationship)',
            'type'              => 'select2',
            'name'              => 'select2',
            'entity'            => 'category',
            'attribute'         => 'name',
            'model'             => "Backpack\NewsCRUD\app\Models\Category",
            'tab'               => 'Selects',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([ // select2_from_ajax: 1-n relationship
            'label'                => "Article <small class='font-light'>(select2_from_ajax for a 1-n relationship)</small>", // Table column heading
            'type'                 => 'select2_from_ajax',
            'name'                 => 'select2_from_ajax', // the column that contains the ID of that connected entity;
            'entity'               => 'article', // the method that defines the relationship in your Model
            'attribute'            => 'title', // foreign key attribute that is shown to user
            'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
            'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
            'placeholder'          => 'Select an article', // placeholder for the select
            'minimum_input_length' => 2, // minimum characters to type before querying results
            'tab'                  => 'Selects',
            'wrapperAttributes'    => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([    // Relationship
            'label'     => 'Relationship (1-n with InlineCreate; no AJAX) <span class="badge badge-warning">New in 4.1</span>',
            'type'      => 'relationship',
            'name'      => 'icon_id',
            // 'entity'    => 'icon',
            'attribute' => 'name',
            // 'tab'       => 'Selects',
            'inline_create' => true, // TODO: make this work
            // 'data_source' => backpack_url('monster/fetch/icon'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([   // CustomHTML
            'name'  => 'select_n_n_heading',
            'type'  => 'custom_html',
            'value' => '<h5 class="mb-0 mt-3 text-primary">n-n Relationship with Pivot Table (HasMany, BelongsToMany)</h5>',
            'tab'   => 'Selects',
        ]);

        CRUD::addField([       // Select_Multiple = n-n relationship
            'label'     => 'Select_multiple (n-n relationship with pivot table)',
            'type'      => 'select_multiple',
            'name'      => 'tags', // the method that defines the relationship in your Model
            'entity'    => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            'tab'       => 'Selects',
        ]);

        CRUD::addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label'             => 'Select2_multiple (n-n relationship with pivot table)',
            'type'              => 'select2_multiple',
            'name'              => 'categories', // the method that defines the relationship in your Model
            'entity'            => 'categories', // the method that defines the relationship in your Model
            'attribute'         => 'name', // foreign key attribute that is shown to user
            'model'             => "Backpack\NewsCRUD\app\Models\Category", // foreign key model
            'allows_null'       => true,
            'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
            'tab'               => 'Selects',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([ // Select2_from_ajax_multiple: n-n relationship with pivot table
            'label'                => "Articles <small class='font-light'>(select2_from_ajax_multiple for an n-n relationship with pivot table)</small>", // Table column heading
            'type'                 => 'select2_from_ajax_multiple',
            'name'                 => 'articles', // the column that contains the ID of that connected entity;
            'entity'               => 'articles', // the method that defines the relationship in your Model
            'attribute'            => 'title', // foreign key attribute that is shown to user
            'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
            'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
            'placeholder'          => 'Select one or more articles', // placeholder for the select
            'minimum_input_length' => 2, // minimum characters to type before querying results
            'pivot'                => true, // on create&update, do you need to add/delete pivot table entries?
            'tab'                  => 'Selects',
            'wrapperAttributes'    => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([    // Relationship
            'label'     => 'Relationship (n-n with InlineCreate; Fetch using AJAX) <span class="badge badge-warning">New in 4.1</span>',
            'type'      => 'relationship',
            'name'      => 'products',
            'entity'    => 'products',
            // 'attribute' => 'name',
            // 'tab'       => 'Selects',
            'ajax' => true,
            // 'inline_create' => true, // TODO: make it work like this too
            'inline_create'     => ['entity' => 'product'],
            'data_source'       => backpack_url('monster/fetch/product'),
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([   // CustomHTML
            'name'  => 'select_heading',
            'type'  => 'custom_html',
            'value' => '<h5 class="mb-0 mt-3 text-primary">No Relationship</h5>',
            'tab'   => 'Selects',
        ]);

        CRUD::addField([ // select_from_array
            'name'              => 'select_from_array',
            'label'             => 'Select_from_array (no relationship, 1-1 or 1-n)',
            'type'              => 'select_from_array',
            'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
            'allows_null'       => true,
            'tab'               => 'Selects',
            'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([ // select2_from_array
            'name'              => 'select2_from_array',
            'label'             => 'Select2_from_array (no relationship, 1-1 or 1-n)',
            'type'              => 'select2_from_array',
            'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
            'allows_null'       => true,
            'tab'               => 'Selects',
            'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([ // select_and_order
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
        ]);

        // -----------------
        // UPLOADS tab
        // -----------------

        if (app('env') == 'production') {
            CRUD::addField([   // CustomHTML
                'name'      => 'separator',
                'type'      => 'custom_html',
                'value'     => '<p><small><strong>Note: </strong>In the online demo we\'ve restricted the upload and media library fields a lot, or hidden them entirely. To test them out, you can <a target="_blank" href="https://backpackforlaravel.com/docs/demo">download and install this demo admin panel</a> in your local environment.</small></p>',
                'tab'       => 'Uploads',
            ]);
        }

        CRUD::addField([   // Browse
            'name'  => 'browse',
            'label' => 'Browse (using elFinder)',
            'type'  => 'browse',
            'tab'   => 'Uploads',
        ]);

        CRUD::addField([   // Browse multiple
            'name'     => 'browse_multiple',
            'label'    => 'Browse multiple',
            'type'     => 'browse_multiple',
            'tab'      => 'Uploads',
            'sortable' => true,
            // 'multiple' => true, // enable/disable the multiple selection functionality
            // 'mime_types' => null, // visible mime prefixes; ex. ['image'] or ['application/pdf']
        ]);

        CRUD::addField([   // Upload
            'name'   => 'upload',
            'label'  => 'Upload',
            'type'   => 'upload',
            'upload' => true,
            'disk'   => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ]);

        CRUD::addField([   // Upload
            'name'   => 'upload_multiple',
            'label'  => 'Upload Multiple',
            'type'   => 'upload_multiple',
            'upload' => true,
            // 'disk' => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ]);

        CRUD::addField([ // base64_image
            'label'        => 'Base64 Image - includes cropping',
            'name'         => 'base64_image',
            'filename'     => null, // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'src'          => null, // null to read straight from DB, otherwise set to model accessor function
            'tab'          => 'Uploads',
        ]);

        CRUD::addField([ // image
            'label'        => 'Image - includes cropping',
            'name'         => 'image',
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => config('backpack.base.root_disk_name'), // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            'tab' => 'Uploads',
        ]);

        // -----------------
        // BIG TEXTS tab
        // -----------------
        CRUD::addField([   // SimpleMDE
            'name'  => 'simplemde',
            'label' => 'SimpleMDE - markdown editor',
            'type'  => 'simplemde',
            'tab'   => 'Big texts',
        ]);

        CRUD::addField([   // Summernote
            'name'  => 'summernote',
            'label' => 'Summernote editor',
            'type'  => 'summernote',
            'tab'   => 'Big texts',
        ]);

        CRUD::addField([   // CKEditor
            'name'  => 'wysiwyg',
            'label' => 'CKEditor - also called the WYSIWYG field',
            'type'  => 'ckeditor',
            'tab'   => 'Big texts',
        ]);

        CRUD::addField([   // TinyMCE
            'name'  => 'tinymce',
            'label' => 'TinyMCE',
            'type'  => 'tinymce',
            'tab'   => 'Big texts',
        ]);

        // -----------------
        // MISCELLANEOUS tab
        // -----------------
        CRUD::addField([   // Color
            'name'  => 'color',
            'label' => 'Color picker (HTML5 spec)',
            'type'  => 'color',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab'               => 'Miscellaneous',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);
        CRUD::addField([   // Color
            'name'  => 'color_picker',
            'label' => 'Color picker (jQuery plugin)',
            'type'  => 'color_picker',
            // 'wrapperAttributes' => ['class' => 'col-md-6'],
            'tab'               => 'Miscellaneous',
            'wrapperAttributes' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'label'   => 'Icon Picker',
            'name'    => 'icon_picker',
            'type'    => 'icon_picker',
            'iconset' => 'fontawesome', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
            'tab'     => 'Miscellaneous',
        ]);

        CRUD::addField([ // Table
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
        ]);

        CRUD::addField([ // Table
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
        ]);

        // $table->string('url')->nullable;
        // $table->text('video')->nullable;
        CRUD::addField([   // URL
            'name'  => 'video',
            'label' => 'Video - link to video file on Youtube or Vimeo',
            'type'  => 'video',
            'tab'   => 'Miscellaneous',
        ]);
        // $table->string('range')->nullable;

        // CRUD::removeField('name', 'update/create/both');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function addCustomCrudFilters()
    {
        CRUD::filter('checkbox')
                ->type('simple')
                ->label('Simple')
                ->whenActive(function() {
                    CRUD::addClause('where', 'checkbox', '1');
                })->apply();

        CRUD::filter('select_from_array')
                ->type('dropdown')
                ->label('Dropdown')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three'])
                ->whenActive(function($value) {
                    CRUD::addClause('where', 'select_from_array', $value);
                })->apply();

        CRUD::filter('text')
                ->type('text')
                ->label('Text')
                ->whenActive(function($value) {
                    CRUD::addClause('where', 'text', 'LIKE', "%$value%");
                })->apply();

        CRUD::filter('number')
                ->type('range')
                ->label('Range')
                ->label_from('min value')
                ->label_to('max value')
                ->whenActive(function($value) {
                    $range = json_decode($value);
                    if ($range->from && $range->to) {
                        CRUD::addClause('where', 'number', '>=', (float) $range->from);
                        CRUD::addClause('where', 'number', '<=', (float) $range->to);
                    }
                })->apply();

        CRUD::filter('date')
                ->type('date')
                ->label('Date')
                ->whenActive(function($value) {
                    CRUD::addClause('where', 'date', '=', $value);
                })->apply();

        CRUD::filter('date_range')
                ->type('date_range')
                ->label('Date range')
                ->whenActive(function($value) {
                    $dates = json_decode($value);
                    CRUD::addClause('where', 'date', '>=', $dates->from);
                    CRUD::addClause('where', 'date', '<=', $dates->to);
                })->apply();

        CRUD::filter('select2')
                ->type('select2')
                ->label('Select2')
                ->options(function() {
                    return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
                })->whenActive(function($value) {
                    CRUD::addClause('where', 'select2', $value);
                })->apply();

        CRUD::filter('select2_multiple')
                ->type('select2_multiple')
                ->label('S2 multiple')
                ->options(function() {
                    return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
                })->whenActive(function($value) {
                    foreach (json_decode($values) as $key => $value) {
                        CRUD::addClause('orWhere', 'select2', $value);
                    }
                })->apply();

        CRUD::filter('select2_from_ajax')
                ->type('select2_ajax')
                ->label('S2 Ajax')
                ->placeholder('Pick an article')
                ->options(url('api/article-search'))
                ->whenActive(function($value) {
                    CRUD::addClause('where', 'select2_from_ajax', $value);
                })->apply();
    }
}
