<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');

            // user
            $table->unsignedBigInteger('transaction_type_id')->unsigned();
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');

            // user
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // firm
            $table->unsignedBigInteger('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            // order
            $table->unsignedBigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedBigInteger('creditor_id')->unsigned();
            $table->foreign('creditor_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('debtor_id')->unsigned();
            $table->foreign('debtor_id')->references('id')->on('users')->onDelete('cascade');

            $table->double('amount');
            $table->string('naration')->nullable();

            $table->integer('level_id')->unsigned();

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
        Schema::dropIfExists('bills');
    }
}
