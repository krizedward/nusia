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
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('form_id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirement')->nullable();
            $table->longText('link_zoom')->nullable();
            $table->integer('reschedule_late_confirmation')->nullable();
            $table->integer('reschedule_technical_issue_instructor')->nullable();
            $table->integer('reschedule_technical_issue_student')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('schedule_id')
                ->references('id')->on('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('sessions');
    }
}
