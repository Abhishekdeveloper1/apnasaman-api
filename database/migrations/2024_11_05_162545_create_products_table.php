<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('sku')->unique();
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key to product_categories
            $table->unsignedBigInteger('subcategory_id')->nullable(); // Foreign key to product_subcategories
            $table->unsignedBigInteger('inventory_id')->nullable(); // Foreign key to product_inventories
            $table->integer('discount_id')->nullable();  
            $table->bigInteger('price');  
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('productsub_categories')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('product_inventories')->onDelete('set null');
      
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
