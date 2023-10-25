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
        Schema::create('product_image_galleries', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')->index('product_id');
            $table->integer('vendor_id')->index('vendor_id');
            $table->text('image');
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_image_galleries');
    }
};
