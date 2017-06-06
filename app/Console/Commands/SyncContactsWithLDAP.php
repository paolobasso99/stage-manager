<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contact;
use Adldap\Laravel\Facades\Adldap;

class SyncContactsWithLDAP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sync-ldap';

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
            //Check if it has an email
            if ($ldapUser->getEmail() != null) {
                $this->comment('Syncing ' . $ldapUser->getEmail() . ' ...');

                //Check if it already exist
                if(!Contact::where('email', '=', $ldapUser->getEmail())->exists()){
                    //Create
                    Contact::create([
                        'email' => $ldapUser->getEmail(),
                        'name' => $ldapUser->getDisplayName()
                    ]);
                }

            }
        }

        $this->info('Sync complete');
    }
}
