<?php

namespace App\Console\Commands\Check;

use Illuminate\Console\Command;
use App\Email;
use Adldap\Laravel\Facades\Adldap;

class Emails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all emails with the LDAP';

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
        $this->line('Start syncing...');

        $ldapUsers = Adldap::search()->users()->get();

        foreach ($ldapUsers as $ldapUser) {
            //Check if it's null
            if ($ldapUser->mail[0] != null) {
                $this->comment('Syncing ' . $ldapUser->mail[0] . '...');

                //Check if it already exist
                if(!Email::where('address', '=', $ldapUser->mail[0])->exists()){
                    //Create
                    Email::create([
                        'address' => $ldapUser->mail[0]
                    ]);
                }

            }
        }

        $this->info('Sync complete');
    }
}
