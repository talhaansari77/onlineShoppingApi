<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('productName');
            $table->string('color');
            $table->string('size');
            $table->integer('qty');
            $table->decimal("salePrice", 10, 2);
            $table->decimal("costPrice", 10, 2);
            // foreignKey
            $table->bigInteger('orderId')->unsigned();
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_details');
    }
}
