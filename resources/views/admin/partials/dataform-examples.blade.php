<div class="row">
    <div class="col-md-12">
        <div class="card card-stacked mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Create Invoice

                    <i class="la la-info-circle text-muted"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Showing the form needed to create an Invoice, with all configuration pulled directly from InvoiceCrudController."></i>
                </h3>
                <div class="card-actions">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-1">
                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item" target="_blank" href="https://github.com/Laravel-Backpack/demo/blob/main/resources/views/admin/partials/dataform-examples.blade.php">See demo code</a>
                            <a class="dropdown-item" target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#dataform-1">See docs</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <x-bp-dataform :controller='\App\Http\Controllers\Admin\PetShop\InvoiceCrudController::class' />

            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="card card-stacked mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Quick Add Tag (With Extra Field)

                    <i class="la la-info-circle text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Showing the form to create a Tag. Configuration is from TagCrudController, and one custom field is added here."></i>
                </h3>
            </div>
            <div class="card-body">

                <x-backpack::dataform
                    formId="quickAddTag"
                    :controller="\Backpack\NewsCRUD\app\Http\Controllers\Admin\TagCrudController::class"
                    formOperation="create"
                    :setup="function($crud, $entry)  {
                        $crud->field('custom_test_field')->type('text');
                    }"
                    :saveActions="[\Backpack\CRUD\app\Library\CrudPanel\SaveActions\SaveAndList::class]"
                    :showCancelButton="false"
                />

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Quick Edit Tag
                </h3>
            </div>
            <div class="card-body">

                <x-backpack::dataform
                    formId="quickEditTag"
                    :controller="\Backpack\NewsCRUD\app\Http\Controllers\Admin\TagCrudController::class"
                    formOperation="update"
                    :entry="\Backpack\NewsCRUD\app\Models\Tag::find(1)"
                    :formInsideCard="true"
                />

            </div>
        </div>
    </div>

</div>
