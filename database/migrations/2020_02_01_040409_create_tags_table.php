<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
            $table->double('rate')->default(0);
            $table->double('year_discount')->default(0);

            // parent tag id
            $table->integer('tag_id')->nullable()->default(null);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // to create image or facebook pack
            $table->integer('tag_type_id')->nullable();
            $table->foreign('tag_type_id')->references('id')->on('tag_types')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('tags')->insert(['id'=>1,'name' => 'Services', 'tag_type_id' => 2, 'desc' => '']);
          DB::table('tags')->insert(['id'=>2,'name' => 'Social Posting', 'tag_id' => 1, 'tag_type_id' => 2, 'desc' => 'Monthly Plan' , 'rate' => '200']);

        DB::table('tags')->insert(['id'=>3,'name' => 'Business', 'tag_type_id' => 1, 'desc' => '']);
          DB::table('tags')->insert(['id'=>4,'name' => 'School', 'tag_id' => 3, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>5,'name' => 'Cloths Stores', 'tag_id' => 3, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>6,'name' => 'Hotels', 'tag_id' => 3, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>7,'name' => 'Super Market', 'tag_id' => 3, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>8,'name' => 'Speaker/Public figure', 'tag_id' => 3, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);

        DB::table('tags')->insert(['id'=>9,'name' => 'Lifestyle', 'desc' => '', 'tag_type_id' => 1]);
          DB::table('tags')->insert(['id'=>10,'name' => 'Inspirational', 'tag_id' => 9, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>11,'name' => 'Business Quotes', 'tag_id' => 9, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);

        DB::table('tags')->insert(['id'=>12,'name' => 'Events 2020', 'desc' => '', 'tag_type_id' => 1]);
          DB::table('tags')->insert(['id'=>13,'name' => 'New Year', 'tag_id' => 12, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>14,'name' => 'Makar Sankrant', 'tag_id' => 12, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>15,'name' => 'Valentines Day', 'tag_id' => 12, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);
          DB::table('tags')->insert(['id'=>16,'name' => 'Kamgar Day', 'tag_id' => 12, 'desc' => '', 'tag_type_id' => 1, 'rate' => '30']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
