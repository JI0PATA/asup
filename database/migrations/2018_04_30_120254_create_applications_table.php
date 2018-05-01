<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place');
            $table->string('equipment');
            $table->text('comment')->nullable();
            $table->string('call');
            $table->integer('level')->default(0);

            $table->integer('create_user_id')->unsigned();
            $table->foreign('create_user_id')->references('id')->on('users');

            $table->integer('accept_user_id')->unsigned()->nullable();
            $table->foreign('accept_user_id')->references('id')->on('users');

            $table->dateTime('created_at');
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
