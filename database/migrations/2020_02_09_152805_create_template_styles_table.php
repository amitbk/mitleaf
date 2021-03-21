<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_styles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id')->unsigned()->nullable();
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');

            $table->unsignedBigInteger('style_id')->unsigned()->nullable();
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');
            $table->text('data')->nullable();

            $table->integer('ratio')->default(35);
            $table->integer('x_axis')->default(20);
            $table->integer('y_axis')->default(20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_styles');
    }
}
