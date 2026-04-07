<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\InvoiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class InvoiceCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InvoiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\Pro\Http\Controllers\Operations\TrashOperation;
    use \Backpack\Pro\Http\Controllers\Operations\CustomViewOperation;
    use \Backpack\DataformModal\Http\Controllers\Operations\CreateInModalOperation;
    use \Backpack\DataformModal\Http\Controllers\Operations\UpdateInModalOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReportOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PetShop\Invoice::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/invoice');
        CRUD::setEntityNameStrings('invoice', 'invoices');

        // enable db transactions for create and update operations
        CRUD::operation(['create', 'update'], function () {
            CRUD::set('useDatabaseTransactions', true);
        });
    }

    public function setupLast5YearsView()
    {
        CRUD::addClause('where', 'issuance_date', '>=', now()->subYears(5)->format('Y-m-d'));
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
        CRUD::addColumn([
            'name' => 'info',
            'type' => 'view',
            'view' => 'crud::chips.invoice',
        ]);
        CRUD::column('issuance_date');
        CRUD::column('due_date');
        CRUD::column('total');

        CRUD::filter('series')
            ->type('dropdown')
            ->values(\App\Models\PetShop\Invoice::select('series')->distinct()->pluck('series', 'series')->toArray())
            ->label('Series')
            ->placeholder('Search by series')
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'series', '=', $value);
            });

        CRUD::filter('issuance_date')
            ->type('date_range')
            ->label('Issuance Date')
            ->placeholder('Search by issuance date')
            ->whenActive(function ($value) {
                $dates = json_decode($value);
                CRUD::addClause('whereBetween', 'issuance_date', [$dates->from, $dates->to]);
            });

        $this->runCustomViews();
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
        CRUD::setValidation(InvoiceRequest::class);
        CRUD::setOperationSetting('contentClass', 'col-md-12');

        CRUD::field('owner')->ajax(true)->minimum_input_length(0)->inline_create(true);
        CRUD::field('series')->size(3)->default('INV');
        CRUD::field('number')->size(3)->default((\App\Models\PetShop\Invoice::max('number') ?? 0) + 1);
        CRUD::field('issuance_date')->size(3)->default(date('Y-m-d'));
        CRUD::field('due_date')->size(3);
        CRUD::field('items')->subfields([
            [
                'name'    => 'description',
                'type'    => 'text',
                'wrapper' => [
                    'class' => 'form-group col-md-8',
                ],
            ],
            [
                'name'       => 'quantity',
                'type'       => 'number',
                'attributes' => ['step' => 'any'],
                'wrapper'    => [
                    'class' => 'form-group col-md-2',
                ],
            ],
            [
                'name'       => 'unit_price',
                'type'       => 'number',
                'attributes' => ['step' => 'any'],
                'wrapper'    => [
                    'class' => 'form-group col-md-2',
                ],
            ],
        ])->reorder('order')->hint('<small class="float-right">Create/update/delete InvoiceItem entries over a <code>hasMany</code> relationship (1-n).</small>');
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

    protected function setupShowOperation()
    {
        $this->autoSetupShowOperation();

        CRUD::column('total');

        // get the owner with important relationships
        $owner = CRUD::getCurrentEntry()->owner()->with('avatar', 'invoices')->first();

        // add a chip widget for the owner
        Widget::add()
            ->to('after_content')
            ->type('chip')
            ->view('crud::chips.owner')
            ->title('Owner')
            ->entry($owner);
    }

    public function fetchOwner()
    {
        return $this->fetch(\App\Models\PetShop\Owner::class);
    }

    protected function setupReportOperation()
    {
        // --- Stat: total invoices (count + previous_period comparison) ---
        $this->addMetric('total_invoices', [
            'type'      => 'stat',
            'label'     => 'Total Invoices',
            'aggregate' => 'count',
            'period'    => 'issuance_date',
            'compare'   => 'previous_period',
        ]);

        // --- Stat: custom resolve returning arbitrary data ---
        $this->addMetric('series_count', [
            'type'    => 'stat',
            'label'   => 'Unique Series',
            'resolve' => fn ($query, $filters) => [
                'value' => $query->distinct('series')->count('series'),
            ],
        ]);

        // --- Stat: sum aggregate with format ---
        $this->addMetric('total_items_value', [
            'type'      => 'stat',
            'label'     => 'Total Items Value',
            'column'    => 'unit_price',
            'aggregate' => 'sum',
            'format'    => '$:value',
            'period'    => 'created_at',
            'query'     => fn ($q) => $q->setModel(new \App\Models\PetShop\InvoiceItem),
        ]);

        // --- Bar chart: invoice count per month (bar type) ---
        $this->addMetric('invoices_bar', [
            'type'      => 'bar',
            'label'     => 'Invoices Per Period',
            'aggregate' => 'count',
            'period'    => 'issuance_date',
        ]);

        // --- Line chart: custom resolve returning chart data ---
        $this->addMetric('items_per_invoice', [
            'type'    => 'line',
            'label'   => 'Avg Items Per Invoice',
            'resolve' => function ($query, $filters) {
                $rows = $query
                    ->selectRaw('DATE_FORMAT(issuance_date, "%Y-%m") as label')
                    ->selectRaw('AVG((SELECT COUNT(*) FROM invoice_items WHERE invoice_items.invoice_id = invoices.id)) as value')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();

                return [
                    'labels' => $rows->pluck('label')->toArray(),
                    'data'   => $rows->pluck('value')->map(fn ($v) => round((float) $v, 1))->toArray(),
                ];
            },
        ]);

        // --- Wrapper with custom style attribute ---
        $this->modifyMetric('series_count', [
            'wrapper' => ['class' => 'col-md-3', 'style' => 'opacity: 0.9;'],
        ]);

        // --- Group stats into a single AJAX request ---
        $this->groupMetrics('invoice_stats', ['total_invoices', 'series_count', 'total_items_value']);
    }
}
