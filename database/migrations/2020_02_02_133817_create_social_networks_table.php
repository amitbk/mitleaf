<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_networks', function (Blueprint $table) {
            $table->bigIncrements('id');
            // user
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // firm
            $table->integer('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            // order
            $table->integer('social_network_type_id')->unsigned();
            $table->foreign('social_network_type_id')->references('id')->on('social_network_types')->onDelete('cascade');

            // details from social site
            $table->string('social_profile_id')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('expire_by')->nullable();

            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();

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
        Schema::dropIfExists('social_networks');
    }
}
