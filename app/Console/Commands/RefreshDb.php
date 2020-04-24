<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;
use Log;

class RefreshDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh database structure and entries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::warning('Cleanup time. Refreshing the database.');
        Artisan::call('db:wipe --force');
        Artisan::call('migrate --force');
        Artisan::call('db:seed --force');
        Artisan::call('backup:clean');
    }
}
