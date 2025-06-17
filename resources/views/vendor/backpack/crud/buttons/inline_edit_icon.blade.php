<a href="#" data-toggle="modal" data-bs-toggle="modal" data-target="#myForm{{$entry->getKey()}}" data-bs-target="#myForm{{$entry->getKey()}}" class="btn btn-sm btn-link">
    <i class="la la-edit"></i> <span>{{ trans('backpack::crud.edit') }}</span>
</a>

<x-backpack::form-modal
    id="myForm{{$entry->getKey()}}"
    controller="App\Http\Controllers\Admin\IconCrudController"
    modalTitle="Update Icon"
    :action="url($crud->route.'/'.$entry->getKey().'')"
    :formRouteOperation="url($crud->route.'/'.$entry->getKey().'/edit')"
    method="PUT"
    refreshDatatable="true"
    operation="update"
/>
