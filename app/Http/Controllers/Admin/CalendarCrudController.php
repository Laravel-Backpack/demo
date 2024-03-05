<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CalendarRequest;
use App\Models\Calendar;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;

/**
 * Class CalendarCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CalendarCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CalendarOperation\CalendarOperation;

    use \App\Http\Controllers\Admin\Operations\SMSOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     */
    public function setup(): void
    {
        CRUD::setModel(Calendar::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/calendar');
        CRUD::setEntityNameStrings(__('calendar event'), __('calendar events'));
    }

    public function getCalendarFieldsMap()
    {
        return [
            'title'            => 'title',
            'start'            => 'start',
            'end'              => 'end',
            'background_color' => 'background_color',
            'text_color'       => 'text_color',
            'all_day'          => 'all_day',
        ];
    }

    public function setupCalendarOperation()
    {
        $this->crud->setOperationSetting('initial-view', 'dayGridMonth');

        $this->crud->setOperationSetting('views', ['dayGridMonth', 'timeGridWeek', 'timeGridDay']);

        $this->crud->setOperationSetting('editable', true);

        $this->crud->setOperationSetting('background_color', '#3788d8');

        $this->crud->setOperationSetting('text_color', '#ffffff');

        $this->addCalendarLineButton(
            action: 'sms',
            label: 'Send SMS',
            url: fn (Calendar $entry) => url($this->crud->route.'/'.$entry->id.'/s-m-s'),
            group: 'send'
        );

        $this->addCalendarLineButton(
            action: 'email',
            label: 'Send Email',
            url: fn (Calendar $entry) => url($this->crud->route.'/'.$entry->id.'/s-m-s?email='.$entry->email),
            group: 'send'
        );

        $this->addCalendarLineButton(
            action: 'call',
            label: 'Call',
            url: fn (Calendar $entry) => url($this->crud->route.'/'.$entry->id.'/s-m-s?call='.$entry->number),
            group: 'call'
        );

        $this->addCalendarLineButton(
            action: 'alert',
            label: 'Javascript Event',
            group: 'alert',
            properties: [
                'message' => 'Alert message!',
            ],
        );

        Widget::add()
            ->type('script')
            ->content('assets/js/calendar.js');
    }

    /**
     * Define what happens when the List operation is loaded.
     */
    protected function setupListOperation(): void
    {
        CRUD::column('title')
            ->type('text');

        CRUD::column('start')
            ->type('datetime');

        CRUD::column('end')
            ->type('datetime');

        CRUD::column('background_color')
            ->showColorHex(false)
            ->type('color');
    }

    /**
     * Define what happens when the Create operation is loaded.
     */
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(CalendarRequest::class);

        $start = request()->has('start') ? Carbon::parse(request('start')) : null;
        $end = request()->has('end') ? Carbon::parse(request('end')) : null;

        CRUD::field('title')
            ->type('text');

        CRUD::field('all_day')
            ->type('switch');

        CRUD::field('start')
            ->type('datetime')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->value($start);

        CRUD::field('end')
            ->type('datetime')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->value($end);

        CRUD::field('separator')
            ->type('custom_html')
            ->value('');

        CRUD::field('background_color')
            ->type('color')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->default('#3788d8');

        CRUD::field('text_color')
            ->type('color')
            ->wrapper(['class' => 'form-group col-md-6'])
            ->default('#ffffff');

        Widget::add()
            ->type('script')
            ->content('assets/js/calendar.js');
    }

    /**
     * Define what happens when the Update operation is loaded.
     */
    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
