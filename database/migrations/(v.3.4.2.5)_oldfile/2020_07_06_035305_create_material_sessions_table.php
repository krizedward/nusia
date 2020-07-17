<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class oldCreateMaterialSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('session_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('path')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('session_id')
                ->references('id')->on('sessions')
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
        Schema::dropIfExists('material_sessions');
    }
}
