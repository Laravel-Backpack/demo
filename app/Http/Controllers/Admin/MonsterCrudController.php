<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MonsterRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Collection;

class MonsterCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\Pro\Http\Controllers\Operations\AjaxUploadOperation { ajaxUpload as traitAjaxUpload; }
    use Operations\SMSOperation; //Custom Form Operation Example
    use \Backpack\ActivityLog\Http\Controllers\Operations\ModelActivityOperation;
    use \Backpack\ActivityLog\Http\Controllers\Operations\EntryActivityOperation;

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

    public function fetchArticle()
    {
        return $this->fetch(\App\Models\Article::class);
    }

    public function fetchPaginatedTypes()
    {
        $types = [
            ['id' => 'informational', 'title' => 'Informational', 'location' => 'In-person'],
            ['id' => 'brainstorming', 'title' => 'Brainstorming', 'location' => 'In-person'],
            ['id' => 'decision-making', 'title' => 'Decision Making', 'location' => 'In-person'],
            ['id' => 'problem-solving', 'title' => 'Problem Solving', 'location' => 'In-person'],
            ['id' => 'training', 'title' => 'Training', 'location' => 'Virtual'],
            ['id' => 'planning', 'title' => 'Planning', 'location' => 'Virtual'],
            ['id' => 'social', 'title' => 'Social', 'location' => 'Virtual'],
            ['id' => 'networking', 'title' => 'Networking', 'location' => 'Hybrid'],
            ['id' => 'interview', 'title' => 'Interview', 'location' => 'Hybrid'],
            ['id' => 'review', 'title' => 'Review', 'location' => 'Hybrid'],
        ];

        Collection::macro('paginate', function (int $perPage = 15, int $page = null, array $options = []) {
            $page ??= \Illuminate\Pagination\Paginator::resolveCurrentPage() ?? 1;

            return new \Illuminate\Pagination\LengthAwarePaginator($this->forPage($page, $perPage)->toArray(), $this->count(), $perPage, $page, $options);
        });

        return collect($types)
            ->filter(fn (array $value): bool => str_contains(strtolower($value['title']), strtolower(request('q'))))
            ->paginate(4);
    }

    public function fetchSimpleTypes()
    {
        $types = [
            'informational'   => 'Informational',
            'brainstorming'   => 'Brainstorming',
            'decision-making' => 'Decision Making',
            'problem-solving' => 'Problem Solving',
            'training'        => 'Training',
            'planning'        => 'Planning',
            'social'          => 'Social',
            'networking'      => 'Networking',
            'interview'       => 'Interview',
            'review'          => 'Review',
        ];

        return collect($types)->filter(fn (string $value): bool => str_contains(strtolower($value), strtolower(request('q'))));
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name'  => 'text',
                'tab'   => 'Simple',
            ],
            [
                'name'  => 'textarea',
                'tab'   => 'Simple',
            ],
            [
                'name'  => 'articles', // relationship column
                'tab'   => 'Simple',
            ],
            [
                'name'  => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type'  => 'image',
                'tab'   => 'Uploads',
            ],
            [
                'name'  => 'base64_image', // The db column name
                'label' => 'Base64 Image'.backpack_pro_badge(), // Table column heading
                'type'  => 'image',
                'tab'   => 'Uploads',
            ],
            [
                'name'  => 'checkbox',
                'label' => 'Boolean',
                'type'  => 'boolean',
                // optionally override the Yes/No texts
                'options' => [0 => 'Yes', 1 => 'No'],
                'tab'     => 'Simple',
                'wrapper' => [
                    'element' => 'span',
                    'class'   => function ($crud, $column, $entry, $related_key) {
                        if ($column['text'] == 'Yes') {
                            return 'badge rounded-pill bg-success';
                        }

                        return 'badge rounded-pill bg-danger';
                    },
                ],
            ],
            [
                'name'  => 'checkbox', // The db column name
                'key'   => 'agreed',
                'label' => 'Agreed', // Table column heading
                'type'  => 'checkbox',
                'tab'   => 'Simple',
            ],
            [
                'name'     => 'created_at',
                'label'    => 'Created At',
                'type'     => 'closure',
                'function' => function ($entry) {
                    return 'Created on '.$entry->created_at;
                },
                'tab' => 'Miscellaneous',
            ],
            [
                'name'  => 'date', // The db column name
                'label' => 'Date', // Table column heading
                'type'  => 'date',
                'tab'   => 'Time and space',
            ],
            [
                'name'  => 'datetime', // The db column name
                'label' => 'Datetime', // Table column heading
                'type'  => 'datetime',
                'tab'   => 'Time and space',
            ],
            [
                'name'  => 'email', // The db column name
                'label' => 'Email Address', // Table column heading
                'type'  => 'email',
                'tab'   => 'Simple',
            ],
            [
                'name'          => 'status',
                'type'          => 'enum',
                'label'         => 'Enum',
                'enum_function' => 'getReadableStatus',
                'tab'           => 'Simple',
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
                'tab'           => 'Miscellaneous',
            ],
            [
                'name'  => 'number', // The db column name
                'label' => 'Number', // Table column heading
                'type'  => 'number',
                'tab'   => 'Simple',
            ],
            [
                'name'        => 'radio',
                'label'       => 'Radio',
                'type'        => 'radio',
                'options'     => [0 => 'Draft', 1 => 'Published', 2 => 'Other'],
                'tab'         => 'Simple',
            ],
            [   // 1-n relationship
                'label'     => 'Select', // Table column heading
                'type'      => 'select',
                'name'      => 'select', // the column that contains the ID of that connected entity;
                'entity'    => 'category', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Category", // foreign key model
                'tab'       => 'Selects',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category/'.$related_key.'/show');
                    },
                ],
            ],
            [   // select_from_array
                'name'      => 'select_from_array',
                'label'     => 'Select_from_array',
                'type'      => 'select_from_array',
                'options'   => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
                'tab'       => 'Selects',
            ],
            [   // select_multiple: n-n relationship (with pivot table)
                'label'     => 'Select_multiple', // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'tags', // the method that defines the relationship in your Model
                'entity'    => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
                'tab'       => 'Selects',
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
                'tab'       => 'Relationship',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category');
                    },
                ],
            ],

        ]);

        $this->crud->enableDetailsRow();
        $this->crud->setDetailsRowView('vendor.backpack.crud.details_row.monster');
        $this->crud->enableExportButtons();
        $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');

        //quickly create a button
        $this->crud->button('email')->stack('top')->view('crud::buttons.quick')->meta([
            'access'  => true,
            'label'   => 'Quick Button',
            'icon'    => 'la la-fast-forward',
            'wrapper' => [
                // 'element' => 'a',
                'href'   => 'https://backpackforlaravel.com/docs/crud-buttons#creating-a-quick-button-1',
                'target' => '_blank',
                'title'  => 'Creating a quick button',
            ],
        ]);

        $this->addCustomCrudFilters();
    }

    public function setupShowOperation()
    {
        $this->crud->setOperationSetting('tabsEnabled', true);
        $this->setupListOperation();

        $this->crud->set('show.contentClass', 'col-md-12');

        $this->crud->addColumn([   // EasyMDE
            'name'    => 'easymde',
            'key'     => 'easymde_markdown',
            'label'   => 'Markdown'.backpack_pro_badge(),
            'type'    => 'markdown',
            'tab'     => 'WYSIWYG Editors',
        ]);

        $this->crud->addColumn([   // EasyMDE
            'name'    => 'easymde',
            'label'   => 'EasyMDE'.backpack_pro_badge(),
            'type'    => 'easymde',
            'tab'     => 'WYSIWYG Editors',
        ]);

        $this->crud->addColumn([
            'name'    => 'ckeditor',
            'type'    => 'ckeditor',
            'label'   => 'Ckeditor'.backpack_pro_badge(),
            'tab'     => 'WYSIWYG Editors',
        ]);

        $this->crud->addColumn([
            'name'   => 'summernote',
            'type'   => 'summernote',
            'label'  => 'Summernote',
            'tab'    => 'WYSIWYG Editors',
        ]);

        $this->crud->addColumn([
            'name'   => 'tinymce',
            'type'   => 'tinymce',
            'label'  => 'TinyMCE'.backpack_pro_badge(),
            'tab'    => 'WYSIWYG Editors',
        ]);

        $this->crud->addColumn([
            'name'      => 'features',
            'label'     => 'Features'.backpack_pro_badge(),
            'type'      => 'repeatable',
            'fake'      => true,
            'subfields' => [
                [
                    'name'    => 'feature',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
                [
                    'name'    => 'value',
                    'wrapper' => [
                        'class' => 'col-md-6',
                    ],
                ],
                [
                    'name'    => 'quantity',
                    'type'    => 'number',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
            ],
            'tab' => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'            => 'table',
            'label'           => 'Table'.backpack_pro_badge(),
            'type'            => 'table',
            'tab'             => 'Miscellaneous',
            'columns'         => [
                'name'  => 'Name',
                'desc'  => 'Description',
                'price' => 'Price',
            ],
        ]);

        $this->crud->addColumn([
            'name'  => 'browse_multiple', // The db column name
            'key'   => 'browse_multiple_array',
            'label' => 'Array'.backpack_pro_badge(), // Table column heading
            'type'  => 'array',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'table', // The db column name
            'key'   => 'table_count',
            'label' => 'Array count'.backpack_pro_badge(), // Table column heading
            'type'  => 'array_count',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'        => 'table', // The db column name
            'key'         => 'multidimensional_array',
            'label'       => 'Multidimensional Array', // Table column heading
            'type'        => 'multidimensional_array',
            'visible_key' => 'name',
            'tab'         => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'          => 'category',
            'key'           => 'category_name',
            'label'         => 'Model Function Attribute', // Table column heading
            'type'          => 'model_function_attribute',
            'function_name' => 'getCategory', // the method in your Model
            'attribute'     => 'name',
            'tab'           => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'number', // The db column name
            'key'   => 'phone',
            'label' => 'Phone', // Table column heading
            'type'  => 'phone',
            'tab'   => 'Simple',
        ]);

        $this->crud->addColumn([
            'name'  => 'switch',
            'label' => 'Switch',
            'type'  => 'switch',
            'tab'   => 'Simple',
        ]);

        $this->crud->addColumn([
            'name'  => 'switch',
            'key'   => 'check',
            'label' => 'Check',
            'type'  => 'check',
            'tab'   => 'Simple',
        ]);

        $this->crud->addColumn([
            'name'  => 'my_custom_html',
            'label' => 'Custom HTML',
            'type'  => 'custom_html',
            'value' => '<span class="text-danger">Something</span>',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'view',
            'label' => 'Custom View',
            'type'  => 'view',
            'view'  => 'crud::columns.custom_view_column_example',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'features',
            'key'   => 'json_features',
            'label' => 'JSON',
            'type'  => 'json',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'      => 'id',
            'type'      => 'number',
            'label'     => '#',
            'orderable' => false,
            'tab'       => 'Simple',
        ]);

        $this->crud->addColumn([
            'name'  => 'dummyproducts',
            'type'  => 'relationship',
            'label' => 'Relationship'.backpack_pro_badge(),
            'tab'   => 'Relationship',
        ]);

        $this->crud->addColumn([
            'name'  => 'address_google',
            'type'  => 'address_google',
            'label' => 'Address Google'.backpack_pro_badge(),
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'      => 'roles',
            'type'      => 'checklist',
            'label'     => 'Checklist',
            'entity'    => 'roles',
            'attribute' => 'name',
            'tab'       => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'  => 'color',
            'type'  => 'color',
            'label' => 'Color',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'date_picker',
            'type'  => 'date_picker',
            'label' => 'Date Picker'.backpack_pro_badge(),
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([ // Date_range
            'name'       => 'start_date,end_date', // two columns with a comma
            'label'      => 'Date Range'.backpack_pro_badge(),
            'type'       => 'date_range',
            'tab'        => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'  => 'datetime_picker',
            'type'  => 'datetime_picker',
            'label' => 'Datetime Picker'.backpack_pro_badge(),
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'  => 'location',
            'type'  => 'google_map',
            'label' => 'Google Map'.backpack_pro_badge(),
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'    => 'icon_picker',
            'type'    => 'icon_picker',
            'label'   => 'Icon Picker'.backpack_pro_badge(),
            'iconset' => 'fontawesome',
            'tab'     => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'month',
            'type'  => 'month',
            'label' => 'Month',
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'  => 'range',
            'type'  => 'range',
            'label' => 'Range',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'select_and_order',
            'type'  => 'select_and_order',
            'label' => 'Select And Order'.backpack_pro_badge(),
            'tab'   => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'   => 'select_grouped_id',
            'type'   => 'select_grouped',
            'label'  => 'Select Grouped',
            'entity' => 'article',
            'tab'    => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'   => 'select2',
            'type'   => 'select2',
            'label'  => 'Select2'.backpack_pro_badge(),
            'entity' => 'categorySelect2',
            'tab'    => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'   => 'select2_from_ajax',
            'type'   => 'select2_from_ajax',
            'label'  => 'Select2 From Ajax'.backpack_pro_badge(),
            'entity' => 'article',
            'tab'    => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'  => 'select2_from_array',
            'type'  => 'select2_from_array',
            'label' => 'Select2 From Array'.backpack_pro_badge(),
            'tab'   => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'   => 'select2_grouped_id',
            'type'   => 'select2_grouped',
            'label'  => 'Select2 Grouped'.backpack_pro_badge(),
            'entity' => 'article',
            'tab'    => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'  => 'categories',
            'type'  => 'select2_multiple',
            'label' => 'Select2 Multiple'.backpack_pro_badge(),
            'tab'   => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'   => 'select2_nested_id',
            'type'   => 'select2_nested',
            'label'  => 'Select2 Nested'.backpack_pro_badge(),
            'entity' => 'category',
            'tab'    => 'Selects',
        ]);

        $this->crud->addColumn([
            'name'  => 'slug',
            'type'  => 'slug',
            'label' => 'Slug'.backpack_pro_badge(),
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'time',
            'type'  => 'time',
            'label' => 'Time',
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'   => 'upload',
            'type'   => 'upload',
            'label'  => 'Upload',
            'disk'   => 'uploads',
            'tab'    => 'Uploads',
        ]);

        $this->crud->addColumn([   // Upload
            'name'   => 'upload_multiple',
            'label'  => 'Upload Multiple',
            'type'   => 'upload_multiple',
            'disk'   => 'public',
            'tab'    => 'Uploads',
        ]);

        $this->crud->addColumn([
            'name'  => 'browse',
            'type'  => 'browse',
            'label' => 'Browse'.backpack_pro_badge(),
            'tab'   => 'Uploads',
        ]);

        $this->crud->addColumn([
            'name'  => 'browse_multiple',
            'type'  => 'browse_multiple',
            'label' => 'Browse Multiple'.backpack_pro_badge(),
            'tab'   => 'Uploads',
        ]);

        $this->crud->addColumn([
            'label'        => 'Dropzone'.backpack_pro_badge(),
            'name'         => 'dropzone',
            'type'         => 'dropzone',
            'tab'          => 'Uploads',
        ]);

        $this->crud->addColumn([
            'name'  => 'url',
            'type'  => 'url',
            'label' => 'URL',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'week',
            'type'  => 'week',
            'label' => 'Week',
            'tab'   => 'Time and space',
        ]);

        $this->crud->addColumn([
            'name'  => 'video', // The db column name
            'label' => 'Video'.backpack_pro_badge(), // Table column heading
            'type'  => 'video',
            'tab'   => 'Miscellaneous',
        ]);

        $this->crud->addColumn([
            'name'  => 'browse_multiple',
            'key'   => 'browse_multiple_array',
            'type'  => 'array',
            'label' => 'Array'.backpack_pro_badge(),
            'tab'   => 'Miscellaneous',
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        $this->crud->setOperationSetting('contentClass', 'col-md-12 bold-labels');

        $this->crud->addFields(static::getFieldsArrayForSimpleTab());
        $this->crud->addFields(static::getFieldsArrayForTimeAndSpaceTab());
        $this->crud->addFields(static::getFieldsArrayForSelectsTab());
        $this->crud->addFields(static::getFieldsArrayForRelationshipsTab());
        $this->crud->addFields(static::getFieldsArrayForUploadsTab());
        $this->crud->addFields(static::getFieldsArrayForWysiwygEditorsTab());
        $this->crud->addFields(static::getFieldsArrayForMiscellaneousTab());

        if (env('GOOGLE_PLACES_KEY')) {
            $this->crud->addField([   // Address_google
                'name'          => 'address_google',
                'label'         => 'Address_google '.backpack_pro_badge(),
                'type'          => 'address_google',
                'fake'          => true,
                'store_as_json' => true,
                'tab'           => 'Time and space',
            ]);

            $this->crud->addField([
                'name'    => 'location',
                'label'   => 'Google_map '.backpack_pro_badge(),
                'type'    => 'google_map',
                'fake'    => true,
                'tab'     => 'Time and space',
            ]);
        }

        // if you want to test removeField, uncomment the following line
        // $this->crud->removeField('url');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        // disable editing the slug when editing
        $this->crud->field('slug')->target('')->attributes(['readonly' => 'readonly']);
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
                'method'      => 'POST',
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
                'label'             => 'Text'.backpack_free_badge(),
                'type'              => 'text',
                'tab'               => 'Simple',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
            [
                'name'              => 'slug',
                'label'             => 'Slug'.backpack_pro_badge(),
                'type'              => 'slug',
                'target'            => 'text',
                'tab'               => 'Simple',
                'fake'              => true,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
            [
                'name'              => 'email',
                'label'             => 'Email'.backpack_free_badge(),
                'type'              => 'email',
                'tab'               => 'Simple',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
            [   // Textarea
                'name'  => 'textarea',
                'label' => 'Textarea'.backpack_free_badge(),
                'type'  => 'textarea',
                'tab'   => 'Simple',
            ],
            [   // Number
                'name'              => 'number',
                'label'             => 'Number'.backpack_free_badge(),
                'type'              => 'number',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'float',
                'label'             => 'Float'.backpack_free_badge(),
                'type'              => 'number',
                'attributes'        => ['step' => 'any'], // allow decimals
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'number_with_prefix',
                'label'             => 'Number with prefix'.backpack_free_badge(),
                'type'              => 'number',
                'prefix'            => '$',
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'number_with_suffix',
                'label'             => 'Number with suffix'.backpack_free_badge(),
                'type'              => 'number',
                'suffix'            => '.00',
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
            [   // Number
                'name'              => 'text_with_both_prefix_and_suffix',
                'label'             => 'Text with both prefix and suffix'.backpack_free_badge(),
                'type'              => 'number',
                'prefix'            => '@',
                'suffix'            => "<i class='fa fa-home'></i>",
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [   // Phone
                'name'              => 'phone',
                'label'             => 'Phone'.backpack_pro_badge(),
                'type'              => 'phone',
                'fake'              => true,
                'store_in'          => 'extras',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [   // Password
                'name'              => 'password',
                'label'             => 'Password'.backpack_free_badge(),
                'type'              => 'password',
                'tab'               => 'Simple',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'    => 'radio', // the name of the db column
                'label'   => 'Status (radio)'.backpack_free_badge(), // the input label
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
            [
                'name'  => 'status',
                'label' => 'Status (enum)'.backpack_free_badge(),
                'type'  => 'enum',
                'tab'   => 'Simple',
            ],
            [   // Checkbox
                'name'  => 'checkbox',
                'label' => 'I have not read the terms and conditions and I never will (checkbox)'.backpack_free_badge(),
                'type'  => 'checkbox',
                'tab'   => 'Simple',
            ],
            [   // Switch
                'name'  => 'switch',
                'label' => 'I have not read the terms and conditions and I never will (switch)'.backpack_free_badge(),
                'type'  => 'switch',
                'tab'   => 'Simple',
                'fake'  => true,
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

        $fields = [
            [   // Time
                'name'              => 'time',
                'label'             => 'Time'.backpack_free_badge(),
                'type'              => 'time',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
                'fake'              => true,
            ],
            [   // Month
                'name'              => 'week',
                'label'             => 'Week'.backpack_free_badge(),
                'type'              => 'week',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Month
                'name'              => 'month',
                'label'             => 'Month'.backpack_free_badge(),
                'type'              => 'month',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                'name'       => 'date',
                'label'      => 'Date (HTML5 spec)'.backpack_free_badge(),
                'type'       => 'date',
                'attributes' => [
                    'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
                    'placeholder' => 'yyyy-mm-dd',
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // Date
                // <span class="badge badge-pill bg-primary">PRO</span>
                'name'  => 'date_picker',
                'label' => 'Date picker (jQuery plugin)'.backpack_pro_badge(),
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
                'label'             => 'Datetime (HTML5 spec)'.backpack_free_badge(),
                'type'              => 'datetime',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
                'tab'               => 'Time and space',
            ],
            [   // DateTime
                'name'  => 'datetime_picker',
                'label' => 'Datetime picker (jQuery plugin)'.backpack_pro_badge(),
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
                'name'       => 'start_date,end_date', // a unique name for this field
                'label'      => 'Date Range'.backpack_pro_badge(),
                'type'       => 'date_range',
                'default'    => ['2020-03-28 01:01', '2020-04-05 02:00'],
                // OPTIONALS
                'date_range_options' => [ // options sent to daterangepicker.js
                    'timePicker' => true,
                    'locale'     => ['format' => 'DD/MM/YYYY HH:mm'],
                ],
                'tab' => 'Time and space',
            ],
        ];

        if (env('GOOGLE_PLACES_KEY')) {
            $fields[] = [   // Address_google
                'name'          => 'address_google',
                'label'         => 'Address_google '.backpack_pro_badge(),
                'type'          => 'address_google',
                'fake'          => true,
                'store_as_json' => true,
                'tab'           => 'Time and space',
            ];
        }

        return $fields;
    }

    public static function getFieldsArrayForRelationshipsTab()
    {
        // -----------------
        // RELATIONSHIPS tab
        // -----------------

        return [
            [   // CustomHTML
                'name'  => 'relationship_heading',
                'type'  => 'custom_html',
                'value' => "<p class='text-muted mb-0'>All the examples in this tab <strong>relationship</strong> field type. This field type changes its interface depending on what relationship it is used on, and whether or not you've defined 'subfields' for it. So we've provided examples for each relationship type. Then examples for a few <i>extra features</i> of the repeatable field.</p>",
                'tab'   => 'Relationship',
            ],
            [   // CustomHTML
                'name'  => 'relationship_direct_relationships',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 mt-3 text-primary">Direct Relationships '.backpack_pro_badge().'</h5>',
                'tab'   => 'Relationship',
            ],

            // --------------------
            // Direct relationships
            // --------------------

            [
                'name'    => 'address.street',
                'label'   => 'HasOne (1-1) <small>towards an attribute on related model</small>',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'     => 'address.country',
                'label'    => 'HasOne (1-1) <small>towards a relationship on related model</small>',
                'wrapper'  => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'              => 'categoryRelationship',
                'label'             => 'BelongsTo (n-1)',
                'tab'               => 'Relationship',
                'wrapper'           => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name'    => 'postalboxer',
                'label'   => 'HasMany (1-n)',
                'tab'     => 'Relationship',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name'    => 'countries',
                'label'   => 'BelongsToMany (n-n)',
                'tab'     => 'Relationship',
            ],

            // -----------------------------------
            // Direct relationships with subfields
            // -----------------------------------

            [   // CustomHTML
                'name'  => 'relationship_direct_relationships_with_subfields',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 mt-4 text-primary">Direct Relationships + Subfields '.backpack_pro_badge().'</h5>',
                'tab'   => 'Relationship',
            ],
            [
                'name'      => 'wish',
                'label'     => 'HasOne (1-1) <small>+ subfields</small>'.backpack_new_badge(),
                'subfields' => [
                    [
                        'name' => 'country',
                    ],
                    [
                        'name'    => 'body',
                        'wrapper' => [
                            'class' => 'text-danger',
                        ],
                    ],
                    [
                        'name' => 'universes',
                    ],
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'      => 'postalboxes',
                'label'     => 'HasMany (1-n) <small>+ subfields</small>'.backpack_new_badge(),
                'subfields' => [
                    [
                        'name' => 'postal_name',
                        'type' => 'text',
                    ],
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'dummyproducts',
                'label'   => 'BelongsToMany (n-n) <small>+ subfields for pivot table</small>'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'pivotSelect' => [
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                'subfields' => [
                    [
                        'name'    => 'notes',
                        'type'    => 'text',
                        'wrapper' => [
                            'class' => 'form-group col-md-6',
                        ],
                    ],
                ],
                'tab'   => 'Relationship',
            ],

            // -------------------------
            // Polymorphic Relationships
            // -------------------------

            [   // CustomHTML
                'name'  => 'relationship_polymorphic_relationships',
                'type'  => 'custom_html',
                'value' => '<hr class="mt-5 mb-5"><h5 class="mb-0 mt-3 text-primary">Polymorphic Relationships '.backpack_pro_badge().'</h5>',
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'sentiment.text',
                'label'   => 'MorphOne (1-1 polymorphic) <small>towards an attribute</small>'.backpack_new_badge(),
                'type'    => 'relationship',
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'sentiment.user',
                'label'   => 'MorphOne (1-1 polymorphic) <small>towards a relation</small>'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'universes',
                'label'   => 'MorphMany (1-n)'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'bills',
                'label'   => 'MorphToMany (n-n)'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'tab'   => 'Relationship',
            ],

            // -------------------------------------
            // Polymorphic Relationships + Subfields
            // -------------------------------------

            [   // CustomHTML
                'name'  => 'relationship_polymorphic_relationships_with_subfields',
                'type'  => 'custom_html',
                'value' => '<hr class="mt-5 mb-5"><h5 class="mb-0 mt-3 text-primary">Polymorphic Relationships + Subfields  '.backpack_pro_badge().'</h5>',
                'tab'   => 'Relationship',
            ],

            [
                'name'    => 'ball',
                'label'   => 'MorphOne (1-1 polymorphic) <small>+ subfields</small>'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'subfields' => [
                    [
                        'name'    => 'name',
                        'wrapper' => [
                            'class' => 'form-group col-md-6',
                        ],
                    ],
                    [
                        'name'    => 'country_id',
                        'entity'  => 'country',
                        'type'    => 'relationship',
                        'wrapper' => [
                            'class' => 'form-group col-md-6',
                        ],

                    ],
                ],
                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'stars',
                'label'   => 'MorphMany (1-n) <small>+ subfields</small>'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'subfields' => [
                    [
                        'name' => 'title',
                        'type' => 'text',
                    ],
                ],

                'tab'   => 'Relationship',
            ],
            [
                'name'    => 'recommends',
                'label'   => 'MorphToMany (n-n) <small>+ subfields for pivot table</small>'.backpack_new_badge(),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'subfields' => [
                    [
                        'name' => 'text',
                        'type' => 'text',
                    ],
                ],
                'tab'   => 'Relationship',
            ],

            // ----------------------------
            // Relationships Extra Features
            // ----------------------------

            [
                'name'  => 'relationship_extra_features',
                'type'  => 'custom_html',
                'value' => '<hr class="mt-5 mb-5"><h5 class="mb-0 mt-3 text-primary">Extra Features  '.backpack_pro_badge().'</a></h5>',
                'tab'   => 'Relationship',
            ],

            [    // Relationship - everything is explicitly defined
                'label'         => 'BelongsTo + InlineCreate',
                'type'          => 'relationship',
                'name'          => 'fallback_icon',
                'fake'          => true,
                'entity'        => 'icon',
                'attribute'     => 'name',
                'tab'           => 'Relationship',
                'inline_create' => true,
                // 'data_source' => backpack_url('monster/fetch/icon'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [    // Relationship
                'label'     => 'BelongsToMany + AJAX + InlineCreate',
                'type'      => 'relationship',
                'name'      => 'products',
                'entity'    => 'products',
                // 'attribute' => 'name',
                'tab'       => 'Relationship',
                'ajax'      => true,
                // 'inline_create' => true, // TODO: make it work like this too
                'inline_create'     => [
                    'entity'      => 'product',
                    'modal_class' => 'modal-dialog modal-xl',
                ],
                'data_source'       => backpack_url('monster/fetch/product'),
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [    // Relationship - nothing is explicitly defined, not even the field type
                'label'         => 'Relationship (all field attributes are guessed)',
                'name'          => 'icondummy',
                'tab'           => 'Relationship',
                // 'data_source' => backpack_url('monster/fetch/icon'),
                'wrapperAttributes' => ['class' => 'form-group col-md-12'],
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
                'name'  => 'selects_no_relationship_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary">No Relationship</h5>',
                'tab'   => 'Selects',
            ],

            [ // select_from_array
                'name'              => 'select_from_array',
                'label'             => 'Select_from_array (no relationship, 1-1 or 1-n)'.backpack_free_badge(),
                'type'              => 'select_from_array',
                'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
                'allows_null'       => true,
                'tab'               => 'Selects',
                'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // select2_from_array
                'name'              => 'select2_from_array',
                'label'             => 'Select2_from_array (no relationship, 1-1 or 1-n)'.backpack_pro_badge(),
                'type'              => 'select2_from_array',
                'options'           => ['one' => 'One', 'two' => 'Two', 'three' => 'Three'],
                'allows_null'       => true,
                'tab'               => 'Selects',
                'allows_multiple'   => false, // OPTIONAL; needs you to cast this to array in your model;
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // select_and_order
                'name'    => 'select_and_order',
                'label'   => 'Select_and_order'.backpack_pro_badge(),
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

            // -----------------
            // 1-n relationships
            // -----------------

            [ // CustomHTML
                'name'  => 'selects_1_n_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary">1-n Relationship (belongsTo, morphTo)</h5>',
                'tab'   => 'Selects',
            ],
            [   // select
                'label'                      => 'Select'.backpack_free_badge(),
                'type'                       => 'select', //https://github.com/Laravel-Backpack/CRUD/issues/502
                'name'                       => 'select',
                'entity'                     => 'category',
                'attribute'                  => 'name',
                'model'                      => 'Backpack\NewsCRUD\app\Models\Category',
                'fake'                       => true,
                'tab'                        => 'Selects',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [   // select_grouped
                'label'                      => 'Select_grouped'.backpack_free_badge(),
                'type'                       => 'select_grouped', //https://github.com/Laravel-Backpack/CRUD/issues/502
                'name'                       => 'select_grouped_id',
                'fake'                       => true,
                'entity'                     => 'article',
                'model'                      => 'Backpack\NewsCRUD\app\Models\Article',
                'attribute'                  => 'title',
                'group_by'                   => 'category', // the relationship to entity you want to use for grouping
                'group_by_attribute'         => 'name', // the attribute on related model, that you want shown
                'group_by_relationship_back' => 'articles', // relationship from related model back to this model
                'tab'                        => 'Selects',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [   // select2_grouped
                'label'                      => 'Select2_grouped'.backpack_pro_badge(),
                'type'                       => 'select2_grouped', //https://github.com/Laravel-Backpack/CRUD/issues/502
                'name'                       => 'select2_grouped_id',
                'fake'                       => true,
                'entity'                     => 'article',
                'model'                      => 'Backpack\NewsCRUD\app\Models\Article',
                'attribute'                  => 'title',
                'group_by'                   => 'category', // the relationship to entity you want to use for grouping
                'group_by_attribute'         => 'name', // the attribute on related model, that you want shown
                'group_by_relationship_back' => 'articles', // relationship from related model back to this model
                'tab'                        => 'Selects',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [    // SELECT2
                'label'             => 'Select2'.backpack_pro_badge(),
                'type'              => 'select2',
                'name'              => 'select2',
                'entity'            => 'categorySelect2',
                'attribute'         => 'name',
                'model'             => "Backpack\NewsCRUD\app\Models\Category",
                'tab'               => 'Selects',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [   // select2_nested
                'name'                       => 'select2_nested_id',
                'label'                      => 'Select2_nested'.backpack_pro_badge(),
                'type'                       => 'select2_nested',
                'fake'                       => true,
                'entity'                     => 'category', // the method that defines the relationship in your Model
                'attribute'                  => 'name', // foreign key attribute that is shown to user
                'model'                      => "Backpack\NewsCRUD\app\Models\Category", // force foreign key model
                'tab'                        => 'Selects',
                'wrapperAttributes'          => ['class' => 'form-group col-md-4'],
            ],
            [ // select2_from_ajax: 1-n relationship
                'label'                => 'Select2_from_ajax'.backpack_pro_badge(), // Table column heading
                'type'                 => 'select2_from_ajax',
                'name'                 => 'select2_from_ajax', // the column that contains the ID of that connected entity;
                'entity'               => 'article', // the method that defines the relationship in your Model
                'attribute'            => 'title', // foreign key attribute that is shown to user
                'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
                'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
                'method'               => 'POST', // route method, either GET or POST
                'placeholder'          => 'Select an article', // placeholder for the select
                'minimum_input_length' => 2, // minimum characters to type before querying results
                'tab'                  => 'Selects',
                'wrapperAttributes'    => ['class' => 'form-group col-md-4'],
            ],

            [ // CustomHTML
                'name'  => 'selects_n_n_heading',
                'type'  => 'custom_html',
                'value' => '<h5 class="mb-0 text-primary mt-3">n-n Relationship (belongsToMany, morphToMany)</h5>',
                'tab'   => 'Selects',
            ],
            [
                'label'     => 'Checklist'.backpack_free_badge(),
                'type'      => 'checklist',
                'name'      => 'roles',
                'entity'    => 'roles',
                'attribute' => 'name',
                'model'     => "Backpack\PermissionManager\app\Models\Role",
                'pivot'     => true,
                'tab'       => 'Selects',
            ],
            [       // Select_Multiple = n-n relationship
                'label'     => 'Select_multiple'.backpack_free_badge(),
                'type'      => 'select_multiple',
                'name'      => 'tags', // the method that defines the relationship in your Model
                'entity'    => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "Backpack\NewsCRUD\app\Models\Tag", // foreign key model
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'       => 'Selects',
                // 'wrapperAttributes' => ['class' => 'form-group col-md-12'],
            ],
            [       // Select2Multiple = n-n relationship (with pivot table)
                'label'             => 'Select2_multiple'.backpack_pro_badge(),
                'type'              => 'select2_multiple',
                'name'              => 'categories', // the method that defines the relationship in your Model
                'entity'            => 'categories', // the method that defines the relationship in your Model
                'attribute'         => 'name', // foreign key attribute that is shown to user
                'model'             => "Backpack\NewsCRUD\app\Models\Category", // foreign key model
                'allows_null'       => true,
                'pivot'             => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'               => 'Selects',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [ // Select2_from_ajax_multiple: n-n relationship with pivot table
                'label'                => 'Select2_from_ajax_multiple'.backpack_pro_badge(), // Table column heading
                'type'                 => 'select2_from_ajax_multiple',
                'name'                 => 'articles', // the column that contains the ID of that connected entity;
                'entity'               => 'articles', // the method that defines the relationship in your Model
                'attribute'            => 'title', // foreign key attribute that is shown to user
                'model'                => "Backpack\NewsCRUD\app\Models\Article", // foreign key model
                'data_source'          => url('api/article'), // url to controller search function (with /{id} should return model)
                'method'               => 'POST', // route method, either GET or POST
                'placeholder'          => 'Select one or more articles', // placeholder for the select
                'minimum_input_length' => 2, // minimum characters to type before querying results
                'pivot'                => true, // on create&update, do you need to add/delete pivot table entries?
                'tab'                  => 'Selects',
                'wrapperAttributes'    => ['class' => 'form-group col-md-6'],
            ],
            [ // Select2_json_from_api paginated
                'label'                  => 'Select2_json_from_api (paginated)'.backpack_pro_badge(), // Table column heading
                'type'                   => 'select2_json_from_api',
                'name'                   => 'select2_json_from_api', // the column that contains the ID of that connected entity;
                'attribute'              => 'title', // foreign key attribute that is shown to user
                'data_source'            => backpack_url('monster/fetch/paginated-types'), // url to controller search function (with /{id} should return model)
                'method'                 => 'POST', // route method, either GET or POST
                'placeholder'            => 'Select one or more types', // placeholder for the select
                'minimum_input_length'   => 0, // minimum characters to type before querying results
                'tab'                    => 'Selects',
                'wrapperAttributes'      => ['class' => 'form-group col-md-6'],
                'attributes_to_store'    => ['id', 'title', 'location'],
                'multiple'               => true,
            ],
            [ // Select2_json_from_api not paginated
                'label'                => 'Select2_json_from_api (simple array)'.backpack_pro_badge(), // Table column heading
                'type'                 => 'select2_json_from_api',
                'name'                 => 'select2_json_from_api_simple', // the column that contains the ID of that connected entity;
                'data_source'          => backpack_url('monster/fetch/simple-types'), // url to controller search function (with /{id} should return model)
                'method'               => 'POST', // route method, either GET or POST
                'placeholder'          => 'Select one or more types', // placeholder for the select
                'minimum_input_length' => 0, // minimum characters to type before querying results
                'tab'                  => 'Selects',
                'wrapperAttributes'    => ['class' => 'form-group col-md-6'],
                'multiple'             => true,
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
            'label' => 'Browse (using elFinder)'.backpack_pro_badge(),
            'type'  => 'browse',
            'tab'   => 'Uploads',
        ];

        $fields[] = [   // Browse multiple
            'name'     => 'browse_multiple',
            'label'    => 'Browse multiple'.backpack_pro_badge(),
            'type'     => 'browse_multiple',
            'tab'      => 'Uploads',
            'sortable' => true,
            // 'multiple' => true, // enable/disable the multiple selection functionality
            // 'mime_types' => null, // visible mime prefixes; ex. ['image'] or ['application/pdf']
        ];

        $fields[] = [   // Upload
            'name'   => 'upload',
            'label'  => 'Upload'.backpack_free_badge(),
            'type'   => 'upload',
            'upload' => true,
            'disk'   => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ];

        $fields[] = [   // Upload
            'name'   => 'upload_multiple',
            'label'  => 'Upload Multiple'.backpack_free_badge(),
            'type'   => 'upload_multiple',
            'upload' => true,
            // 'disk' => 'uploads', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            // optional:
            // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URL's this will make a URL that is valid for the number of minutes specified
            'tab' => 'Uploads',
        ];

        $fields[] = [ // base64_image
            'label'        => 'Base64 Image - includes cropping'.backpack_pro_badge(),
            'name'         => 'base64_image',
            'filename'     => null, // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => true, // set to true to allow cropping, false to disable
            'src'          => null, // null to read straight from DB, otherwise set to model accessor function
            'tab'          => 'Uploads',
        ];

        $fields[] = [ // image
            'label'        => 'Image - includes cropping'.backpack_pro_badge(),
            'name'         => 'image',
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => config('backpack.base.root_disk_name'), // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
            'tab' => 'Uploads',
        ];

        $fields[] = [
            'label'        => 'Dropzone - drag&drop '.backpack_pro_badge(),
            'name'         => 'dropzone',
            'type'         => 'dropzone',
            'tab'          => 'Uploads',
            'withFiles'    => true,
        ];

        return $fields;
    }

    public static function getFieldsArrayForWysiwygEditorsTab()
    {
        // -----------------
        // BIG TEXTS tab
        // -----------------

        return [
            [   // EasyMDE
                'name'  => 'easymde',
                'label' => 'EasyMDE - markdown editor'.backpack_pro_badge(),
                'type'  => 'easymde',
                'tab'   => 'WYSIWYG Editors',
            ],
            [   // Summernote
                'name'      => 'summernote',
                'label'     => 'Summernote editor'.backpack_free_badge(),
                'type'      => 'summernote',
                'tab'       => 'WYSIWYG Editors',
                'withFiles' => true,
            ],
            [   // CKEditor
                'name'  => 'ckeditor',
                'label' => 'CKEditor - also called the WYSIWYG field'.backpack_pro_badge(),
                'type'  => 'ckeditor',
                'tab'   => 'WYSIWYG Editors',
            ],
            [   // TinyMCE
                'name'  => 'tinymce',
                'label' => 'TinyMCE'.backpack_pro_badge(),
                'type'  => 'tinymce',
                'tab'   => 'WYSIWYG Editors',
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
                'label' => 'Color picker (HTML5 spec)'.backpack_free_badge(),
                'type'  => 'color',
                // 'wrapperAttributes' => ['class' => 'col-md-6'],
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Video
                'name'              => 'video',
                'label'             => 'Video - link to video file on Youtube or Vimeo'.backpack_pro_badge(),
                'type'              => 'video',
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Range
                'name'  => 'range',
                'label' => 'Range'.backpack_free_badge(),
                'type'  => 'range',
                //optional
                'attributes' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Icon picker
                'label'             => 'Icon Picker'.backpack_pro_badge(),
                'name'              => 'icon_picker',
                'type'              => 'icon_picker',
                'iconset'           => 'fontawesome', // options: fontawesome, glyphicon, ionicon, weathericon, mapicon, octicon, typicon, elusiveicon, materialdesign
                'tab'               => 'Miscellaneous',
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [ // Table
                'name'            => 'table',
                'label'           => 'Table'.backpack_pro_badge(),
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
                'label'           => 'Fake Table'.backpack_pro_badge(),
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
                'label' => 'URL'.backpack_free_badge(),
                'tab'   => 'Miscellaneous',
            ],
            [
                'name'      => 'features',
                'label'     => 'Features'.backpack_pro_badge(),
                'type'      => 'repeatable',
                'fake'      => true,
                'subfields' => [
                    [
                        'name'    => 'feature',
                        'wrapper' => [
                            'class' => 'col-md-3',
                        ],
                    ],
                    [
                        'name'    => 'value',
                        'wrapper' => [
                            'class' => 'col-md-6',
                        ],
                    ],
                    [
                        'name'    => 'quantity',
                        'type'    => 'number',
                        'wrapper' => [
                            'class' => 'col-md-3',
                        ],
                    ],
                ],
                'tab' => 'Miscellaneous',
            ],
        ];
    }

    public function ajaxUpload()
    {
        if (app('env') === 'production') {
            return response()->json(['errors' => [
                'dropzone'   => ['Uploads are disabled in production'],
                'easymde'    => ['Uploads are disabled in production'],
                'summernote' => ['Uploads are disabled in production'],
            ],
            ], 500);
        }

        return $this->traitAjaxUpload();
    }
}
