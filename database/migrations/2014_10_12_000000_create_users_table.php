<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id')->nullable()->default(0);
            // ROLES=
                // 0=User
                // 1=Amit
                // 2=Other admins
                // 3=can upload templates

            $table->boolean('is_trial_used')->default(false);

            // restricted user
            $table->boolean('is_revoked')->default(false);
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('email')->unique();
            $table->integer('avatar_id')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->timestamp('born_at')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(['id'=>1,'name' => 'Amit Kadam', 'mobile' => '9552015542', 'role_id' => 1, 'email'=> 'amit.bk03@gmail.com', 'password' => bcrypt('9552015542')]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
