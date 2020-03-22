<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('url');
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
          $table->foreign('avatar_id')->references('id')->on('images')->onDelete('set null');
        });

        DB::table('images')->insert(['id'=>1,'name' => 't1', 'url'=> 'images/templates/t1.jpg' ]);
        DB::table('images')->insert(['id'=>2,'name' => 't2', 'url'=> 'images/templates/t2.jpg' ]);
        DB::table('images')->insert(['id'=>3,'name' => 't3', 'url'=> 'images/templates/t3.jpg' ]);
        DB::table('images')->insert(['id'=>4,'name' => 't4', 'url'=> 'images/templates/t4.jpg' ]);
        DB::table('images')->insert(['id'=>5,'name' => 't5', 'url'=> 'images/templates/t5.jpg' ]);
        DB::table('images')->insert(['id'=>6,'name' => 't6', 'url'=> 'images/templates/t6.jpg' ]);
        DB::table('images')->insert(['id'=>7,'name' => 't7', 'url'=> 'images/templates/t7.jpg' ]);
        DB::table('images')->insert(['id'=>8,'name' => 't8', 'url'=> 'images/templates/t8.jpg' ]);
        DB::table('images')->insert(['id'=>9,'name' => 't9', 'url'=> 'images/templates/t9.jpg' ]);
        DB::table('images')->insert(['id'=>10,'name' => 't10', 'url'=> 'images/templates/t10.jpg' ]);
        DB::table('images')->insert(['id'=>11,'name' => 'a10', 'url'=> 'images/assets/icode.png' ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
        Schema::table('users', function (Blueprint $table) {
          $table->dropForeign(['avatar_id']);
        });
    }
}
