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
            $table->integer('account_type_id')->nullable()->default(1);

            $table->boolean('is_trial_used')->default(false);
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->foreign('referrer_id')->references('id')->on('users');

            // restricted user
            $table->boolean('is_revoked')->default(false);
            $table->string('name');
            $table->string('mobile')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('avatar_id')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->string('timezone')->nullable();

            $table->timestamp('born_at')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::table('users')->insert(['id'=>1, 'name' => config('app.name'), 'email'=> 'account1@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>1, 'name' => 'Sale Account', 'email'=> 'account1@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>2, 'name' => 'Purchase Account', 'email'=> 'account2@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>3, 'name' => 'Service', 'email'=> 'account3@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>4, 'name' => 'Commission Account', 'email'=> 'account4@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>5, 'name' => 'Bank Account', 'email'=> 'account5@flymit.com', 'account_type_id' => 2 ]);

        DB::table('users')->insert(['id'=>6, 'name' => 'GST', 'email'=> 'gst_account@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>7, 'name' => 'TDS', 'email'=> 'tds_account@flymit.com', 'account_type_id' => 2 ]);
        DB::table('users')->insert(['id'=>8, 'name' => 'Professional Tax', 'email'=> 'pt_account@flymit.com', 'account_type_id' => 2 ]);

        DB::table('users')->insert(['id'=>51, 'name' => 'Amit Kadam', 'mobile' => '9552015542', 'role_id' => 1, 'email'=> 'amit.bk03@gmail.com', 'password' => bcrypt('9552015542')]);
        DB::table('users')->insert(['id'=>52, 'name' => 'Prajakta Kadam', 'mobile' => '9021222610', 'role_id' => 1, 'email'=> 'prajaktakadam1308@gmail.com', 'password' => bcrypt('9552015542')]);

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
