<?php

namespace App\Console\Commands\Check;

use Illuminate\Console\Command;

class ResetAttemptsCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the attempt counter of all sites.';

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
        $this->line('Resetting...');
        app('siteChecker')->resetAttemptsCounter();
        $this->info('Reset complete');
    }
}
