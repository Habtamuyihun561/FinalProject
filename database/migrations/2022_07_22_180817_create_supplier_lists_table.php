<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('bussiness_type')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('tin_number')->nullable()->unique();
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
        Schema::dropIfExists('supplier_lists');
    }
}
