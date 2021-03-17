<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firm_plans', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('firm_id')->unsigned()->index();
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            $table->unsignedBigInteger('plan_id')->unsigned()->index();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

            $table->unsignedBigInteger('order_plan_id')->unsigned()->index();
            $table->foreign('order_plan_id')->references('id')->on('order_plans')->onDelete('cascade');

            $table->integer('qty_per_month')->default(0);

            $table->unsignedBigInteger('firm_type_id')->nullable();
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->timestamp('date_post_created_upto')->nullable()->default(null);
            $table->timestamp('date_start_from')->nullable()->default(null);
            $table->timestamp('date_scheduled_upto')->nullable()->default(null);
            $table->timestamp('date_expiry')->nullable();
            $table->boolean('is_post_plan')->default(true);
            $table->boolean('is_trial')->default(false);

            // which asset to use while creating posts: ref in asset_types table
            $table->integer('st_use_asset_type')->nullable()->default(1);
            // settings for post
            $table->string('st_language')->nullable();
            $table->string('st_shape')->nullable();
            $table->string('st_shade_type')->nullable();
            $table->string('st_color')->nullable();
            $table->string('st_logo')->nullable();
            $table->string('st_strip')->nullable();
            $table->string('st_watermark')->nullable();

            $table->timestamps();
        });


        $expiry = '2030-12-31 23:59:59';
        DB::table('orders')->insert(['id'=>1,'user_id' => 51, 'firm_id'=> 1, 'amount' => 0, 'is_trial' => 0, 'date_start_from' => date('Y-m-d H:i:s'), 'date_expiry' => $expiry, 'status' => 1  ]);
        DB::table('order_plans')->insert(['id'=>1,'order_id' => 1, 'plan_id'=> 1, 'qty' => 1, 'rate' => 0 ]);
        DB::table('order_plans')->insert(['id'=>2,'order_id' => 1, 'plan_id'=> 2, 'qty' => 10, 'rate' => 0 ]);
        DB::table('order_plans')->insert(['id'=>3,'order_id' => 1, 'plan_id'=> 3, 'qty' => 1, 'rate' => 0 ]);
        DB::table('order_plans')->insert(['id'=>4,'order_id' => 1, 'plan_id'=> 4, 'qty' => 10, 'rate' => 0 ]);


        DB::table('firm_plans')->insert(['id'=>1,'firm_id' => 1, 'plan_id'=> 1, 'order_plan_id' => 1, 'qty_per_month' => 1, 'date_start_from' => date('Y-m-d H:i:s'), 'date_expiry' => $expiry, 'is_post_plan' => 0, 'st_use_asset_type' => 1,  ]);
        DB::table('firm_plans')->insert(['id'=>2,'firm_id' => 1, 'plan_id'=> 2, 'order_plan_id' => 2, 'qty_per_month' => 10, 'date_start_from' => date('Y-m-d H:i:s'), 'date_expiry' => $expiry, 'is_post_plan' => 1, 'st_use_asset_type' => 1,  ]);
        DB::table('firm_plans')->insert(['id'=>3,'firm_id' => 1, 'plan_id'=> 3, 'order_plan_id' => 3, 'qty_per_month' => 1, 'date_start_from' => date('Y-m-d H:i:s'), 'date_expiry' => $expiry, 'is_post_plan' => 1, 'st_use_asset_type' => 1,  ]);
        DB::table('firm_plans')->insert(['id'=>4,'firm_id' => 1, 'plan_id'=> 4, 'order_plan_id' => 4, 'qty_per_month' => 10, 'date_start_from' => date('Y-m-d H:i:s'), 'date_expiry' => $expiry, 'is_post_plan' => 1, 'st_use_asset_type' => 1,  ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firm_plans');
    }
}
