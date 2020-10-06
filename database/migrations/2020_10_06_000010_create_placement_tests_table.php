<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placement_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('course_registration_id');
            $table->text('path')->nullable();
            $table->enum('status', ['Not Passed', 'Passed']);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('result_updated_at')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('course_registration_id')
                ->references('id')->on('course_registrations')
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
        Schema::dropIfExists('placement_tests');
    }
}
