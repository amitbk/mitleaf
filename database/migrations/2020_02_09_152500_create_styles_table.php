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
            $table->string('name')->nullable();
            $table->string('type')->nullable();
        });

        DB::table('styles')->insert(['id'=>6,'name' => 'Both Shades', 'type' => 'shade']);
        DB::table('styles')->insert(['id'=>7,'name' => 'Light Shade', 'type' => 'shade']);
        DB::table('styles')->insert(['id'=>8,'name' => 'Dark Shade', 'type' => 'shade']);

        DB::table('styles')->insert(['id'=>11,'name' => 'Bottom Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>12,'name' => 'Bottom Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>13,'name' => 'Bottom Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>14,'name' => 'Top Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>15,'name' => 'Top Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>16,'name' => 'Top Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>17,'name' => 'Center-Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>18,'name' => 'Center Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>19,'name' => 'Center Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>21,'name' => 'Bottom Touch', 'type' => 'strip_support']);
        DB::table('styles')->insert(['id'=>22,'name' => 'Bottom With Padding', 'type' => 'strip_support']);
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
