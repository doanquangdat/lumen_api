<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateInitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('username');
            $table->string('name');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('auth_token')->nullable();
            $table->string('extra_token')->nullable();
            $table->tinyInteger('group')->default(1);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('gender')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'email' => 'doanquangdathd94@gmail.com',
            'username' => 'datdq',
            'name' => 'Đoàn Quang Đạt',
            'password' => Hash::make('12345678')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('init_');
    }
}
