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

            $table->integer('qty_per_month')->default(0);

            $table->integer('firm_type_id')->nullable();
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->timestamp('date_last_created')->nullable();
            $table->timestamp('date_scheduled')->nullable();
            $table->timestamp('date_expiry')->nullable();
            $table->boolean('is_frame_plan')->default(true);
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
