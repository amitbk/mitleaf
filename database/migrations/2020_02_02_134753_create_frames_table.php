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
            $table->integer('firm_plans_id');
            $table->foreign('firm_plans_id')->references('id')->on('firm_planss')->onDelete('set null');

            $table->integer('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');

            $table->timestamp('schedule_on')->nullable();
            $table->timestamp('is_posted_on_social_media')->nullable();

            $table->integer('template_id')->nullable();
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');

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
