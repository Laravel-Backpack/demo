<?php

namespace App\Http\Controllers\Admin;

/**
 * One page per paid add-on: what it does, why you would want it, where to get it.
 * Content lives in config/demo.php, under 'paid_addons'.
 */
class PaidAddonsController
{
    public function show(string $addon)
    {
        $config = config('demo.paid_addons.'.$addon);

        abort_unless($config, 404);

        return view('admin.paid.addon', [
            'key'         => $addon,
            'addon'       => $config,
            'title'       => $config['name'],
            'description' => $config['tagline'],
        ]);
    }
}
