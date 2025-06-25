@extends(backpack_view('blank'))

@php
    // Add the form widget to the 'after_content' section of the widgets array
    $widgets['after_content'][] = [
      'type' => 'div',
      'class' => 'row',
      'content' => [ // widgets
            [
                'type' => 'dataform',
                'wrapper' => [
                    'class' => 'col-md-12 mt-3',
                ],
                'controller' => \App\Http\Controllers\Admin\PetShop\SkillCrudController::class,
                'operation' => 'update',
                'entry' => \App\Models\PetShop\Skill::find(1),
                'content' => [
                    'header' => 'Edit Skill', // optional
                    'body' => 'This form should make it easy to update an existing skill.<br><br>', // optional
                ],
            ]
        ]
    ];

    $widgets['after_content'][] = [
        'type' => 'view',
        'view' => 'backpack.theme-tabler::inc.commercial',
        'wrapper' => [
            'class' => 'mt-3',
        ],
    ];
@endphp

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
                <a href="#" class="btn btn-primary"> See docs </a> <!-- TODO: link to final docs -->
            </span>
        </div>
    </div>
</div>


@include('admin.partials.dataform-examples')

<!-- Heading for chips -->
<div class="row g-2 align-items-center mt-3">
    <div class="col">
        <div class="page-pretitle">Views</div>
        <h2 class="page-title">Chips</h2>
        <p class="mt-2 mb-2">Include more information about an Eloquent model, in a small space. Hover over the headings to understand more about the examples.</p>
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
