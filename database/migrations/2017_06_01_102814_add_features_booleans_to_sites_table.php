<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturesBooleansToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->boolean('enable_ssh')->default(false)->after('rate');
            $table->boolean('enable_db')->default(false)->after('key_id');
            $table->boolean('enable_nginx_configuration')->default(false)->after('certificate_attempts');
            $table->boolean('enable_crontab')->default(false)->after('enable_nginx_configuration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn(['enable_ssh', 'enable_db', 'enable_nginx_configuration', 'enable_crontab']);
        });
    }
}
