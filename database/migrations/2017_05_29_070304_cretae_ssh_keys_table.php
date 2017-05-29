<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaeSshKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('key');
            $table->string('keyphrase')->nullable();
            $table->timestamps();
        });
        Schema::table('sites', function (Blueprint $table) {
            $table->integer('key_id')->nullable()->after('ssh_root');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys');
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('key_id');
        });
    }
}
