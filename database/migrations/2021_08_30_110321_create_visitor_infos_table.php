<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_infos', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('browser')->nullable();
            $table->string('device')->nullable();
            $table->string('platfom')->nullable();
            $table->string('country')->nullable();
            $table->timestamp('session_in')->nullable();
            $table->timestamp('session_out')->nullable();
            $table->timestamp('date_time')->nullable();
            $table->string('referral')->nullable();
            $table->string('custom_session')->nullable();
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
        Schema::dropIfExists('visitor_infos');
    }
}
