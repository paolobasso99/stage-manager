<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use App\Site;

class CheckByUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:urls {urls* : The url of the sites to check}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check sites foud by url.';

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
        $this->line('Checking...');
        $client = new Client();

        //Retrive input
        $urls = $this->argument('urls');

        foreach ($urls as $url) {
            //Get the site
            $site = Site::where('url', '=', $url)->first();

            //Chek if the site exist in the database
            if($site){

                $this->comment('Checking ' . $url . ' ...');

                //Check the site
                app('SiteChecker')->checkOne($site, $client);

            } else {
                $this->error('A website with the url "' . $url . '" does not exist in the database.');
            }

        }

        $this->info('Check complete');
    }
}
