<?php

namespace App\Providers;

use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'monster' => 'App\Models\Monster',
            'user'    => 'App\User',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // override user crud controller
        $this->app->bind(
            \Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class,
            \App\Http\Controllers\Admin\UserCrudController::class
        );

        // a simple helper to make fields disabled in production
        CrudField::macro('disabledInProduction', function () {
            if (app('env') !== 'production') {
                return $this;
            }

            return $this->attributes(['disabled' => 'disabled'])
                ->hint('Uploads are disabled in production.');
        });
    }
}
