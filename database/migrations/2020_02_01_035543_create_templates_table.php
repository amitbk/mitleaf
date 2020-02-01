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
            $table->integer('asset_type_id');
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('set null');

            $table->bigInteger('used_count');
            $table->boolean('can_add_watermark');

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
