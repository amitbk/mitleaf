<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firm_id')->unsigned();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            $table->integer('asset_type_id')->unsigned()->nullable();
            $table->foreign('asset_type_id')->references('id')->on('asset_types')->onDelete('cascade');

            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        DB::table('assets')->insert(['id'=>1,'firm_id' => 1, 'asset_type_id'=> 3, 'image_id'=>11 ]);
        DB::table('assets')->insert(['id'=>2,'firm_id' => 2, 'asset_type_id'=> 3, 'image_id'=>11 ]);
        DB::table('assets')->insert(['id'=>3,'firm_id' => 1, 'asset_type_id'=> 4, 'image_id'=>11 ]);
        DB::table('assets')->insert(['id'=>4,'firm_id' => 2, 'asset_type_id'=> 4, 'image_id'=>11 ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
