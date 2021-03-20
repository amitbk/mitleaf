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
            $table->string('title');
            $table->text('desc')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamp('date')->nullable();
            $table->timestamps();
        });

        DB::table('events')->insert(['id'=>1,'title' => '10 Feb', 'date'=> date("Y-m-d H:i:s",strtotime('02/10/2021')) , 'desc' => '']);
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
