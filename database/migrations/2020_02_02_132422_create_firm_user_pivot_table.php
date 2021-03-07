<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFirmUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('firm_id')->unsigned()->index();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->primary(['firm_id', 'user_id']);
            $table->integer('role')->nullable()->default(1);
            $table->timestamps();
        });

        DB::table('firm_user')->insert(['id'=>1,'firm_id' => 1, 'user_id'=> 1, 'role' => 1]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firm_user');
    }
}
