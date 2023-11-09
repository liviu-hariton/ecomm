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
        Schema::create('stripe_settings', function (Blueprint $table) {
            $table->id();

            $table->string('client_id');
            $table->string('secret_key');
            $table->boolean('status');
            $table->string('mode');
            $table->string('country')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('currency_rate')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_settings');
    }
};
