<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Prologue\Alerts\Facades\Alert;

/**
 * Demo-only endpoints. Nothing here exists in a real Backpack app.
 */
class DemoController extends Controller
{
    /**
     * How long the visitor's choices are remembered, in minutes (one year).
     */
    public const COOKIE_LIFETIME = 60 * 24 * 365;

    /**
     * Remember the visitor's theme, layout, skin and text direction in a cookie,
     * so they survive logging out and already apply on the login page.
     */
    public function switchTheme(Request $request)
    {
        $submitted = array_filter($request->validate([
            'theme'     => ['nullable', Rule::in(array_keys(config('demo.themes')))],
            'layout'    => ['nullable', Rule::in(array_keys(config('demo.layouts')))],
            'skin'      => ['nullable', Rule::in(array_keys(config('demo.skins')))],
            'direction' => ['nullable', Rule::in(['ltr', 'rtl'])],
        ]));

        $before = demo_choices();
        $changed = [];

        foreach ($submitted as $key => $value) {
            if (($before[$key] ?? null) !== $value) {
                $changed[] = $this->label($key, $value);
            }
        }

        Cookie::queue('demo', json_encode(array_merge($before, $submitted)), self::COOKIE_LIFETIME);

        if ($request->expectsJson()) {
            return response()->json(['changed' => $changed]);
        }

        if (count($changed)) {
            Alert::success('Now using '.implode(', ', $changed).'.')->flash();
        }

        // Re-open the drawer after the reload, so the visitor can keep browsing the options.
        Session::flash('demo.open_drawer', true);

        return redirect()->back();
    }

    private function label(string $key, string $value): string
    {
        return match ($key) {
            'theme'     => 'the '.config("demo.themes.$value.name").' theme',
            'layout'    => 'the '.config("demo.layouts.$value.name").' layout',
            'skin'      => 'the '.config("demo.skins.$value.name").' skin',
            'direction' => strtoupper($value).' text direction',
        };
    }
}
