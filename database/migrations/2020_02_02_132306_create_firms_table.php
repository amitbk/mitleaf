<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->text('about')->nullable();

            $table->text('address')->nullable();
            $table->string('taluka')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('pin')->nullable();
            $table->string('gstin')->nullable();
            $table->unsignedBigInteger('logo_id')->nullable();
            $table->foreign('logo_id')->references('id')->on('images')->onDelete('set null');

            $table->unsignedBigInteger('firm_type_id')->nullable();
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->timestamps();
        });

        DB::table('firms')->insert(['id'=>1,'name' => 'Master Firm', 'tagline'=> 'A Social Media Bot', 'address' => 'Pune', 'firm_type_id' => config('amit.firm_not_mentioned_id') ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firms');
    }
}
