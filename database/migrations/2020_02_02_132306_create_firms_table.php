<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('about')->nullable();

            $table->string('address')->nullable();
            $table->string('taluka')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pin')->nullable();
            $table->string('gstin')->nullable();
            $table->integer('logo_id')->nullable();
            $table->foreign('logo_id')->references('id')->on('images')->onDelete('set null');

            $table->integer('firm_id')->nullable();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('set null');

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
        Schema::dropIfExists('firms');
    }
}
