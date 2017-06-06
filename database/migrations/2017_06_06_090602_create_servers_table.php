<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->boolean('enable_crontab')->default(false);
            $table->boolean('enable_ssh')->default(false);
            $table->string('ssh_username')->nullable();
            $table->string('ssh_password')->nullable();
            $table->string('ssh_root')->nullable();
            $table->integer('key_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('sites', function (Blueprint $table) {

            $table->integer('server_id')->nullable()->after('url');

            $table->dropColumn([
                'enable_crontab',
                'enable_ssh',
                'ssh_username',
                'ssh_password',
                'key_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');

        Schema::table('sites', function (Blueprint $table) {
            $table->boolean('enable_ssh')->default(false);
            $table->boolean('enable_crontab')->default(false);

            $table->string('ssh_username')->nullable();
            $table->string('ssh_password')->nullable();
            $table->string('ssh_root')->nullable();
            $table->integer('key_id')->nullable();
        });
    }
}
