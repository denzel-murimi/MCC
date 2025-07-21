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
        Schema::table('adoption_transactions', function (Blueprint $table) {
            $table->string('gateway_response')->nullable();
            $table->datetime('paid_at')->nullable();
            $table->decimal('fees', 10, 2)->default(0);
            $table->string('channel')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('invoice_code')->nullable();
            $table->string('subscription_code')->nullable();
            $table->string('authorization_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('gateway_message')->nullable();
            $table->datetime('period_start')->nullable();
            $table->datetime('period_end')->nullable();

            $table->index(['reference']);
            $table->index(['status']);
            $table->index(['subscription_code']);
            $table->index(['adoption_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adoption_transactions', function (Blueprint $table) {
            $table->dropForeign(['adoption_id']);

            $table->dropIndex(['reference']);
            $table->dropIndex(['status']);
            $table->dropIndex(['subscription_code']);
            $table->dropIndex(['adoption_id', 'status']);

            // Drop columns
            $table->dropColumn([
                'gateway_response',
                'paid_at',
                'fees',
                'channel',
                'ip_address',
                'metadata',
                'invoice_code',
                'subscription_code',
                'authorization_code',
                'transaction_id',
                'gateway_message',
                'period_start',
                'period_end'
            ]);
        });
    }
};
