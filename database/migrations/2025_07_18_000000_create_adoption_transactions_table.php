<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoption_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adoption_id')->constrained('adoptions')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('reference')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_transactions');
    }
};
