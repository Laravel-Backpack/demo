<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Prologue\Alerts\Facades\Alert;

class TablerThemeController extends Controller
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (config('backpack.ui.view_namespace') !== 'backpack.theme-tabler::') {
            throw new Exception('Page only available on Tabler theme.');
        }
    }

    public function index(): View
    {
        return view('backpack.theme-tabler::layouts');
    }

    public function switchLayout(string $layout): RedirectResponse
    {
        Session::put('backpack.theme-tabler.layout', $layout);

        Alert::success('<strong>Boom!</strong><br>How does it look like now?')->flash();

        return Redirect::route('backpack.dashboard');
    }
}
