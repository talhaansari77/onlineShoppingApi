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
            $table->bigInteger('categoryId')->unsigned();
            $table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');
            $table->string("name");
            $table->string("description");
            $table->string("sku");
            $table->string("image")->nullable();
            $table->string("brand");
            $table->string("tags");
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
