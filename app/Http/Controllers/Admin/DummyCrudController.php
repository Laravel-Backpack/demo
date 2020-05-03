<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DummyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

/**
 * Class DummyCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DummyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;


    public function setup()
    {
        $this->crud->setModel('App\Models\Dummy');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/dummy');
        $this->crud->setEntityNameStrings('dummy', 'dummies');
    }

    public function fetchIcon() {
        return $this->fetch('App\Models\Icon');
    }

    public function fetchCategories() {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Category::class);
    }

    protected function setupListOperation()
    {
        CRUD::addColumn('name');
        CRUD::addColumn('description');

        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::addColumn([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'array_count',
            ]);
        }
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(DummyRequest::class);
        $this->crud->setOperationSetting('contentClass', 'col-md-12');

        CRUD::addField('name');
        CRUD::addField('description');

        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::addField([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'repeatable',
                'fake'     => true,
                'store_in' => 'extras',
                'fields'   => $groupFields,
            ]);
        }
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->crud->setOperationSetting('contentClass', 'col-md-12');

        // for field types that have multiple name (ex: date_range)
        // split those into two separate text fields
        foreach ($this->groups() as $groupKey => $groupFields) {
            CRUD::removeColumn($groupKey);

            foreach ($groupFields as $key => $field) {
                if (is_array($field['name'])) {
                    foreach ($field['name'] as $name) {
                        $newField = $field;
                        $newField['name'] = $name;
                        $newField['type'] = 'text';
                        $groupFields[] = $newField;
                    }
                    unset($groupFields[$key]);
                }
            }

            // only consider fields that have both name and label (needed for table column)
            // reject custom_html fields (since they have no value)
            $validFields = collect($groupFields)->reject(function ($value, $key) {
                $is_custom_html_field = $value['type'] == 'custom_html';
                $does_not_have_label = !isset($value['label']);
                $does_not_have_name = !isset($value['name']);

                return $is_custom_html_field || $does_not_have_label || $does_not_have_name;
            })->pluck('label', 'name');

            CRUD::addColumn([
                'name'     => $groupKey,
                'label'    => str_replace('_', ' ', Str::title($groupKey)),
                'type'     => 'table',
                'columns'  => $validFields,
            ]);
        }

        CRUD::addColumn([
            'name' => 'created_at',
            'type' => 'datetime',
        ]);
        CRUD::addColumn([
            'name' => 'updated_at',
            'type' => 'datetime',
        ]);
    }

    protected function groups()
    {
        // Field Types: text, textarea
        $groups['question_and_answer'] = [
            [
                'name'              => 'question',
                'label'             => 'Question',
                'type'              => 'textarea',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [
                'name'              => 'answer',
                'label'             => 'Answer',
                'type'              => 'textarea',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
        ];

        // Field Types: text, ckeditor
        $groups['testimonials'] = [
            [
                'name'              => 'name',
                'label'             => 'Name',
                'type'              => 'text',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'              => 'position',
                'label'             => 'Position',
                'type'              => 'text',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'              => 'company',
                'label'             => 'Company',
                'type'              => 'text',
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'  => 'quote',
                'label' => 'Quote',
                'type'  => 'ckeditor',
            ],
        ];

        // Field Types: browse, text, checkbox
        $groups['attachments'] = [
            [   // Browse
                'name'              => 'file',
                'label'             => 'File',
                'type'              => 'browse',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
            ],
            [
                'name'              => 'description',
                'label'             => 'Description',
                'type'              => 'text',
                'wrapperAttributes' => ['class' => 'form-group col-md-5'],
            ],
            [   // Checkbox
                'name'              => 'visible',
                'label'             => 'Visible',
                'type'              => 'checkbox',
                'wrapperAttributes' => ['class' => 'form-group col-md-2 pt-4'],
            ],
        ];

        // Field Types: select, color
        $groups['related_categories'] = [
            [  // Select
                'label'             => 'Category',
                'type'              => 'select',
                'name'              => 'category_id', // the db column for the foreign key
                'entity'            => 'categories', // the method that defines the relationship in your Model
                'attribute'         => 'name', // foreign key attribute that is shown to user
                'model'             => \Backpack\NewsCRUD\app\Models\Category::class,
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
            ],
            [   // Color
                'name'              => 'background_color',
                'label'             => 'Background Color',
                'type'              => 'color',
                'default'           => '#000000',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
        ];

        // Field Types: select2, color_picker
        $groups['related_categories_second'] = [
            [  // Select
                'label'     => 'Categories',
                'type'      => 'select2',
                'name'      => 'categories', // the method that defines the relationship in your Model
                'entity'    => 'categories', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'model'             => \Backpack\NewsCRUD\app\Models\Category::class, // foreign key model
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
            ],
            [   // Color
                'name'              => 'background_color',
                'label'             => 'Background Color',
                'type'              => 'color_picker',
                'default'           => '#000000',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
        ];

        // Field Types: select_multiple, date
        $groups['scheduled_categories'] = [
            [   // SelectMultiple = n-n relationship (with pivot table)
                'label'     => 'Categories',
                'type'      => 'select_multiple',
                'name'      => 'categories', // the method that defines the relationship in your Model
                'entity'    => 'categories', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'model'             => \Backpack\NewsCRUD\app\Models\Category::class, // foreign key model
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
            ],
            [   // Date
                'name'              => 'publish_date',
                'label'             => 'Publish Date',
                'type'              => 'date',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
        ];
        
        // Field Types: select2_from_ajax, select2_from_ajax_multiple
        $groups['categories_icon'] = [
            [   // SelectMultiple = n-n relationship (with pivot table)
                'label'     => 'Categories',
                'type'      => 'select2_from_ajax_multiple',
                'data_source' => backpack_url('dummy/fetch/categories'),
                'minimum_input_length' => 2,
                'placeholder' => 'Select Categories',
                'name'      => 'categories', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'method' => 'post',
                'pivot' => true,
                'multiple' => true,
                // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'model'             => \App\Models\Icon::class, // foreign key model
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // SelectMultiple = n-n relationship (with pivot table)
                'label'     => 'Icon',
                'type'      => 'select2_from_ajax',
                'data_source' => backpack_url('dummy/fetch/icon'),
                'minimum_input_length' => 2,
                'placeholder' => 'Select icon',
                'name'      => 'icon_id', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'method' => 'post',
                // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'model'             => \App\Models\Icon::class, // foreign key model
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
        ];

        // Field Types: select2_multiple, date_picker
        $groups['scheduled_categories_second'] = [
            [   // SelectMultiple = n-n relationship (with pivot table)
                'label'     => 'Categories',
                'type'      => 'select2_multiple',
                'name'      => 'categories', // the method that defines the relationship in your Model
                'entity'    => 'categories', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'model'             => \Backpack\NewsCRUD\app\Models\Category::class, // foreign key model
                'wrapperAttributes' => ['class' => 'form-group col-md-9'],
            ],
            [   // Date
                'name'              => 'publish_date',
                'label'             => 'Publish Date',
                'type'              => 'date_picker',
                'wrapperAttributes' => ['class' => 'form-group col-md-3'],
            ],
        ];

        // Field Types: number, date_range, custom_html
        $groups['holidays'] = [
            [
                'name'              => 'number',
                'label'             => 'Holiday Number',
                'type'              => 'number',
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [ // Date_range
                'name'       => ['start_date', 'end_date'], // a unique name for this field
                'label'      => 'Holiday Timeframe',
                'type'       => 'date_range',
                'default'    => ['2020-03-28 01:01', '2020-04-05 02:00'],
                // OPTIONALS
                // 'date_range_options' => [ // options sent to daterangepicker.js
                //     'timePicker' => true,
                //     'locale'     => ['format' => 'DD/MM/YYYY HH:mm'],
                // ],
                'wrapperAttributes' => ['class' => 'form-group col-md-8'],
            ],
            [   // CustomHTML
                'name'              => 'separator',
                'type'              => 'custom_html',
                'value'             => '<br><strong>Some</strong>thing <i>else</i>',
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
        ];

        // Field Types: hidden, tinymce, datetime_picker, range
        $groups['extra_descriptions'] = [
            [   // Hidden
                'name'    => 'status',
                'type'    => 'hidden',
                'default' => 'visible',
                'label'   => 'Status',
            ],
            [   // TinyMCE
                'name'  => 'extra_description',
                'label' => 'Description',
                'type'  => 'tinymce',
                // optional overwrite of the configuration array
                // 'options' => [ 'selector' => 'textarea.tinymce',  'skin' => 'dick-light', 'plugins' => 'image,link,media,anchor' ],
            ],
            [   // DateTime
                'name'  => 'date',
                'label' => 'Date',
                'type'  => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format'   => 'DD/MM/YYYY HH:mm',
                    'language' => 'fr',
                ],
                'allows_null' => true,
                // 'default' => '2017-05-12 11:59:59',
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
            [   // Range
                'name'       => 'range',
                'label'      => 'Range',
                'type'       => 'range',
                'attributes' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'wrapperAttributes' => ['class' => 'form-group col-md-6'],
            ],
        ];

        return $groups;
    }
}
