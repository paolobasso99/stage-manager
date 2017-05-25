<?php

namespace App\Console\Commands\Check;

use Illuminate\Console\Command;
use App\Email;
use Adldap\Laravel\Facades\Adldap;

class syncEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:syncEmails';

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
        $this->line('Syncing...');

        $ldapUsers = Adldap::search()->users()->get();

        $users = array();

        foreach ($ldapUsers as $ldapUser) {
            if(!Email::where('address', '=', $ldapUser->mail[0])->exists()){
                Email::create([
                    'address' => $ldapUser->mail[0]
                ]);
            }
        }

        $this->info('Sync complete');
    }
}
