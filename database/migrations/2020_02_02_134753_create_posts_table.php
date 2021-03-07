<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Query\Expression;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('firm_id');
            $table->foreign('firm_id')->references('id')->on('firms')->onDelete('cascade');

            $table->unsignedBigInteger('firm_plan_id')->nullable();
            $table->foreign('firm_plan_id')->references('id')->on('firm_plans')->onDelete('set null');

            $table->timestamp('schedule_on')->nullable();
            $table->integer('recreated')->default(0);

            $table->timestamp('is_posted_on_social_media')->nullable();
            $table->boolean('is_finalized')->default(false)->nullable();

            $table->text('title')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);

            $table->unsignedBigInteger('event_id')->nullable()->default(null);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->unsignedBigInteger('image_id')->nullable()->default(null);
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');

            $table->unsignedBigInteger('template_id')->nullable()->default(null);
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('set null');
            $table->integer('error_count')->default(0);
            $table->text('error')->nullable()->default(null);

            $table->json('post_link')->default(new Expression('(JSON_ARRAY())'));


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
