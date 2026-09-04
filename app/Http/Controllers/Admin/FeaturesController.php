<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Prologue\Alerts\Facades\Alert;

/**
 * The "Features" pages of the demo: one page per Backpack feature we want to
 * show off on its own, outside of a CRUD.
 */
class FeaturesController
{
    /**
     * The old "New in v7" page is now "Components". Old links keep working.
     */
    public function newInV7()
    {
        return redirect()->route('features.components', [], 301);
    }

    public function components()
    {
        return view('admin.features.components', [
            'title'       => 'Components',
            'description' => 'Chips, datagrid, datalist, datatable, dataform and dataform modal: Blade components that show data outside of a CRUD.',
        ]);
    }

    public function widgets()
    {
        return view('admin.features.widgets', [
            'title'       => 'Widgets',
            'description' => 'Cards, alerts, progress bars and charts you can drop on any page.',
        ]);
    }

    public function themes()
    {
        return view('admin.features.themes', [
            'title'       => 'Themes',
            'description' => 'A theme is a whole HTML template adapted to Backpack. Pick one, or build your own.',
        ]);
    }

    public function skins()
    {
        return view('admin.features.skins', [
            'title'       => 'Skins',
            'description' => 'CSS layered on top of the Tabler theme. Same layout, different look.',
        ]);
    }

    public function design()
    {
        return view('admin.features.design', [
            'title'       => 'Design',
            'description' => 'Hundreds of ready-made HTML components, thanks to the open-source templates our themes are built on.',
        ]);
    }

    public function alerts()
    {
        return view('admin.features.alerts', [
            'title'       => 'Alerts',
            'description' => 'Notifications you can trigger from PHP or from JavaScript.',
        ]);
    }

    /**
     * Flash an alert from PHP, then come back to the Alerts page. Shows the PHP way.
     */
    public function triggerAlert(Request $request)
    {
        $type = $request->validate(['type' => ['required', Rule::in(['success', 'info', 'warning', 'error'])]])['type'];

        Alert::{$type}('This '.$type.' alert was flashed from PHP, and shown on the next page load.')->flash();

        return redirect()->route('features.alerts');
    }
}
