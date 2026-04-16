<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\PetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PetCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PetCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\Pro\Http\Controllers\Operations\TrashOperation;
    use \Backpack\Pro\Http\Controllers\Operations\BulkTrashOperation;
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
        CRUD::setModel(\App\Models\PetShop\Pet::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/pet');
        CRUD::setEntityNameStrings('pet', 'pets');
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
        CRUD::column('nickname');
        CRUD::column('passport.number')->attribute('number')->linkTo('passport.show');
        CRUD::column('owners')->linkTo('owner.show');
        CRUD::column('skills')->linkTo('skill.show');
        CRUD::column('avatar.url')->type('image')->label('Avatar');

        CRUD::addButtonFromView('top', 'passports', 'passports');

        CRUD::filter('skills')
            ->type('select2_multiple')
            ->values(function () {
                return \App\Models\Petshop\Skill::all()->keyBy('id')->pluck('name', 'id')->toArray();
            })
            ->whenActive(function ($values) {
                $values = json_decode($values, true);

                $this->crud->addClause('whereHas', 'skills', function ($query) use ($values) {
                    $query->whereIn('id', $values);
                });
            });
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
        CRUD::setValidation(PetRequest::class);

        CRUD::field('nickname');
        CRUD::field('avatar.url')->type('browse')->label('Avatar')->hint('<small class="float-right">Edit one attribute on a <code>morphMany</code> related item (1-1).</small>');
        CRUD::field('owners')->subfields([['name' => 'role', 'type' => 'text']])->hint('<small class="float-right">Choose related Owners over a <code>belongsToMany</code> relationship, and edit "role" on the pivot table (n-n).</small>');
        CRUD::field('skills')->hint('<small class="float-right">Choose related Skills over a <code>belongsToMany</code> relationship (n-n).</small>');
        CRUD::field('passport')->subfields(\App\Http\Controllers\Admin\PetShop\PassportCrudController::passportFields())->hint('<small class="float-right">Create, update or delete a related <code>hasOne</code> entry entirely (1-n).</small>');
        CRUD::field('comments')->ajax('true')->hint('<small class="float-right">Choose related Comments over a <code>morphMany</code> relationship (n-n).</small>');
        CRUD::field('badges')->hint('<small class="float-right">Choose related Badges over a <code>morphToMany</code> relationship (n-n).</small>');
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
        // --- Static metric with auto-refresh: always shows the current total, polls every 30s ---
        $this->addMetric('total_pets_ever', [
            'type'            => 'stat',
            'label'           => 'Total Pets (All Time)',
            'aggregate'       => 'count',
            'section'         => 'static',
            'refreshInterval' => 5,
            'wrapper'         => ['class' => 'col-md-4'],
        ]);

        // --- Stat cards ---
        $this->addMetricGroup([
            'class' => 'row',
        ], function () {
            $this->addMetric('new_pets', [
                'type'      => 'stat',
                'label'     => 'New Pets',
                'aggregate' => 'count',
                'period'    => 'created_at',
                'compare'   => true,
                'wrapper'   => ['class' => 'col-md-4'],
            ]);

            $this->addMetric('trashed_pets', [
                'type'        => 'stat',
                'label'       => 'Trashed Pets',
                'description' => 'Soft-deleted pets in the selected period.',
                'aggregate'   => 'count',
                'period'      => 'deleted_at',
                'query'       => fn ($q) => $q->onlyTrashed(),
                'wrapper'     => ['class' => 'col-md-4'],
            ]);

            $this->addMetric('avg_skills', [
                'type'    => 'stat',
                'label'   => 'Avg Skills Per Pet',
                'wrapper' => ['class' => 'col-md-4'],
                'resolve' => fn ($query, $filters) => [
                    'value' => round($query->withCount('skills')->get()->avg('skills_count'), 1),
                ],
            ]);
        });

        // --- Chart ---
        $this->addMetric('pets_over_time', [
            'type'      => 'line',
            'label'     => 'Pets Over Time',
            'aggregate' => 'count',
            'period'    => 'created_at',
        ]);
    }
}
