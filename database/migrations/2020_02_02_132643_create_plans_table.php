<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->double('rate')->default(0);

            $table->boolean('is_slab_in_months')->default(true);
            $table->boolean('is_post_plan')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('plans')->insert(['id'=>1,'name' => 'Social Media Sharing', 'is_slab_in_months'=> 0, 'is_post_plan'=> false, 'rate' => '199']);
        DB::table('plans')->insert(['id'=>2,'name' => 'Daily Thoughts', 'desc'=> 'We will create Inspirational images, Daily thougths images for you with your business name', 'rate' => '640']);
        DB::table('plans')->insert(['id'=>3,'name' => 'Indian Events', 'is_slab_in_months'=> 0, 'desc'=> 'We will create special images for you on each event or festival of India.
                                                        Like Republican day, Diwali, Independence day, Workers Day or birthday of some well known person.', 'rate' => '220']);
        DB::table('plans')->insert(['id'=>4,'name' => 'Smart Business Kit', 'desc'=> 'If are running a busines, we will create speciafic images for your business.
                                                    Eg. For Hospitals, we will create health related images,
                                                    <br> For Hotels, we will create eating habbits related images']);
        // DB::table('plans')->insert(['id'=>1,'name' => 'Daily Thoughts', 'desc'=> '', 'rate' => '640']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
