<?php

namespace App\Http\Middleware;

use Backpack\CRUD\app\Library\Widget;
use Closure;

/**
 * Shows a short explainer at the top of any page when the URL carries
 * ?explainer=<key>, for example /admin/pet-shop/owner?explainer=list.
 *
 * The "Features" menu links to CRUD pages this way, so the same page can
 * be a plain example (from the Examples menu) or a guided one (from Features).
 * The texts live in config/demo.php, under 'explainers'.
 */
class DemoExplainer
{
    public function handle($request, Closure $next): mixed
    {
        $key = $request->query('explainer');
        $explainer = is_string($key) ? config('demo.explainers.'.$key) : null;

        if ($explainer) {
            Widget::add([
                'type'      => 'view',
                'view'      => 'admin.widgets.explainer',
                'explainer' => $explainer + ['key' => $key],
            ])->to('before_breadcrumbs');
        }

        return $next($request);
    }
}
