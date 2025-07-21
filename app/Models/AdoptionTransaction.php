<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdoptionTransaction extends Model
{
    protected $fillable = [
        'adoption_id',
        'type',
        'reference',
        'amount',
        'currency',
        'status',
        'metadata',
        'gateway_response',
        'paid_at',
        'fees',
        'channel',
        'ip_address',
        'invoice_code',
        'subscription_code',
        'authorization_code',
        'transaction_id',
        'gateway_message',
        'period_start',
        'period_end'
    ];

    protected $casts = [
        'metadata' => 'array',
        'paid_at' => 'datetime',
        'period_start' => 'datetime',
        'period_end' => 'datetime',
        'amount' => 'decimal:2',
        'fees' => 'decimal:2',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_ABANDONED = 'abandoned';
    const STATUS_CANCELLED = 'cancelled';

    // Transaction types
    const TYPE_INITIAL = 'initial';
    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_ONE_TIME = 'one-time';

    public function adoption()
    {
        return $this->belongsTo(Adoption::class);
    }

    public function isSuccessful()
    {
        return $this->status === self::STATUS_SUCCESS;
    }

    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
}
