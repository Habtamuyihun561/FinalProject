<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->String('code')->unique()->nullable();
            $table->String('title')->nullable();
            $table->String('category')->nullable();
            $table->longText('description')->nullable();
            $table->date('startDate')->nullable();
            // $table->time('openedTime')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->integer('min_price')->nullable();
            // $table->integer('min_collateral_price');
            $table->String('photo')->nullable();
            $table->String('type')->nullable();
            $table->String('status')->default('active');
            $table->string('purpose')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('auctions');
    }
}
