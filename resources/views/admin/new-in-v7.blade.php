@extends(backpack_view('blank'))

@section('content')

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
                <a href="#" class="btn btn-primary"> See docs </a> <!-- TODO: link to final docs -->
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
                <a href="#" class="btn btn-primary"> See docs </a> <!-- TODO: link to final docs -->
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
                <a href="#" class="btn btn-primary"> See docs </a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.datatable-examples')

<!-- Heading for Datatable component -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Views</div>
        <h2 class="page-title">Chips</h2>
        <p class="mt-2 mb-2">Include more information about an Eloquent model, in a small space. Hover over the links to understand more about the examples.</p>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <span class="d-none d-sm-inline">
                <a href="#" class="btn btn-primary"> See docs </a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>

@include('admin.partials.chip-examples')

@endsection
