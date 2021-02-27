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

        DB::table('events')->insert(['id'=>1,'name' => '10 Feb', 'date'=> date("Y-m-d H:i:s",strtotime('02/10/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>2,'name' => '15 Feb', 'date'=> date("Y-m-d H:i:s",strtotime('02/15/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>3,'name' => '9 March - Holi', 'date'=> date("Y-m-d H:i:s",strtotime('03/09/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>4,'name' => '25 March - Gudhipadwa', 'date'=> date("Y-m-d H:i:s",strtotime('03/25/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>5,'name' => '25 April - Shivjayanti', 'date'=> date("Y-m-d H:i:s",strtotime('04/25/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>6,'name' => '14 Nov - Diwali', 'date'=> date("Y-m-d H:i:s",strtotime('11/14/2021')) , 'desc' => '']);
        DB::table('events')->insert(['id'=>7,'name' => '1 Sep - Pola', 'date'=> date("Y-m-d H:i:s",strtotime('09/01/2021')) , 'desc' => '']);

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
