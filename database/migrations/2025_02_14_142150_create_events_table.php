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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('colour');
            $table->text('description');
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->enum('recurrence_type', ['none', 'daily', 'weekly', 'monthly', 'yearly'])
                ->default('none');
            $table->integer('recurrence_interval')->nullable();
            $table->json('recurrence_days')->nullable();
            $table->date('recurrence_end_date')->nullable();
            $table->string('monthly_recurrence_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
