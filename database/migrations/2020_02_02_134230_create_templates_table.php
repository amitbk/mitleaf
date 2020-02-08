<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            // template created by
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->integer('image_id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');

            $table->integer('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');

            $table->integer('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');

            $table->integer('firm_type_id')->nullable();
            $table->foreign('firm_type_id')->references('id')->on('firm_types')->onDelete('set null');

            $table->text('data')->nullable();

            $table->bigInteger('used_count')->default(0);
            $table->boolean('can_add_watermark')->default(true);

            // styles
            $table->string('language')->nullable();
            $table->string('shape')->nullable();
            $table->string('color')->nullable();
            $table->string('logo_support')->nullable();
            $table->string('strip_support')->nullable();
            $table->string('watermark_support')->nullable();

            $table->timestamps();
        });

        DB::table('templates')->insert(['id'=>1,'image_id' => '1', 'plan_id'=> '2' ]);
        DB::table('templates')->insert(['id'=>2,'image_id' => '2', 'plan_id'=> '2' ]);
        DB::table('templates')->insert(['id'=>3,'image_id' => '3', 'plan_id'=> '2' ]);
        DB::table('templates')->insert(['id'=>4,'image_id' => '4', 'plan_id'=> '3', 'event_id' => 1 ]);
        DB::table('templates')->insert(['id'=>5,'image_id' => '5', 'plan_id'=> '3', 'event_id' => 2 ]);
        DB::table('templates')->insert(['id'=>6,'image_id' => '6', 'plan_id'=> '3', 'event_id' => 1 ]);
        DB::table('templates')->insert(['id'=>7,'image_id' => '7', 'plan_id'=> '4', 'firm_type_id' => 1 ]);
        DB::table('templates')->insert(['id'=>8,'image_id' => '8', 'plan_id'=> '4', 'firm_type_id' => 2 ]);
        DB::table('templates')->insert(['id'=>9,'image_id' => '9', 'plan_id'=> '4', 'firm_type_id' => 1 ]);
        DB::table('templates')->insert(['id'=>10,'image_id' => '10', 'plan_id'=> '2' ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
