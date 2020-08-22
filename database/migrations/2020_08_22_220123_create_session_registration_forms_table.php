<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionRegistrationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_registration_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_registration_id');
            $table->unsignedBigInteger('form_question_response_id');
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('session_registration_id')
                ->references('id')->on('session_registrations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('form_question_response_id')
                ->references('id')->on('form_question_responses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_registration_form_responses');
    }
}
