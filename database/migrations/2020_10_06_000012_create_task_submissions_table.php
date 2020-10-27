<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('session_registration_id');
            $table->unsignedBigInteger('task_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['Not Accepted', 'Accepted']);
            $table->integer('score')->nullable();
            $table->text('instructor_reply')->nullable();
            $table->text('path_1')->nullable();
            $table->timestamp('path_1_submitted_at')->nullable();
            $table->text('path_2')->nullable();
            $table->timestamp('path_2_submitted_at')->nullable();
            $table->text('path_3')->nullable();
            $table->timestamp('path_3_submitted_at')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('session_registration_id')
                ->references('id')->on('session_registrations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('task_id')
                ->references('id')->on('tasks')
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
        Schema::dropIfExists('task_submissions');
    }
}
