<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('session_id')
                ->references('id')->on('sessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('course_registration_id')
                ->references('id')->on('course_registrations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamp('registration_time')->nullable();
            $table->enum('status', ['Not Present', 'Present']);
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_registrations');
    }
}
