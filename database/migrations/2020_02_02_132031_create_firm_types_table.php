<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->boolean('is_active')->default(true);
            $table->double('rate')->default(0);
            $table->timestamps();
        });
        DB::table('firm_types')->insert(['id'=>1,'name' => 'Hospital', 'rate'=> '60']);
        DB::table('firm_types')->insert(['id'=>2,'name' => 'Hotel', 'rate'=> '30']);
        DB::table('firm_types')->insert(['id'=>3,'name' => 'Garment Shop', 'rate'=> '30']);
        DB::table('firm_types')->insert(['id'=>4,'name' => 'Not mentioned', 'rate'=> '0']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firm_types');
    }
}
