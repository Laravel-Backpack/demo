<?php

namespace App\Providers;

use App\View\Composers\DashboardComposer;
use Backpack\CRUD\app\Library\CrudPanel\CrudField;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Pan\PanConfiguration;

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

        // The Pet Shop numbers on the dashboard.
        View::composer('admin.dashboard', DashboardComposer::class);

        PanConfiguration::allowedAnalytics([
            'my-button',
            'welcome-page',
            'welcome-login-link',
            'welcome-docs-link',
            'welcome-github-link',
            'welcome-contact-link',
            'login-form',
            'menu-item-dashboard',
            'menu-item-features',
            'menu-item-widgets',
            'menu-item-themes',
            'menu-item-skins',
            'menu-item-alerts',
            'menu-item-components',
            'menu-item-design',
            'menu-item-op-list',
            'menu-item-op-create',
            'menu-item-op-update',
            'menu-item-op-delete',
            'menu-item-op-show',
            'menu-item-op-clone',
            'menu-item-op-reorder',
            'menu-item-op-revise',
            'menu-item-op-inline-create',
            'menu-item-op-trash',
            'menu-item-addons',
            'menu-item-paid-addons',
            'menu-item-pro',
            'menu-item-editable-columns',
            'menu-item-report-operation',
            'menu-item-dataform-modal',
            'menu-item-examples',
            'menu-item-petshop',
            'menu-item-crazy-stuff',
            'menu-item-news',
            'menu-item-auth',
            'menu-item-filemanager',
            'menu-item-activity-log',
            'menu-item-translation-manager',
            'menu-item-calendar-operation',
            'menu-item-backup-manager',
            'menu-item-log-manager',
            'menu-item-settings',
            'menu-item-page-manager',
            'menu-item-menu-manager',
            'menu-item-analytics',
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
