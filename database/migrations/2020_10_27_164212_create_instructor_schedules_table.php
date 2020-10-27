<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('schedule_id');
            $table->enum('status', ['Available', 'Busy']);
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('instructor_id')
                ->references('id')->on('instructors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('schedule_id')
                ->references('id')->on('schedules')
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
        Schema::dropIfExists('instructor_schedules');
    }
}
