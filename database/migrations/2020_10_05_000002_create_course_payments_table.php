<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('course_registration_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->timestamp('payment_time')->nullable();
            $table->bigInteger('amount')->unsigned()->nullable();
            $table->enum('status', ['Not Confirmed', 'Refunded', 'Wallet', 'Confirmed']);
            $table->timestamp('refunded_at')->nullable();
            $table->longText('path')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('course_registration_id')
                ->references('id')->on('course_registrations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('payment_type_id')
                ->references('id')->on('payment_types')
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
        Schema::dropIfExists('course_payments');
    }
}
