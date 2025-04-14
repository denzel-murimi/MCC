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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('phone')->nullable();
            $table->decimal('amount',8,2);
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->string('MerchantRequestID')->nullable()->unique();
            $table->string('CheckoutRequestID')->nullable()->unique();
            $table->string('status');
            $table->string('ReceiptNumber')->nullable();
            $table->string('TransactionDate')->nullable();
            $table->string('ResultDesc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
