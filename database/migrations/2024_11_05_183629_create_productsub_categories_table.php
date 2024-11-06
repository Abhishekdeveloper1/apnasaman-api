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
        Schema::create('productsub_categories', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedBigInteger('category_id'); // Foreign key to product_categories
            // $table->string('name');
            // $table->text('description')->nullable();
            // $table->boolean('status')->default(0);
            // $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->id();
            // $table->unsignedBigInteger('category_id'); // Foreign key to product_categories
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            // Foreign key constraint
            // $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productsub_categories');
    }
};
