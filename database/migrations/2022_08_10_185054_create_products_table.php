<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();           
            // $table->foreignId('categoryId')->constrained()->onDelete('cascade');            
            $table->string("name");
            $table->string("description");
            $table->string("sku")->nullable();
            $table->string("image")->nullable();
            $table->string("brand");
            $table->string("tags");
            $table->string("colors")->nullable();
            $table->string("sizes")->nullable();
            $table->decimal("rating", 10, 2)->max(5)->default(0);
            $table->string("new", 10)->default('No');
            // foreignKey
            $table->bigInteger('categoryId')->unsigned();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('discountId')->unsigned()->nullable();
            $table->foreign('discountId')->references('id')->on('discounts')->onDelete('cascade');// foreign key constraint
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
        Schema::dropIfExists('products');
    }
}
