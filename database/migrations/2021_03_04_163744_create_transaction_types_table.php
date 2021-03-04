<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();

            $table->timestamps();
        });

        DB::table('transaction_types')->insert(['id'=>1,'name' => 'Sale' ]);
        DB::table('transaction_types')->insert(['id'=>2,'name' => 'Purchase' ]);

        DB::table('transaction_types')->insert(['id'=>3,'name' => 'Service/Product' ]);
        DB::table('transaction_types')->insert(['id'=>4,'name' => 'Commission' ]);
        DB::table('transaction_types')->insert(['id'=>5,'name' => 'Bank Transfer' ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
}
