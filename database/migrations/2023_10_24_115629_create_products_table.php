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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('image')->nullable();
            $table->integer('vendor_id')->index('vendor');
            $table->integer('category_id')->index('category');
            $table->integer('brand_id')->index('brand');
            $table->integer('qty');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('video_link')->nullable();
            $table->string('sku')->unique();
            $table->decimal('price');
            $table->decimal('offer_price')->nullable();
            $table->dateTime('offer_start_date')->nullable();
            $table->dateTime('offer_end_date')->nullable();
            $table->boolean('is_top')->nullable();
            $table->boolean('is_best')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('status');
            $table->integer('approved')->default(0);

            $table->timestamps();
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
