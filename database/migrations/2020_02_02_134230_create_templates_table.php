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
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_verified')->default(0);
            $table->string('name')->nullable();
            $table->text('desc')->nullable();

            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');

            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');

            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');

            $table->bigInteger('used_count')->default(0);

            // STYLES ::

            $table->string('language')->nullable();
            // language=> 0=No language,m=Marathi,e=English,h=Hindi

            $table->string('shape')->nullable();
            // shape=> 1=Square, 2=Portrate, 3=Landscape

            $table->string('shade_type')->nullable();
            // style=> 6=Both, 7=Light, 8=Dark

            // color=> use color picker
            $table->string('color')->nullable();

            // $table->string('logo_support')->nullable();
            // logo support=>
                // 11 => bottom-center
                // 12 => bottom-left
                // 13 => bottom-right
                //
                // 14 => top-center
                // 15 => top-left
                // 16 => top-right
                //
                // 17 => center
                // 18 => center-left
                // 19 => center-right

            // $table->string('strip_support')->nullable();
            // strip support
                // 21 => bottom
                // 22 => bottom-with-padding

            // $table->string('watermark_support')->nullable();

            $table->timestamps();
        });

        // DB::table('templates')->insert(['id'=>1,'image_id' => '1', 'plan_id'=> '2' ]);
        // DB::table('templates')->insert(['id'=>2,'image_id' => '2', 'plan_id'=> '2' ]);
        // DB::table('templates')->insert(['id'=>3,'image_id' => '3', 'plan_id'=> '2' ]);
        // DB::table('templates')->insert(['id'=>4,'image_id' => '4', 'plan_id'=> '3', 'event_id' => 1 ]);
        // DB::table('templates')->insert(['id'=>5,'image_id' => '5', 'plan_id'=> '3', 'event_id' => 2 ]);
        // DB::table('templates')->insert(['id'=>6,'image_id' => '6', 'plan_id'=> '3', 'event_id' => 1 ]);
        // DB::table('templates')->insert(['id'=>7,'image_id' => '7', 'plan_id'=> '4', 'firm_type_id' => 1 ]);
        // DB::table('templates')->insert(['id'=>8,'image_id' => '8', 'plan_id'=> '4', 'firm_type_id' => 2 ]);
        // DB::table('templates')->insert(['id'=>9,'image_id' => '9', 'plan_id'=> '4', 'firm_type_id' => 1 ]);
        // DB::table('templates')->insert(['id'=>10,'image_id' => '10', 'plan_id'=> '2' ]);

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
