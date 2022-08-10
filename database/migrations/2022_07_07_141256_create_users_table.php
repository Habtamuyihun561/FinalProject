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
            // 'name', 'email', 'user_name', 'password', 'gender', 
            // 'photo', 'phone ','company_name','tin_num','role'
            $table->id();
            $table->String('name');
            $table->String('email')->unique()->nullable();
            $table->String('user_name');
            $table->string('password')->nullable();
            $table->String('gender');
            // $table->String('photo')->nullable();
            $table->integer('phone')->unique()->nullable();
            $table->String('company_name')->unique();
            $table->String('tin_number')->unique();
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('role', ['user','admin'])->default('user');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
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