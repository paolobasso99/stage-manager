<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSshRootFromServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('servers', function (Blueprint $table) {
             $table->dropColumn('ssh_root');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('servers', function (Blueprint $table) {
             $table->string('ssh_root')->nullable()->after('ssh_password');
         });
     }
}
