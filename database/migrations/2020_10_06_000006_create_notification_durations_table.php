<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_durations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('notification_id');
            $table->integer('duration_in_month')->nullable();
            $table->integer('duration_in_day')->nullable();
            $table->integer('duration_in_hour')->nullable();
            $table->integer('duration_in_minute')->nullable();
            $table->integer('duration_in_second')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('notification_id')
                ->references('id')->on('notifications')
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
        Schema::dropIfExists('notification_durations');
    }
}
