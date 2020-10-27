<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTypeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_type_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('material_type_id');
            $table->text('value')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('material_type_id')
                ->references('id')->on('material_types')
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
        Schema::dropIfExists('material_type_values');
    }
}
