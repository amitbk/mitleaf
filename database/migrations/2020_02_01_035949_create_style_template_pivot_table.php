<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStyleTemplatePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('style_id')->unsigned();
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
            // $table->primary(['style_id', 'template_id']);
            $table->string('value')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('style_template');
    }
}
