<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_question_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_question_id');
            $table->text('answer')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('form_question_id')
                ->references('id')->on('form_questions')
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
        Schema::dropIfExists('form_question_choices');
    }
}
