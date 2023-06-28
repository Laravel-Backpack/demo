<?php

namespace App\Demo;

use Backpack\Basset\Facades\Basset;
use Backpack\CRUD\ViewNamespaces;

/**
 * This trait automatically loads package stuff, if they're present
 * in the expected directory. Stick to the conventions and
 * your package will "just work". Feel free to override
 * any of the methods below in your ServiceProvider
 * if you need to change the paths.
 */
trait AutomaticServiceProvider
{
    // public function __construct($app)
    // {
    //     //$this->app = $app;
    //     //$this->path = __DIR__.'/..';
    // }

    /**
     * -------------------------
     * SERVICE PROVIDER DEFAULTS
     * -------------------------.
     */

    /**
     * Boot method may be overrided by AddonServiceProvider.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->autoboot();
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function autoboot(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('bootstrap') &&
            file_exists($helpers = $this->packageHelpersFile())) {
            require $helpers;
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->loadTranslationsFrom($this->packageLangsPath(), $this->vendorNameDotPackageName());
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            $this->loadViews();
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('database/migrations')) {
            $this->loadMigrationsFrom($this->packageMigrationsPath());
        }

        if ($this->packageDirectoryExistsAndIsNotEmpty('routes')) {
            $this->loadRoutesFrom($this->packageRoutesFile());
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function loadViews()
    {
        // Load published views
        if (is_dir($this->publishedViewsPath())) {
            $this->loadViewsFrom($this->publishedViewsPath(), $this->vendorNameDotPackageName());
        }

        // Fallback to package views
        $this->loadViewsFrom($this->packageViewsPath(), $this->vendorNameDotPackageName());

        // Add default ViewNamespaces
        foreach (['buttons', 'columns', 'fields', 'filters', 'widgets'] as $viewNamespace) {
            if ($this->packageDirectoryExistsAndIsNotEmpty("resources/views/$viewNamespace")) {
                ViewNamespaces::addFor($viewNamespace, $this->vendorNameDotPackageName()."::{$viewNamespace}");
            }
        }

        // Add basset view path
        Basset::addViewPath($this->packageViewsPath());
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->mergeConfigFrom($this->packageConfigFile(), $this->vendorNameDotPackageName());
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        if ($this->packageDirectoryExistsAndIsNotEmpty('config')) {
            $this->publishes([
                $this->packageConfigFile() => $this->publishedConfigFile(),
            ], 'coreuiv4-config');
        }

        // Publishing the views.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/views')) {
            $this->publishes([
                $this->packageViewsPath() => $this->publishedViewsPath(),
            ], 'views');

            // Add basset view path
            Basset::addViewPath($this->packageViewsPath());
        }

        // Publishing assets.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/assets')) {
            $this->publishes([
                $this->packageAssetsPath() => $this->publishedAssetsPath(),
            ], 'assets');
        }

        // Publishing the translation files.
        if ($this->packageDirectoryExistsAndIsNotEmpty('resources/lang')) {
            $this->publishes([
                $this->packageLangsPath() => $this->publishedLangsPath(),
            ], 'lang');
        }

        // Registering package commands.
        if (!empty($this->commands)) {
            $this->commands($this->commands);
        }
    }

    /**
     * -------------------
     * CONVENIENCE METHODS
     * -------------------.
     */
    protected function vendorNameDotPackageName()
    {
        return $this->vendorName.'.'.$this->packageName;
    }

    protected function vendorNameSlashPackageName()
    {
        return $this->vendorName.'/'.$this->packageName;
    }

    // -------------
    // Package paths
    // -------------

    protected function packageViewsPath()
    {
        return $this->path.'/resources/views';
    }

    protected function packageLangsPath()
    {
        return $this->path.'/resources/lang';
    }

    protected function packageAssetsPath()
    {
        return $this->path.'/resources/assets';
    }

    protected function packageMigrationsPath()
    {
        return $this->path.'/database/migrations';
    }

    protected function packageConfigFile()
    {
        return $this->path.'/config/'.$this->packageName.'.php';
    }

    protected function packageRoutesFile()
    {
        return $this->path.'/routes/'.$this->packageName.'.php';
    }

    protected function packageHelpersFile()
    {
        return $this->path.'/bootstrap/helpers.php';
    }

    // ---------------
    // Published paths
    // ---------------

    protected function publishedViewsPath()
    {
        return base_path('resources/views/vendor/'.$this->vendorName.'/'.$this->packageName);
    }

    protected function publishedConfigFile()
    {
        return config_path($this->vendorNameSlashPackageName().'.php');
    }

    protected function publishedAssetsPath()
    {
        return public_path('vendor/'.$this->vendorNameSlashPackageName());
    }

    protected function publishedLangsPath()
    {
        return resource_path('lang/vendor/'.$this->vendorName);
    }

    // -------------
    // Miscellaneous
    // -------------

    protected function packageDirectoryExistsAndIsNotEmpty($name)
    {
        // check if directory exists
        if (!is_dir($this->path.'/'.$name)) {
            return false;
        }

        // check if directory has files
        foreach (scandir($this->path.'/'.$name) as $file) {
            if ($file != '.' && $file != '..' && $file != '.gitkeep') {
                return true;
            }
        }

        return false;
    }

    public function packageIsActiveTheme()
    {
        $viewNamespace = $this->vendorNameDotPackageName().'::';

        return config('backpack.ui.view_namespace') === $viewNamespace ||
            config('backpack.ui.view_namespace_fallback') === $viewNamespace;
    }
}
