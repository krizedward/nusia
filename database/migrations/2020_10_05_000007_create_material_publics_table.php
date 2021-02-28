<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialPublicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_publics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('course_package_id');
            $table->integer('session_number');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('path')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('course_package_id')
                ->references('id')->on('course_packages')
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
        Schema::dropIfExists('material_publics');
    }
}
