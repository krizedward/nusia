<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password');
            $table->enum('roles', ['Student', 'Instructor', 'Lead Instructor', 'Customer Service', 'Financial Team', 'Admin']);
            $table->string('citizenship');
            $table->string('domicile')->nullable();
            $table->string('timezone')->nullable();
            $table->string('website_language')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone', 15)->nullable();
            $table->longText('image_profile')->nullable();
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
        Schema::dropIfExists('users');
    }
}
