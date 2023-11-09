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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id')->index();
            $table->integer('product_id')->index();
            $table->integer('vendor_id')->index();
            $table->string('product_name');
            $table->text('variant')->nullable();
            $table->integer('variant_total')->nullable();
            $table->decimal('unit_price');
            $table->integer('qty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
