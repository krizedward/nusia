<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('schedule_id')
                ->references('id')->on('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->text('link_zoom')->nullable();
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
        Schema::dropIfExists('sessions');
    }
}
