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
            $table->string('network');
            $table->string('provider');
            $table->string('type');
            $table->string('desc')->nullable();
        });
        DB::table('social_network_types')->insert(['id'=>1,'network' => 'Facebook', 'provider' => 'facebook', 'type' => 'profile']);
        DB::table('social_network_types')->insert(['id'=>2,'network' => 'Facebook', 'provider' => 'facebook', 'type' => 'page']);
        DB::table('social_network_types')->insert(['id'=>3,'network' => 'Facebook', 'provider' => 'facebook', 'type' => 'group']);

        // DB::table('social_network_types')->insert(['id'=>2, 'network' => 'Twitter', 'provider' => 'twitter', 'type' => 'profile']);
        // DB::table('social_network_types')->insert(['id'=>3, 'network' => 'LinkedIn', 'provider' => '', 'type' => '']);
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
