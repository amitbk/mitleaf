<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('desc')->nullable();
        });
        DB::table('asset_types')->insert(['id'=>1,'name' => 'PNG Logo']);
        DB::table('asset_types')->insert(['id'=>2,'name' => 'PNG Logo with Tagline']);
        DB::table('asset_types')->insert(['id'=>3,'name' => 'Watermark']);
        DB::table('asset_types')->insert(['id'=>4,'name' => 'Bottom Strip']);
        DB::table('asset_types')->insert(['id'=>5,'name' => 'Business Details Image']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_types');
    }
}
