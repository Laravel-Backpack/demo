<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Http\Controllers\Operations\Concerns\HasForm;

trait SMSOperation //Custom Form Operation Example
{
    use HasForm;

    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupSMSRoutes(string $segment, string $routeName, string $controller): void
    {
        $this->formRoutes(
            operationName: 'SMS',
            routesHaveIdSegment: true,
            segment: $segment,
            routeName: $routeName,
            controller: $controller
        );
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupSMSDefaults(): void
    {
        $this->formDefaults(
            operationName: 'SMS',
            buttonStack: 'line', // alternatives: top, bottom
            buttonMeta: [
                'icon'    => 'las la-sms',
                'label'   => 'SMS',
            ],
        );
    }

    /**
     * Method to handle the GET request and display the View with a Backpack form.
     */
    public function getSMSForm(?int $id = null): \Illuminate\Contracts\View\View
    {
        $this->crud->hasAccessOrFail('SMS');
        $this->crud->addField('text');

        return $this->formView($id);
    }

    /**
     * Method to handle the POST request and perform the operation.
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function postSMSForm(?int $id = null)
    {
        $this->crud->hasAccessOrFail('SMS');

        return $this->formAction($id, function ($inputs, $entry) {
            // You logic goes here...
            // dd('got to ' . __METHOD__, $inputs, $entry);

            // show a success message
            \Alert::success('SMS Sent: '.$inputs['text'])->flash();
        });
    }
}
