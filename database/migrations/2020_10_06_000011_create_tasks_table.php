<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('session_id');
            $table->enum('type', ['Assignment', 'Exam']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->text('path_1')->nullable();
            $table->text('path_2')->nullable();
            $table->text('path_3')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
