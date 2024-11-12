<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsubCategoriesAddCascade extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('productsub_categories', function (Blueprint $table) {
            // Check if the category_id column exists
            if (!Schema::hasColumn('productsub_categories', 'category_id')) {
                // Add the category_id column if it does not exist
                $table->unsignedBigInteger('category_id')->nullable();
            }

            // Add the foreign key constraint with onDelete('cascade')
            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productsub_categories', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            if (Schema::hasColumn('productsub_categories', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
}

