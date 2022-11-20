<?php

namespace App\Providers;

use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Facades\CauserResolver;

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

        CauserResolver::setCauser(User::first());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // register the services that are only used for development
    }
}
