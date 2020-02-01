<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('desc')->nullable();
        });

        DB::table('tag_types')->insert(['id'=>1,'name' => 'Item', 'desc' => 'Frame: This can be used to create a frames']);
        DB::table('tag_types')->insert(['id'=>2,'name' => 'Service', 'desc' => 'Might be social posting service']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_types');
    }
}
