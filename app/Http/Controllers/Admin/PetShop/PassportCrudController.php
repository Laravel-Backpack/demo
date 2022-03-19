<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Requests\PassportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PassportCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PassportCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PetShop\Passport::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/pet-shop/passport');
        CRUD::setEntityNameStrings('passport', 'passports');
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
        CRUD::column('pet');
        CRUD::column('number');
        CRUD::column('issuance_date');
        CRUD::column('expiry_date');
        CRUD::column('first_name');
        CRUD::column('middle_name');
        CRUD::column('last_name');
        CRUD::column('birth_date');
        CRUD::column('species');
        CRUD::column('breed');
        CRUD::column('colour');
        CRUD::column('notes');
        CRUD::column('country');
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
        CRUD::setValidation(PassportRequest::class);

        CRUD::field('pet');
        CRUD::addFields(self::passportFields());
    }

    public static function passportFields()
    {
        return [
            ['name' => 'number', 'type' => 'number', 'wrapperAttributes' => ['class' => 'form-group col-md-6']],
            ['name' => 'country', 'type' => 'select_from_array', 'options' => [
                'Austria'            => 'Austria',
                'Belgium'            => 'Belgium',
                'Bulgaria'           => 'Bulgaria',
                'Croatia'            => 'Croatia',
                'Republic of Cyprus' => 'Republic of Cyprus',
                'Czech Republic'     => 'Czech Republic',
                'Denmark'            => 'Denmark',
                'Estonia'            => 'Estonia',
                'Finland'            => 'Finland',
                'France'             => 'France',
                'Germany'            => 'Germany',
                'Greece'             => 'Greece',
                'Hungary'            => 'Hungary',
                'Ireland'            => 'Ireland',
                'Italy'              => 'Italy',
                'Latvia'             => 'Latvia',
                'Lithuania'          => 'Lithuania',
                'Luxembourg'         => 'Luxembourg',
                'Malta'              => 'Malta',
                'Netherlands'        => 'Netherlands',
                'Poland'             => 'Poland',
                'Portugal'           => 'Portugal',
                'Romania'            => 'Romania',
                'Slovakia'           => 'Slovakia',
                'Slovenia'           => 'Slovenia',
                'Spain'              => 'Spain',
                'Sweden'             => 'Sweden',
            ], 'wrapperAttributes' => ['class' => 'form-group col-md-6']],
            ['name' => 'issuance_date', 'type' => 'date', 'wrapperAttributes' => ['class' => 'form-group col-md-6']],
            ['name' => 'expiry_date', 'type' => 'date', 'wrapperAttributes' => ['class' => 'form-group col-md-6']],
            ['name' => 'first_name', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'middle_name', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'last_name', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'birth_date', 'type' => 'date'],
            ['name' => 'species', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'breed', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'colour', 'type' => 'text', 'wrapperAttributes' => ['class' => 'form-group col-md-4']],
            ['name' => 'notes', 'type' => 'textarea'],

        ];
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
}
