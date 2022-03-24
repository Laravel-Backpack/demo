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
        CRUD::setModel(\App\Models\Monster::class);
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
                    'class'   => static function ($crud, $column, $entry) {
                        return 'badge badge-'.($entry->{$column['name']} ? 'default' : 'success');
                    },
                ]);
        CRUD::column('checkbox')->key('check')->label('Agreed')->type('check');
        CRUD::column('created_at')->type('closure')->label('Created At')->function(function ($entry) {
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
        CRUD::button('open_google')->stack('line')->modelFunction('openGoogle')->makeFirst();

        $this->addCustomCrudFilters();
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::set('show.contentClass', 'col-md-12');

        CRUD::column('easymde')->type('markdown')->label('Markdown (EasyMDE)');
        CRUD::column('table')->type('table')->columns([
            'name'  => 'Name',
            'desc'  => 'Description',
            'price' => 'Price',
        ]);
        CRUD::column('name')->type('array_count')->key('table_count')->label('Array count');
        CRUD::column('extras')->type('array')->key('array')->label('Array');
        CRUD::column('table')
                ->key('multidimensional_array')
                ->type('multidimensional_array')
                ->label('Multidimensional Array')
                ->visible_key('name');
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
        CRUD::setOperationSetting('contentClass', 'col-md-12 bold-labels');

        CRUD::field('text')->type('text')->label('Text')
            ->tab('Simple')->size(6);

        CRUD::field('email')->type('email')->label('Email')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('textarea')->type('textarea')->label('Textarea')->tab('Simple');
        CRUD::field('number')->type('number')->label('Number')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-3']);

        CRUD::field('float')->type('number')->label('Float')->attributes(['step' => 'any'])
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-3']);

        CRUD::field('number_with_prefix')->type('number')
            ->prefix('$')->fake(true)->store_in('extras')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-3']);

        CRUD::field('number_with_suffix')->type('number')
            ->suffix('.00')->fake(true)->store_in('extras')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-3']);

        CRUD::field('text_with_both_prefix_and_suffix')->type('number')
            ->prefix('@')->suffix("<i class='la la-home'></i>")->fake(true)->store_in('extras')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('password')->type('password')
            ->tab('Simple')->wrapper(['class' => 'form-group col-md-6']);

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

        CRUD::field('week')
            ->type('week')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field('month')
            ->type('month')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field('date')
            ->type('date')
            ->label('Date (HTML5 spec)')
            ->attributes([
                'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
                'placeholder' => 'yyyy-mm-dd',
            ])
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field('date_picker')
            ->type('date_picker')
            ->label('Date (jQuery plugin)')
            ->date_picker_options([
                'todayBtn' => true,
                'format'   => 'dd-mm-yyyy',
                'language' => 'en',
            ])
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field('datetime')
            ->type('datetime')
            ->label('Datetime (HTML5 spec)')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field('datetime_picker')
            ->type('datetime_picker')
            ->label('Datetime picker (jQuery plugin)')
            ->datetime_picker_options([
                'format'   => 'DD/MM/YYYY HH:mm',
                'language' => 'en',
            ])
            ->wrapper(['class' => 'form-group col-md-6'])
            ->tab('Time and space');

        CRUD::field(['start_date', 'end_date'])
            ->type('date_range')
            ->label('Date Range')
            ->default(['2020-03-28 01:01', '2020-04-05 02:00'])
            ->date_range_options([
                'timePicker' => true,
                'locale'     => ['format' => 'DD/MM/YYYY HH:mm'],
            ])
            ->tab('Time and space');

        CRUD::field('address_algolia')
            ->type('address')
            ->label('Address (Algolia Places search)')
            ->store_as_json(true)
            ->tab('Time and space');

        // -----------------
        // SELECTS tab
        // -----------------

        CRUD::field('select_1_n_heading')->type('custom_html')->tab('Selects')
                ->value('<h5 class="mb-0 text-primary">1-n Relationships (HasOne, BelongsTo)</h5>');

        CRUD::field('select')
                ->type('select')
                ->label('Select (HTML Spec Select Input for 1-n relationship)')
                ->entity('category')
                ->attribute('name')
                ->model('Backpack\NewsCRUD\app\Models\Category')
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select2')
                ->type('select2')
                ->label('Select2 (1-n relationship)')
                ->entity('category')
                ->attribute('name')
                ->model('Backpack\NewsCRUD\app\Models\Category')
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select2_from_ajax')
                ->type('select2_from_ajax')
                ->label("Article <small class='font-light'>(select2_from_ajax for a 1-n relationship)</small>")
                ->entity('article')
                ->attribute('title')
                ->model('Backpack\NewsCRUD\app\Models\Article')
                ->data_source(url('api/article'))
                ->placeholder('Select an article')
                ->minimum_input_length(2)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('icon_id')
                ->type('relationship')
                ->label('Relationship (1-n with InlineCreate; no AJAX) <span class="badge badge-warning">New in 4.1</span>')
                // ->entity('icon')
                ->attribute('name')
                // ->data_source(backpack_url('monster/fetch/icon'))
                ->inline_create(true)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select_n_n_heading')->type('custom_html')->tab('Selects')
            ->value('<h5 class="mb-0 mt-3 text-primary">n-n Relationship with Pivot Table (HasMany, BelongsToMany)</h5>');

        CRUD::field('tags')
                ->type('select_multiple')
                ->label('Select_multiple (n-n relationship with pivot table)')
                ->entity('tags')
                ->attribute('name')
                ->model('Backpack\NewsCRUD\app\Models\Tag')
                ->pivot(true)
                ->tab('Selects');

        CRUD::field('categories')
                ->type('select2_multiple')
                ->label('Select2_multiple (n-n relationship with pivot table)')
                ->entity('categories')
                ->attribute('name')
                ->model(\Backpack\NewsCRUD\app\Models\Category::class)
                ->allows_null(true)
                ->pivot(true)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('articles')
                ->type('select2_from_ajax_multiple')
                ->label("Articles <small class='font-light'>(select2_from_ajax_multiple for an n-n relationship with pivot table)</small>")
                ->entity('articles')
                ->attribute('title')
                ->model(\Backpack\NewsCRUD\app\Models\Article::class)
                ->data_source(url('api/article'))
                ->placeholder('Select one or more articles')
                ->minimum_input_length(2)
                ->pivot(true)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('products')
                ->type('relationship')
                ->label('Relationship (n-n with InlineCreate; Fetch using AJAX) <span class="badge badge-warning">New in 4.1</span>')
                ->entity('products')
                // ->attribute('name')
                ->ajax(true)
                ->data_source(backpack_url('monster/fetch/product'))
                // ->inline_create(true) // TODO: make it work this way too
                ->inline_create(['entity' => 'product'])
                // ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select_heading')->type('custom_html')->tab('Selects')
            ->value('<h5 class="mb-0 mt-3 text-primary">No Relationship</h5>');

        CRUD::field('select_from_array')
                ->type('select_from_array')
                ->label('Select_from_array (no relationship, 1-1 or 1-n)')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three'])
                ->allows_null(true)
                ->allows_multiple(false)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select2_from_array')
                ->type('select2_from_array')
                ->label('Select2_from_array (no relationship, 1-1 or 1-n)')
                ->options(['one' => 'One', 'two' => 'Two', 'three' => 'Three'])
                ->allows_null(true)
                ->allows_multiple(false)
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Selects');

        CRUD::field('select_and_order')
                ->type('select_and_order')
                ->label('Select and order')
                ->options([
                    1 => 'Option 1',
                    2 => 'Option 2',
                    3 => 'Option 3',
                    4 => 'Option 4',
                    5 => 'Option 5',
                    6 => 'Option 6',
                    7 => 'Option 7',
                    8 => 'Option 8',
                    9 => 'Option 9',
                ])
                ->fake(true)
                ->tab('Selects');

        // -----------------
        // UPLOADS tab
        // -----------------

        if (app('env') == 'production') {
            CRUD::field('separator')
                ->type('custom_html')
                ->value('<p><small><strong>Note: </strong>In the online demo we\'ve restricted the upload and media library fields a lot, or hidden them entirely. To test them out, you can <a target="_blank" href="https://backpackforlaravel.com/docs/demo">download and install this demo admin panel</a> in your local environment.</small></p>')
                ->tab('Uploads');
        }

        CRUD::field('browse')
                ->type('browse')
                ->label('Browse (using elFinder)')
                ->tab('Uploads');

        CRUD::field('browse_multiple')
                ->type('browse_multiple')
                ->label('Browse multiple')
                ->sortable(true)
                // ->multiple(true)
                // ->mime_types(null)
                ->tab('Uploads');

        CRUD::field('upload')
                ->type('upload')
                ->label('Upload')
                ->upload(true)
                ->disk('uploads')
                ->tab('Uploads');

        CRUD::field('upload_multiple')
                ->type('upload_multiple')
                ->upload(true)
                ->tab('Uploads');

        CRUD::field('base64_image')
                ->type('base64_image')
                ->label('Base64 Image - includes cropping')
                ->crop(true)
                ->filename(null)
                ->aspect_ratio(1)
                ->src(null) // null to read straight from DB, else model accessor
                ->tab('Uploads');

        CRUD::field('image')
                ->type('image')
                ->label('Image - includes cropping')
                ->upload(true)
                ->crop(true)
                ->aspect_ratio(1)
                ->src(null) // null to read straight from DB, else model accessor
                ->tab('Uploads');

        // -----------------
        // BIG TEXTS tab
        // -----------------

        CRUD::field('easymde')
                ->type('easymde')
                ->label('EasyMDE - markdown editor')
                ->tab('Big texts')
                ->fake(true);

        CRUD::field('summernote')
                ->type('summernote')
                ->label('Summernote editor')
                ->tab('Big texts');

        CRUD::field('wysiwyg')
                ->type('ckeditor')
                ->label('CKEditor - also called the WYSIWYG field')
                ->tab('Big texts');

        CRUD::field('tinymce')
                ->type('tinymce')
                ->label('TinyMCE')
                ->tab('Big texts');

        // -----------------
        // MISCELLANEOUS tab
        // -----------------

        CRUD::field('color')
                ->type('color')
                ->label('Color picker (HTML5 spec)')
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Miscellaneous');

        CRUD::field('color_picker')
                ->type('color_picker')
                ->label('Color picker (jQuery plugin)')
                ->wrapper(['class' => 'form-group col-md-6'])
                ->tab('Miscellaneous');

        CRUD::field('video')
                ->type('video')
                ->label('Video - link to video file on Youtube or Vimeo')
                ->tab('Miscellaneous')
                ->wrapper(['class' => 'form-group col-md-5']);

        CRUD::field('range')
                ->type('range')
                ->label('range')
                // optional
                ->attributes([
                    'min' => 0,
                    'max' => 10,
                ])
                ->tab('Miscellaneous')
                ->wrapper(['class' => 'form-group col-md-5']);

        CRUD::field('icon_picker')
                ->type('icon_picker')
                ->label('Icon Picker')
                ->iconset('fontawesome')
                ->wrapper(['class' => 'form-group col-md-2'])
                ->tab('Miscellaneous');

        CRUD::field('table')
                ->type('table')
                ->label('Table')
                ->columns([
                    'name'  => 'Name',
                    'desc'  => 'Description',
                    'price' => 'Price',
                ])
                ->min(0)
                ->max(5)
                ->tab('Miscellaneous');

        CRUD::field('fake_table')
                ->type('table')
                ->label('Fake Table')
                ->fake(true)
                ->columns([
                    'name'  => 'Name',
                    'desc'  => 'Description',
                    'price' => 'Price',
                ])
                ->min(0)
                ->max(5)
                ->tab('Miscellaneous');

        CRUD::field('url')
                ->type('url')
                ->label('URL')
                ->tab('Miscellaneous');

        CRUD::field('url')->remove();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function addCustomCrudFilters()
    {
        CRUD::filter('checkbox')
                ->type('simple')
                ->label('Simple')
                ->whenActive(function () {
                    CRUD::addClause('where', 'checkbox', '1');
                });

        CRUD::filter('select_from_array')
                ->type('dropdown')
                ->label('Dropdown')
                ->values(['one' => 'One', 'two' => 'Two', 'three' => 'Three'])
                ->whenActive(function ($value) {
                    CRUD::addClause('where', 'select_from_array', $value);
                });

        CRUD::filter('text')
                ->type('text')
                ->label('Text')
                ->whenActive(function ($value) {
                    CRUD::addClause('where', 'text', 'LIKE', "%$value%");
                });

        CRUD::filter('number')
                ->type('range')
                ->label('Range')
                ->label_from('min value')
                ->label_to('max value')
                ->whenActive(function ($value) {
                    $range = json_decode($value);
                    if ($range->from && $range->to) {
                        CRUD::addClause('where', 'number', '>=', (float) $range->from);
                        CRUD::addClause('where', 'number', '<=', (float) $range->to);
                    }
                });

        CRUD::filter('date')
                ->type('date')
                ->label('Date')
                ->whenActive(function ($value) {
                    CRUD::addClause('where', 'date', '=', $value);
                });

        CRUD::filter('date_range')
                ->type('date_range')
                ->label('Date range')
                ->whenActive(function ($value) {
                    $dates = json_decode($value);
                    CRUD::addClause('where', 'date', '>=', $dates->from);
                    CRUD::addClause('where', 'date', '<=', $dates->to);
                });

        CRUD::filter('select2')
                ->type('select2')
                ->label('Select2')
                ->values(function () {
                    return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
                })->whenActive(function ($value) {
                    CRUD::addClause('where', 'select2', $value);
                });

        CRUD::filter('select2_multiple')
                ->type('select2_multiple')
                ->label('S2 multiple')
                ->values(function () {
                    return \Backpack\NewsCRUD\app\Models\Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
                })->whenActive(function ($values) {
                    foreach (json_decode($values) as $key => $value) {
                        CRUD::addClause('orWhere', 'select2', $value);
                    }
                });

        CRUD::filter('select2_from_ajax')
                ->type('select2_ajax')
                ->label('S2 Ajax')
                ->placeholder('Pick an article')
                ->values(url('api/article-search'))
                ->whenActive(function ($value) {
                    CRUD::addClause('where', 'select2_from_ajax', $value);
                });
    }
}
