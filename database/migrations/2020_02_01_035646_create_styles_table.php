<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
        });

        DB::table('styles')->insert(['id'=>1,'name' => 'Language']);
        DB::table('styles')->insert(['id'=>2,'name' => 'Color']);
        DB::table('styles')->insert(['id'=>3,'name' => 'Font']);
        DB::table('styles')->insert(['id'=>4,'name' => 'Shape']);
        DB::table('styles')->insert(['id'=>5,'name' => 'Type']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styles');
    }
}
