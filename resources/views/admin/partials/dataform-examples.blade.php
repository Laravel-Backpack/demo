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
                            <a class="dropdown-item" href="#">See demo code</a> <!-- TODO: link to demo code -->
                            <a class="dropdown-item" href="#">See docs</a> <!-- TODO: link to final docs -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <x-bp-dataform controller="\App\Http\Controllers\Admin\PetShop\InvoiceCrudController" />

            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Quick Add Tag
                </h3>
            </div>
            <div class="card-body bg-light">

                <x-backpack::dataform
                    id="quickAddTag"
                    controller="\Backpack\NewsCRUD\app\Http\Controllers\Admin\TagCrudController"
                    operation="create"
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
            <div class="card-body bg-light">

                <x-backpack::dataform
                    id="quickEditTag"
                    controller="\Backpack\NewsCRUD\app\Http\Controllers\Admin\TagCrudController"
                    operation="update"
                    :entry="\Backpack\NewsCRUD\app\Models\Tag::find(1)"
                />

            </div>
        </div>
    </div>

</div>
