<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursePackageDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_package_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('course_package_id');
            $table->bigInteger('price')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->enum('status', ['Active', 'Nonactive']);
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
        Schema::dropIfExists('course_package_discounts');
    }
}
