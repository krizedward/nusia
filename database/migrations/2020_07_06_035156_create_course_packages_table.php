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
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('material_type_id');
            $table->unsignedBigInteger('course_type_id');
            $table->unsignedBigInteger('course_level_id');
            //$table->unsignedBigInteger('course_level_detail_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('count_session')->unsigned()->nullable();
            $table->bigInteger('price')->unsigned()->nullable();
            $table->text('refund_description')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

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
            /*$table->foreign('course_level_detail_id')
                ->references('id')->on('course_level_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
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
