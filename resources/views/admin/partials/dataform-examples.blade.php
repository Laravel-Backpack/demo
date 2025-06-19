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

                <x-bp-form controller="\App\Http\Controllers\Admin\PetShop\InvoiceCrudController" />

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

                <x-backpack::form id="quickAddTag"
                    controller="\Backpack\NewsCRUD\app\Http\Controllers\Admin\TagCrudController" />

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Other Quick Actions
                </h3>
            </div>

            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-toggle="modal"
                    data-target="#addOwnerForm" data-bs-target="#addOwnerForm">
                    Add Owner
                </button>
                <x-backpack::form-modal id="addOwnerForm"
                    controller="\App\Http\Controllers\Admin\PetShop\OwnerCrudController" title="Add Owner" />

                <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-toggle="modal"
                    data-target="#addPetForm" data-bs-target="#addPetForm">
                    Add Pet
                </button>
                <x-backpack::form-modal id="addPetForm"
                    controller="\App\Http\Controllers\Admin\PetShop\PetCrudController" title="Add Pet" />

                <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-toggle="modal"
                    data-target="#addProductForm" data-bs-target="#addProductForm">
                    Add Product
                </button>
                <x-backpack::form-modal id="addProductForm"
                    controller="\App\Http\Controllers\Admin\ProductCrudController" title="Add Product" />
            </div>
        </div>

        @include('backpack.theme-tabler::inc.commercial')
    </div>
</div>
