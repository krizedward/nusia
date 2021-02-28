<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('notification_id');
            $table->enum('roles', ['Student', 'Instructor', 'Lead Instructor', 'Customer Service', 'Financial Team', 'Admin']);
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
        Schema::dropIfExists('notification_transactions');
    }
}
