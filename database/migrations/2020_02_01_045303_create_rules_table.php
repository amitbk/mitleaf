<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firm_id');
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->integer('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // $table->integer('frame_qty');
            $table->integer('repeat_days')->nullable();
            $table->integer('repeat_months')->nullable();
            $table->integer('repeat_years')->nullable();

            $table->integer('stock')->default(0);
            $table->timestamp('date_last_created')->nullable();
            $table->timestamp('date_scheduled')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('add_watermark')->default(false);

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
        Schema::dropIfExists('rules');
    }
}
