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
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
        });

        DB::table('styles')->insert(['id'=>6,'slug'=> '', 'name' => 'Both Shades', 'type' => 'shade']);
        DB::table('styles')->insert(['id'=>7,'slug'=> '', 'name' => 'Light Shade', 'type' => 'shade']);
        DB::table('styles')->insert(['id'=>8,'slug'=> '', 'name' => 'Dark Shade', 'type' => 'shade']);

        DB::table('styles')->insert(['id'=>11,'slug'=> 'bottom', 'name' => 'Bottom Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>12,'slug'=> 'bottom-left', 'name' => 'Bottom Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>13,'slug'=> 'bottom-right', 'name' => 'Bottom Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>14,'slug'=> 'top', 'name' => 'Top Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>15,'slug'=> 'top-left', 'name' => 'Top Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>16,'slug'=> 'top-right', 'name' => 'Top Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>17,'slug'=> 'center', 'name' => 'Center-Center', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>18,'slug'=> 'left', 'name' => 'Center Left', 'type' => 'logo_support']);
        DB::table('styles')->insert(['id'=>19,'slug'=> 'right', 'name' => 'Center Right', 'type' => 'logo_support']);

        DB::table('styles')->insert(['id'=>21,'slug'=> 'bottom', 'name' => 'Bottom Touch', 'type' => 'strip_support']);
        DB::table('styles')->insert(['id'=>22,'slug'=> 'bottom', 'name' => 'Bottom With Padding', 'type' => 'strip_support']);
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
