<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("stock");
            $table->decimal("salePrice", 10, 2);
            $table->decimal("costPrice", 10, 2);
            $table->integer("saleCount");
            $table->decimal("rating", 10, 2)->max(5)->default(0);
            $table->string("new");

            $table->bigInteger('colorId')->unsigned();
            $table->foreign('colorId')->references('id')->on('colors')->onDelete('cascade'); // foreign key constraint
            $table->bigInteger('sizeId')->unsigned();
            $table->foreign('sizeId')->references('id')->on('sizes')->onDelete('cascade');// foreign key constraint
            $table->bigInteger('discountId')->unsigned();
            $table->foreign('discountId')->references('id')->on('discounts')->onDelete('cascade');// foreign key constraint
            $table->bigInteger('productId')->unsigned();
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');// foreign key constraint
            $table->string("status", 10)->default('Active');
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
        Schema::dropIfExists('product_variants');
    }
}
