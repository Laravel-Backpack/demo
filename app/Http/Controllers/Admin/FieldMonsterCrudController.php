<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

class FieldMonsterCrudController extends MonsterCrudController
{
    public function setup()
    {
        $this->crud->setModel(\App\Models\Monster::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/field-monster');
        $this->crud->setEntityNameStrings('field monster', 'field monsters');

        $this->crud->set('show.setFromDb', false);
    }

    protected function setupCreateOperation()
    {
        $this->setupFieldsForTopScenarios();

        parent::setupCreateOperation();

        // load all the fields as a JS array
        Widget::add()->type('script')->content('assets/js/monster/fields.js');
        // then test each crud.field() method individually
        Widget::add()->type('script')->content('assets/js/monster/test-hide-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-show-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-disable-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-enable-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-require-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-unrequire-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-custom-field.js');
        Widget::add()->type('script')->content('assets/js/monster/test-onchange-field.js');
    }

    protected function setupFieldsForTopScenarios()
    {
        Widget::add()->type('script')->content('assets/js/monster/test-top-scenarios.js');

        CRUD::field('notice')->type('custom_html')->value('<i class="text-small">This tab shows the Top 10 Scenarios that the crud.field() JS library covers. These fields will NOT hide/show/etc when the buttons above are clicked, that\'s ok, don\'t worry.</i><hr>')->tab('Top 10 Scenarios');

        // MUST: when a checkbox is checked, show a second field;
        CRUD::field('visible')->type('checkbox')->fake(true)->tab('Top 10 Scenarios');
        CRUD::field('visible_where')->type('text')->fake(true)->wrapperAttributes(['class' => 'form-group col-sm-11 offset-1'])->tab('Top 10 Scenarios');

        // MUST: when a checkbox is checked, show a second field AND un-disable/un-readonly it;
        CRUD::field('displayed')->type('checkbox')->fake(true)->tab('Top 10 Scenarios');
        CRUD::field('displayed_where')->type('text')->fake(true)->wrapperAttributes(['class' => 'form-group col-sm-11 offset-1'])->tab('Top 10 Scenarios');

        // MUST: when a radio has something specific selected, show a second field;
        CRUD::field('type')->type('radio')->options(['Type A', 'Type B', 'Type C', 'Other'])->inline(true)->fake(true)->tab('Top 10 Scenarios');
        // when type is Other, show an input to specify its type
        CRUD::field('custom_type')->type('text')->fake(true)->wrapperAttributes(['class' => 'form-group col-sm-11 offset-1'])->tab('Top 10 Scenarios');

        // MUST: when a select has something specific selected, show a second field;
        CRUD::field('parent')->type('select_from_array')->options([
            1 => 'Parent 1',
            2 => 'Parent 2',
            3 => 'Parent 3',
            4 => 'Parent 4',
            5 => 'Parent 5',
            6 => 'Parent 6',
            6 => 'Other',
        ])->fake(true)->wrapperAttributes(['class' => 'form-group col-sm-6'])->tab('Top 10 Scenarios');
        CRUD::field('custom_parent')->type('text')->fake(true)->wrapperAttributes(['class' => 'form-group col-sm-6'])->tab('Top 10 Scenarios');
        CRUD::field('another_separator')->type('custom_html')->value('<hr>')->tab('Top 10 Scenarios');

        // MUST: when a checkbox is checked AND a select has a certain value, then show a third field;
        // done, re-used displayed and parent

        // MUST: when a checkbox is checked OR a select has a certain value, then show a third field;
        // done, re-used displayed and parent

        // SHOULD: when a select is a certain value, show a second field; if it's another value, show a third field;
        // done, re-used category

        // SHOULD: when a checkbox is checked, automatically check a different checkbox or radio;
        // done, re-used visible, it now checks displayed

        // COULD: when a text input is written into, write into a second input (eg. slug);
        CRUD::field('title')->size(6)->tab('Top 10 Scenarios');
        CRUD::field('title_url_segment')->size(6)->tab('Top 10 Scenarios');

        // COULD: when multiple inputs change, change a last input to calculate the total or smth;
        CRUD::field('full_price')->type('number')->size(4)->tab('Top 10 Scenarios');
        CRUD::field('discounted_price')->type('number')->size(4)->tab('Top 10 Scenarios');
        CRUD::field('discount_percentage')->type('number')->size(4)->tab('Top 10 Scenarios');
        CRUD::field('repeatable_example_1')->type('repeatable')->tab('Top 10 Scenarios')->store_in('extras')->subfields([
            [
                'name'    => 'yes_or_no',
                'type'    => 'select2_from_array',
                'label'   => 'Yes or No',
                'options' => ['no' => 'no', 'yes'=> 'yes'],
            ],
            [
                'name' => 'if_no',
                'type' => 'text',
            ],
            [
                'name' => 'if_yes',
                'type' => 'text',
            ],
        ]);

        CRUD::field('repeatable_example_2')->type('repeatable')->tab('Top 10 Scenarios')->store_in('extras')->subfields([
            [
                'name'  => 'how_many',
                'type'  => 'number',
                'label' => 'How Many?',
                'min'   => 1,
                'step'  => 1,
            ],
            [
                'name' => 'if_more_than_10',
                'type' => 'text',
            ],
            [
                'name' => 'if_more_than_20',
                'type' => 'text',
            ],
        ]);

        CRUD::field('live_validation_select')->type('select2_from_array')->options([
            'Zero', 'One', 'Two', 'Three',
        ])->tab('Top 10 Scenarios')->size(4);
        CRUD::field('live_validation_text')->type('text')->tab('Top 10 Scenarios')->size(4);
        CRUD::field('live_validation_number')->type('number')->step(1)->tab('Top 10 Scenarios')->size(4);
    }
}
