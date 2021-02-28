<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_labels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('notification_id');
            $table->unsignedBigInteger('content_label_id');
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('notification_id')
                ->references('id')->on('notifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('content_label_id')
                ->references('id')->on('content_labels')
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
        Schema::dropIfExists('notification_labels');
    }
}
