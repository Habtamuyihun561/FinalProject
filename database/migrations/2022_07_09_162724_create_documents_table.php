<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->string('product_name')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_measure')->nullable();
            $table->integer('product_amount')->nullable();
            $table->integer('product_price')->nullable();
            // $table->integer('auction_id')->nullable();
            // $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            // $table->unsignedBigInteger('auction_id')->nullable();
            // $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('SET NULL');
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
        Schema::dropIfExists('documents');
    }
}
