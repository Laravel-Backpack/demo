<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\Pro\Http\Controllers\Operations\DropzoneOperation { dropzoneUpload as traitDropzoneUpload; }

    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    protected function setupListOperation()
    {
        CRUD::addColumns(['name']); // add multiple columns, at the end of the stack
        CRUD::addColumn([
            'name'          => 'status',
            'type'          => 'enum',
            'enum_function' => 'getReadableStatus',
        ]);
        CRUD::addColumn([
            'name'          => 'condition',
            'type'          => 'enum',
            'enum_class'    => 'App\Enums\ProductCondition',
            'enum_function' => 'getReadableCondition',
        ]);
        CRUD::addColumn([
            'name'           => 'price',
            'type'           => 'number',
            'label'          => 'Price',
            'visibleInTable' => false,
            'visibleInModal' => true,
        ]);
        CRUD::addColumn([
            // 1-n relationship
            'label'          => 'Category', // Table column heading
            'type'           => 'select',
            'name'           => 'category_id', // the column that contains the ID of that connected entity;
            'entity'         => 'category', // the method that defines the relationship in your Model
            'attribute'      => 'name', // foreign key attribute that is shown to user
            'visibleInTable' => true,
            'visibleInModal' => false,
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StoreRequest::class);

        CRUD::addField([ // Text
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

        CRUD::addField([   // Textarea
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'textarea',
            'tab'   => 'Texts',
        ]);

        CRUD::addField([   // summernote
            'name'  => 'details',
            'label' => 'Details',
            'type'  => 'summernote',
            'tab'   => 'Texts',
        ]);

        CRUD::addField([ // Table
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

        // Fake repeatable with translations
        CRUD::addField([ // Extra Features
            'name'      => 'extra_features',
            'label'     => 'Extra Features',
            'type'      => 'repeatable',
            'tab'       => 'Texts',
            'store_in'  => 'extras',
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
        ]);

        CRUD::addField([  // Select2
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

        CRUD::addField([   // Number
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
        CRUD::addField([   // Number
            'name'  => 'status',
            'label' => 'Status',
            'type'  => 'enum',
            'tab'   => 'Basic Info',
        ]);
        CRUD::addField([   // Number
            'name'          => 'condition',
            'label'         => 'Condition',
            'type'          => 'enum',
            'tab'           => 'Basic Info',
            'enum_class'    => 'App\Enums\ProductCondition',
            'enum_function' => 'getReadableCondition',
        ]);

        CRUD::addFields([
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

        CRUD::field('main_image')
                ->label('Main Image')
                ->type('image')
                ->tab('Media')
                ->wrapper(['class' => 'form-group col-md-4'])
                ->disabledInProduction()
                ->withMedia();

        CRUD::field('privacy_policy')
                ->label('Privacy policy document')
                ->type('upload')
                ->tab('Media')
                ->wrapper(['class' => 'form-group col-md-4'])
                ->disabledInProduction()
                ->withMedia();

        CRUD::field('specifications')
                ->label('Specifications')
                ->type('upload_multiple')
                ->tab('Media')
                ->wrapper(['class' => 'form-group col-md-4'])
                ->disabledInProduction()
                ->withMedia();

        CRUD::field('gallery')
            ->type('repeatable')
            ->tab('Media')
            ->subfields([
                [
                    'name'    => 'image_title',
                    'type'    => 'text',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                ],
                [
                    'name'    => 'gallery_image',
                    'label'   => 'image',
                    'type'    => 'image',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                    'withMedia' => true,
                ],

                [
                    'name'    => 'gallery_image_drm',
                    'label'   => 'Image DRM',
                    'type'    => 'upload',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                    'withMedia' => true,
                ],
                [
                    'name'    => 'gallery_image_specifications',
                    'label'   => 'Image Specifications',
                    'type'    => 'upload_multiple',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                    'withMedia' => true,
                ],
                [
                    'name'    => 'gallery_image_certificates',
                    'label'   => 'Image Certificates',
                    'type'    => 'dropzone',
                    'wrapper' => [
                        'class' => 'form-group col-md-6',
                    ],
                    'withMedia' => true,
                ],
            ])
            ->when(app('env') == 'production', function ($field) {
                return $field->remove();
            });

        $this->crud->setOperationSetting('contentClass', 'col-md-12');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function dropzoneUpload()
    {
        if (app('env') === 'production') {
            return response()->json(['errors' => [
                'dropzone' => ['Uploads are disabled in production'],
            ],
            ], 500);
        }

        return $this->traitDropzoneUpload();
    }
}
