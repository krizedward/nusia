<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class oldCreateUserSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug')->unique();
            $table->integer('age')->unsigned()->nullable();
            $table->enum('status_job', ['Professional', 'Student']);
            $table->text('status_description')->nullable();
            $table->text('status_value')->nullable();
            $table->text('interest');
            $table->enum('target_language_experience', ['Never (no experience)', '< 6 months', '<= 1 year', 'Others']);
            $table->integer('target_language_experience_value')->nullable();
            $table->text('description_of_course_taken')->nullable();
            $table->enum('indonesian_language_proficiency', ['Novice', 'Intermediate', 'Advanced']);
            $table->text('learning_objective')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('user_surveys');
    }
}
