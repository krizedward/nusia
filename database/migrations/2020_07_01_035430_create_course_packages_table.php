<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->foreign('material_type_id')
                ->references('id')->on('material_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('course_type_id')
                ->references('id')->on('course_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('course_level_id')
                ->references('id')->on('course_levels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('course_level_detail_id')
                ->references('id')->on('course_level_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->integer('count_session')->unsigned()->nullable();
            $table->bigInteger('price')->unsigned()->nullable();
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
        Schema::dropIfExists('course_packages');
    }
}
