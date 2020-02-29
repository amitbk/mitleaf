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
            $table->timestamp('schedule_on')->nullable();
            $table->timestamp('is_posted_on_social_media')->nullable();
            $table->boolean('is_finalized')->default(false)->nullable();
            $table->text('content')->nullable()->default(null);

            $table->integer('firm_plan_id');
            $table->foreign('firm_plan_id')->references('id')->on('firm_plans')->onDelete('set null');

            $table->integer('event_id')->nullable()->default(null);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->integer('image_id')->nullable()->default(null);
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');

            $table->integer('template_id')->nullable()->default(null);
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
