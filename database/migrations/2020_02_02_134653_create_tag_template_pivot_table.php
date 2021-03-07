<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTemplatePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_template', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->unsignedBigInteger('template_id')->unsigned()->index();
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
            // $table->primary(['tag_id', 'template_id']);
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
        Schema::dropIfExists('tag_template');
    }
}
