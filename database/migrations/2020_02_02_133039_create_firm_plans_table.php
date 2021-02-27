<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_plans', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('firm_id')->unsigned()->index();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            $table->integer('plan_id')->unsigned()->index();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

            $table->integer('order_plan_id')->unsigned()->index();
            $table->foreign('order_plan_id')->references('id')->on('order_plans')->onDelete('cascade');

            $table->integer('qty_per_month')->default(0);

            $table->integer('firm_type_id')->nullable();
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->timestamp('date_post_created_upto')->nullable()->default(null);
            $table->timestamp('date_start_from')->nullable()->default(null);
            $table->timestamp('date_scheduled_upto')->nullable()->default(null);
            $table->timestamp('date_expiry')->nullable();
            $table->boolean('is_post_plan')->default(true);
            $table->boolean('is_trial')->default(false);

            // which asset to use while creating posts: ref in asset_types table
            $table->integer('st_use_asset_type')->nullable()->default(1);
            // settings for post
            $table->string('st_language')->nullable();
            $table->string('st_shape')->nullable();
            $table->string('st_shade_type')->nullable();
            $table->string('st_color')->nullable();
            $table->string('st_logo')->nullable();
            $table->string('st_strip')->nullable();
            $table->string('st_watermark')->nullable();

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
        Schema::dropIfExists('firm_plans');
    }
}
