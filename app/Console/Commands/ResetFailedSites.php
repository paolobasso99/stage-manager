<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Site;

class ResetFailedSites extends Command
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
    protected $description = 'Reset failed sites.';

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

        //Get all failed sites
        $sites = Site::failed();

        //Reset their stats
        foreach ($sites as $site) {

            $this->comment('Resetting ' . $site->url . ' ...');

            $site->tried = 0;
            $site->certificate_attempts = 0;
            $site->down_from = null;
            $site->save();
        }

        $this->info('Reset complete');
    }
}
