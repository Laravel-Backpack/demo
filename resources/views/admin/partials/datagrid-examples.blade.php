<div class="row">

    <div class="col-md-12">
        <div class="card card-stacked mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Random Pet

                    <i class="la la-info-circle text-muted"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Showing a random pet from the DB, automatically loading its columns and buttons from the show operation in PetCrudController."></i>
                </h3>
                <div class="card-actions">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
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
            <div class="card-body p-0">
                <x-bp-datagrid
                    :entry="\App\Models\PetShop\Pet::inRandomOrder()->first()"
                    controller="\App\Http\Controllers\Admin\PetShop\PetCrudController"
                    operation="list" :setup="function($crud, $entry) {
                        $crud->removeColumn('created_at');
                    }" />
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-stacked mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Random Owner

                    <i class="la la-info-circle text-muted"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Showing a random owner from the DB, automatically loading its columns and buttons from the show operation in OwnerCrudController."></i>
                </h3>
                <div class="card-actions">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
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
            <div class="card-body p-0">

                <x-bp-datagrid
                    :entry="\App\Models\PetShop\Owner::inRandomOrder()->first()"
                    controller="\App\Http\Controllers\Admin\PetShop\OwnerCrudController"
                    operation="show"
                    :setup="function($crud, $entry) {
                        // we want to remove the datatables widgets that are used
                        // in the Show operation of an Owner
                        Widget::collection()->get('pets_crud')?->remove();
                        Widget::collection()->get('invoices_crud')?->remove();
                    }" />

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-stacked mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    First User

                    <i class="la la-info-circle text-muted"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Showing the first user in the DB, directly specifying what columns to show. Notice this component doesn't have any buttons - that's because it's not tied to any CRUD."></i>
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
            <div class="card-body p-0">
                <x-bp-datagrid :entry="\App\User::find(1)" :columns="[
                            ['label' => 'Name', 'type' => 'text', 'name' => 'name', 'size' => 6],
                            ['label' => 'Email', 'type' => 'email', 'name' => 'email', 'size' => 6],
                            ['label' => 'Created At', 'type' => 'datetime', 'name' => 'created_at'],
                            ['label' => 'Updated At', 'type' => 'datetime', 'name' => 'updated_at'],
                        ]" />
            </div>
        </div>
    </div>
</div>
