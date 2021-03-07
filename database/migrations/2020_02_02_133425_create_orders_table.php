<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// use Illuminate\Database\Query\Expression;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            // by user
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // for firm
            $table->unsignedBigInteger('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->double('amount');
            $table->boolean('is_trial')->default(false);
            $table->integer('duration_selected')->default(0); // in months

            $table->timestamp('date_start_from')->nullable()->default(null);
            $table->timestamp('date_expiry')->nullable()->default(null);
            // $table->timestamp('date_scheduled_upto')->nullable()->default(null);

            $table->integer('status')->default(0); // payment success=1, failed=0

            // $table->json('payments_meta')->default(new Expression('(JSON_ARRAY())'));

            $table->string('razorpay_order_id')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
