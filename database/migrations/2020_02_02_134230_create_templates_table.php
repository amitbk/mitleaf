<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            // template created by
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('desc')->nullable();

            $table->integer('image_id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');

            $table->integer('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');

            $table->integer('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');

            $table->integer('firm_type_id');
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->text('data')->nullable();

            $table->bigInteger('used_count')->default(0);
            $table->boolean('can_add_watermark')->default(true);
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
        Schema::dropIfExists('templates');
    }
}
