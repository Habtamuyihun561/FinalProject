<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitedDocuementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submited_docuements', function (Blueprint $table) {
            $table->id();
            $table->float('total_price')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('cascade');
            // $table->unsignedBigInteger('document_id')->nullable();
            // $table->foreign('document_id')->references('id')->on('documents')->onDelete('SET NULL')->onUpdate('cascade');
            $table->unsignedBigInteger('auction_id')->nullable();
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
        Schema::dropIfExists('submited_docuements');
    }
}
