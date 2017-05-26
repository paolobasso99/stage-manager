<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSshCollumnsToSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->string('ssh_username')->nullable()->after('rate');
            $table->string('ssh_password')->nullable()->after('ssh_username');
            $table->string('ssh_root')->nullable()->after('ssh_password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'ssh_username',
                'ssh_password',
                'ssh_root'
            ]);
        });
    }
}
