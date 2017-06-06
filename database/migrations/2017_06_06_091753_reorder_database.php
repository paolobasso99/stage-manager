<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReorderDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sites');
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->text('url');
            $table->integer('server_id')->nullable();
            $table->integer('check_rate');
            $table->boolean('check_response')->default(false);
            $table->integer('response_attempts')->default(0);
            $table->boolean('check_certificate')->default(false);
            $table->integer('certificate_attempts')->default(0);
            $table->boolean('enable_nginx_configuration')->default(false);
            $table->string('ssh_root')->nullable();
            $table->boolean('enable_db')->default(false);
            $table->string('db_host')->nullable();
            $table->string('db_database')->nullable();
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
            $table->timestamp('checked_at');
            $table->timestamp('response_down_from')->nullable();
            $table->timestamp('certificate_down_from')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::dropIfExists('keys');
        Schema::create('keys', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->longText('key');
            $table->string('keyphrase');
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::dropIfExists('attempts');
        Schema::create('attempts', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('server_id');
            $table->integer('status')->nullable();
            $table->longText('message')->nullable();
            $table->float('load_time')->nullable();
            $table->boolean('certificate_validity')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
