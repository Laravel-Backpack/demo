<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Prologue\Alerts\Facades\Alert;

class ThemeController extends Controller
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

    public function switchLayout(Request $request): RedirectResponse
    {
        $theme = 'backpack.theme-' . $request->get('theme', 'tabler') . '::';
        Session::put('backpack.ui.view_namespace', $theme);

        if ($theme === 'backpack.theme-tabler::') {
            Session::put('backpack.theme-tabler.layout', $request->get('layout', 'horizontal'));
        }

        Alert::success('<strong>Boom!</strong><br>How does it look like now?')->flash();

        return Redirect::back();
    }
}
