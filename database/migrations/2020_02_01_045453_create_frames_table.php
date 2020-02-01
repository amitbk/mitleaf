<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frames', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('firm_id');
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('set null');

            $table->integer('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');

            $table->timestamp('schedule_on')->nullable();

            $table->integer('template_id');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
            $table->integer('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null');
            $table->integer('rule_id');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frames');
    }
}
