<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialNetworkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_network_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
        });

        DB::table('social_network_types')->insert(['id'=>1,'name' => 'Facebook']);
        DB::table('social_network_types')->insert(['id'=>2, 'name' => 'Twitter']);
        DB::table('social_network_types')->insert(['id'=>3, 'name' => 'LinkedIn']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_network_types');
    }
}
