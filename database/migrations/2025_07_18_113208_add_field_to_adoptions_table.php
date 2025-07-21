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
        Schema::table('adoptions', function (Blueprint $table) {
            $table->string('frequency')->nullable();
            $table->integer('duration')->nullable(); // number of billing cycles
            $table->string('reference')->unique();
            $table->string('plan_code')->nullable();
            $table->string('subscription_code')->nullable();
            $table->string('authorization_code')->nullable();
            $table->enum('status', ['requested', 'active', 'completed', 'cancelled', 'failed', 'attention'])->default('requested');
            $table->json('metadata')->nullable();
            $table->datetime('next_payment_date')->nullable();
            $table->integer('total_payments_made')->default(0);
            $table->decimal('total_amount_paid', 10, 2)->default(0);

            $table->index(['email', 'status']);
            $table->index(['subscription_code']);
            $table->index(['plan_code']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['email', 'status']);
            $table->dropIndex(['subscription_code']);
            $table->dropIndex(['plan_code']);
            $table->dropIndex(['status']);

            // Drop columns
            $table->dropColumn([
                'frequency',
                'duration',
                'reference',
                'plan_code',
                'subscription_code',
                'authorization_code',
                'status',
                'metadata',
                'next_payment_date',
                'total_payments_made',
                'total_amount_paid'
            ]);
        });
    }
};
