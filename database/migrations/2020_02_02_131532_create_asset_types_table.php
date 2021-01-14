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
            $table->string('name_display');
            $table->text('desc')->nullable();
        });
        DB::table('asset_types')->insert(['id'=>1,'name' => 'PNG Logo', 'name_display' => 'Logo' ]);
        DB::table('asset_types')->insert(['id'=>2,'name' => 'PNG Logo with Tagline', 'name_display' => 'Logo with tagline']);
        DB::table('asset_types')->insert(['id'=>3,'name' => 'Bottom Strip 1', 'name_display' => 'Strip']);
        DB::table('asset_types')->insert(['id'=>4,'name' => 'Bottom Strip 2', 'name_display' => 'Strip 2']);
        DB::table('asset_types')->insert(['id'=>5,'name' => 'Business Details Image', 'name_display' => 'Logo with Business details']);
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
