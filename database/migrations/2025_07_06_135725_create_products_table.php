<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_sku')->unique()->nullable(); 
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('brand')->nullable();
    
            $table->decimal('regular_price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
    
            $table->integer('stock_quantity')->default(0);
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
    
            $table->enum('product_type', ['simple', 'variable'])->default('simple');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
    
            $table->string('tags')->nullable();
            $table->boolean('featured')->default(false);
    
            $table->json('product_images')->nullable();
    
            $table->string('meta_title')->nullable();
            $table->string('keywords')->nullable();
            $table->text('meta_description')->nullable();
    
            // Shipping & Tax
            $table->string('shipping_class')->nullable();
            $table->enum('tax_status', ['taxable', 'non-taxable'])->default('taxable');
            $table->string('tax_class')->nullable();
    
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
