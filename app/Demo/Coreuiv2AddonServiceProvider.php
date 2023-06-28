<?php

namespace App\Demo;

use Illuminate\Support\ServiceProvider;

class Coreuiv2AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected $vendorName = 'backpack';
    protected $packageName = 'theme-coreuiv2';
    protected $commands = [];
    protected $theme = true;

    /**
     * The src directory of the add-on.
     *
     * @var string
     */
    protected string $path;

    public function __construct($app)
    {
        $this->app = $app;
        $this->path = __DIR__.'/../../vendor/backpack/theme-coreuiv2';
    }
}
