<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_order')->unsigned();
            $table->foreign('id_order')->references('id')->on('orders');
            $table->integer('id_product')->nullable();
            $table->foreign('id_product')->references('id')->on('products');
            $table->integer('id_personalized_pr')->nullable();
            $table->foreign('id_personalized_pr')->references('id')->on('personalized');
            $table->integer('quantity');
            $table->float('order_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
