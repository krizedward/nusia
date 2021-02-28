<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormResponseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_response_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_response_id');
            $table->longText('answer')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('form_response_id')
                ->references('id')->on('form_responses')
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
        Schema::dropIfExists('form_response_details');
    }
}
