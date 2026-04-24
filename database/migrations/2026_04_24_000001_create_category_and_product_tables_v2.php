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
        // Drop existing tables to avoid conflicts
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('products');

        // Create category table as per image
        Schema::create('category', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name')->unique(); // Unique category name
            $table->timestamps(); // Created at and Updated at
        });

        // Create product table as per image
        Schema::create('product', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Product name
            $table->string('quantity'); // Quantity as string (as requested in image)
            $table->decimal('price', 10, 2); // Price with 10 digits total and 2 decimals
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // FK to users table
            $table->foreignId('category_id')->constrained('category')->cascadeOnDelete(); // FK to category table
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
        Schema::dropIfExists('category');
    }
};
