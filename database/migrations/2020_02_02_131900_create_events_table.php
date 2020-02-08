<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->timestamp('date')->nullable();
        });

        DB::table('events')->insert(['id'=>1,'name' => '10 Feb', 'date'=> date("Y-m-d H:i:s",strtotime('02/10/2020')) , 'desc' => 'event']);
        DB::table('events')->insert(['id'=>2,'name' => '15 Feb', 'date'=> date("Y-m-d H:i:s",strtotime('02/15/2020')) , 'desc' => 'event']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
