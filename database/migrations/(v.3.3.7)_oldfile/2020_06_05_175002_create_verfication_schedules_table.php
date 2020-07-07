<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class oldCreateVerficationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verfication_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('schedule_id');
            $table->string('upload_data')->nullable();
            $table->string('done')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('schedule_id')
            ->references('id')
            ->on('schedules')
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
        Schema::dropIfExists('verfication_schedules');
    }
}
