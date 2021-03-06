<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_plans', function (Blueprint $table) {
            $table->bigIncrements('id');

            // order
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // plan
            $table->unsignedBigInteger('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

            // qty in months
            $table->double('qty');
            $table->double('rate');

            // is this plan available to redeem or not
            $table->boolean('is_available')->default(false)->nullable();
            // $table->boolean('is_trial')->default(false);

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
        Schema::dropIfExists('order_plans');
    }
}
