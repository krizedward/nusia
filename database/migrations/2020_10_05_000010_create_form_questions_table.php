<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_id');
            $table->string('is_required', 10)->nullable();
            $table->string('code', 50)->nullable();
            $table->longText('question')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('answer_type')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('form_id')
                ->references('id')->on('forms')
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
        Schema::dropIfExists('form_questions');
    }
}
