<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class oldCreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('class_id');
            $table->time('time_meet')->nullable();
            $table->date('date_meet')->nullable();
            $table->string('zoom_link')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onDelete('cascade');

            $table->foreign('instructor_id')
            ->references('id')
            ->on('instructors')
            ->onDelete('cascade');

            $table->foreign('class_id')
            ->references('id')
            ->on('classrooms')
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
        Schema::dropIfExists('schedules');
    }
}
