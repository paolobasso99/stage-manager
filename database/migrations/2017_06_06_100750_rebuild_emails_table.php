<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('emails', 'contacts');
        Schema::table('contacts', function (Blueprint $table) {

            $table->renameColumn('address', 'email');

        });
        Schema::table('contacts', function (Blueprint $table) {

            $table->string('name')->after('id');
            $table->string('email')->after('name')->change();

        });

        Schema::rename('email_site', 'contact_site');
        Schema::table('contact_site', function (Blueprint $table) {

            $table->renameColumn('email_id', 'contact_id');
            $table->softDeletes()->after('site_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
