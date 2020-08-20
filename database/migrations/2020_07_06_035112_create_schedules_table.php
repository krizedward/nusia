<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
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
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('instructor_id_2');
            $table->timestamp('schedule_time');
            $table->enum('status', ['Available', 'Busy']);
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('instructor_id')
                ->references('id')->on('instructors')
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
        Schema::dropIfExists('schedules');
    }
}
