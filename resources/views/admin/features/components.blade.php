{{--
    Features > Components: chips, datagrid, datalist, datatable, dataform, dataform modal.
    Each section has its own docs link. The examples live in resources/views/admin/partials.
--}}
@extends(backpack_view('blank'))

@section('header')
    @include('admin.partials.feature_header', ['title' => $title, 'description' => $description, 'docs' => 'https://backpackforlaravel.com/docs/7.x/base-components'])
@endsection

@section('content')

<!-- Heading for chips -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Views</div>
        <h2 class="page-title">Chips</h2>
        <p class="mt-2 mb-2">Include more information about an Eloquent model, in a small space. Hover over the headings
            to understand more about the examples.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/crud-chips" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.chip-examples')

<!-- Heading for Datagrid component -->
<div class="row g-2 align-items-center">
    <div class="col @if(session('backpack.theme-tabler.layout') == 'horizontal_overlap') text-white @endif">
        <div class="page-pretitle">Components</div>
        <h2 class="page-title">Datagrid</h2>
        <p class="mt-2 mb-2">Show the most important info about an Eloquent entry, anywhere you want.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#datagrid-1" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.datagrid-examples')

<!-- Heading for Datalist component -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Components</div>
        <h2 class="page-title">Datalist</h2>
        <p class="mt-2 mb-2">Show the most important info about an Eloquent entry, anywhere you want.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#datalist-1" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.datalist-examples')

<!-- Heading for Datatable component -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Components</div>
        <h2 class="page-title">Datatable</h2>
        <p class="mt-2 mb-2">Include your complex datatable, anywhere you want.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#datatable-1" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.datatable-examples')

<!-- Heading for Form component -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Components</div>
        <h2 class="page-title">Dataform</h2>
        <p class="mt-2 mb-2">Show a form for an Eloquent entry, anywhere you want.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#dataform-1" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>


@include('admin.partials.dataform-examples')

<!-- Heading for Form component -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Components</div>
        <h2 class="page-title">Dataform Modal</h2>
        <p class="mt-2 mb-2">Show a form for an Eloquent entry, in a modal.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a target="_blank" href="https://backpackforlaravel.com/docs/7.x/base-components#dataform-modal-1" class="btn btn-primary"> See docs  <i class="ms-2 la la-external-link-alt"></i></a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.dataform-modal-examples')

@endsection
