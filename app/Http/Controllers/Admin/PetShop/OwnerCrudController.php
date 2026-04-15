<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\OwnerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class OwnerCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OwnerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\ReportOperation\Http\Controllers\Operations\ReportOperation;

    public function fetchComments()
    {
        return $this->fetch('App\Models\PetShop\Comment');
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PetShop\Owner::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/owner');
        CRUD::setEntityNameStrings('owner', 'owners');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->size(6);
        CRUD::column('avatar.url')->type('image')->label('Avatar')->size(6);
        CRUD::column('pets')->label('Pets')->linkTo('pet.show');
        CRUD::column('invoices')->linkTo('invoice.show');
        CRUD::column('badges')->label('Badges')->linkTo('badge.show');

        CRUD::button('view_pets')->stack('line')->view('crud::buttons.quick')->meta([
            'access'  => true,
            'label'   => 'View Pets',
            'icon'    => 'la la-paw',
            'wrapper' => [
                'href' => function ($entry, $crud) {
                    return url($crud->route.'/'.$entry->getKey().'/pets');
                },
                'title' => 'view owner pets',
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OwnerRequest::class);

        CRUD::field('name');
        CRUD::field('avatar.url')->type('browse')->label('Avatar')->hint('<small class="float-right">Edit one attribute on a <code>morphOne</code> related item (1-1).</small>');
        CRUD::field('pets')->subfields([
            ['name' => 'role', 'type' => 'text'],
        ])->hint('<small class="float-right">Choose related entries with a <code>belongsToMany</code> relationship and pivot fields (n-n with pivot).</small>');
        CRUD::field('comments')->ajax('true')->hint('<small class="float-right">Choose related entries with a <code>morphMany</code> relationship (1-n).</small>');
        CRUD::field('badges')->subfields([
            ['name' => 'note', 'type' => 'text'],
        ])->hint('<small class="float-right">Choose related entries with a <code>morphToMany</code> relationship and pivot fields (n-n with pivot).</small>');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReportOperation()
    {
        // --- Grouped stats with different refreshIntervals ---
        // Both metrics share a group, so the lowest interval (30s) wins for the whole group.
        $this->addMetricGroup([
            'class' => 'row',
        ], function () {
            $this->addMetric('total_owners', [
                'type'            => 'stat',
                'label'           => 'Total Owners',
                'aggregate'       => 'count',
                'period'          => 'created_at',
                'compare'         => true,
                'refreshInterval' => 30,
                'wrapper'         => ['class' => 'col-md-4'],
            ]);

            $this->addMetric('total_invoices', [
                'type'            => 'stat',
                'label'           => 'Total Invoices',
                'aggregate'       => 'count',
                'period'          => 'issuance_date',
                'query'           => fn ($q) => $q->setModel(new \App\Models\PetShop\Invoice),
                'refreshInterval' => 60,
                'wrapper'         => ['class' => 'col-md-4'],
            ]);

            $this->addMetric('avg_pets_per_owner', [
                'type'    => 'stat',
                'label'   => 'Avg Pets Per Owner',
                'wrapper' => ['class' => 'col-md-4'],
                'resolve' => fn ($query, $filters) => [
                    'value' => round($query->withCount('pets')->get()->avg('pets_count'), 1),
                ],
            ]);
        });

        // --- Charts ---
        $this->addMetricGroup([
            'class' => 'row mt-2',
        ], function () {
            $this->addMetric('owners_over_time', [
                'type'      => 'line',
                'label'     => 'Owners Over Time',
                'aggregate' => 'count',
                'period'    => 'created_at',
            ]);

            $this->addMetric('invoices_by_series', [
                'type'   => 'pie',
                'label'  => 'Invoices by Series',
                'column' => 'series',
                'query'  => fn ($q) => $q->setModel(new \App\Models\PetShop\Invoice),
            ]);
        });
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        Widget::add([
            'type'       => 'datatable',
            'controller' => 'App\Http\Controllers\Admin\PetShop\PetCrudController',
            'name'       => 'pets_crud',
            'section'    => 'after_content',
            'wrapper'    => ['class' => 'mt-3'],
            'content'    => [
                'header' => 'Pets for this owner',
                // COULD-DO: maybe add support for a subheader?
                // 'subheader' => 'This is a list of all pets owned by this owner.',
            ],
            'setup' => function ($crud, $parent) {
                // change some column attributes just inside this instance
                $crud->column('skills')->label('Pet skills');
                $crud->column('passport.number')->label('Passport Number');

                // only show the pets of this owner (owner is an n-n relationship)
                $crud->addClause('whereHas', 'owners', function ($query) use ($parent) {
                    $query->where('id', $parent->id);
                });
            },
        ]);
        Widget::add([
            'type'       => 'datatable',
            'controller' => 'App\Http\Controllers\Admin\PetShop\InvoiceCrudController',
            'name'       => 'invoices_crud',
            'section'    => 'after_content',
            'wrapper'    => ['class' => 'mt-3'],
            'content'    => [
                'header' => 'Invoices for this owner',
            ],
            // MUST-DO: How the fuck do I make this only show related pets?!?!
            'setup' => function ($crud, $parent) {
                // only show the pets of this owner (owner is an n-n relationship)
                $crud->addClause('where', 'owner_id', $parent->id);
            },
        ]);
    }
}
