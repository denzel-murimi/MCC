<?php

namespace App\Models;

use App\HasHashId;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasHashId;

    protected $fillable = [
        'child_id',
        'name',
        'email',
        'phone',
        'contribution_type',
        'amount',
        'frequency',
        'duration',
        'payment_method',
        'reference',
        'plan_code',
        'subscription_code',
        'authorization_code',
        'status',
        'metadata',
        'next_payment_date',
        'total_payments_made',
        'total_amount_paid'
    ];

    protected $casts = [
        'metadata' => 'array',
        'next_payment_date' => 'datetime',
        'total_payments_made' => 'integer',
        'total_amount_paid' => 'decimal:2'
    ];

    const STATUS_REQUESTED = 'requested';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_FAILED = 'failed';
    const STATUS_ATTENTION = 'attention';

    const TYPE_ONE_TIME = 'one-time';
    const TYPE_RECURRING = 'recurring';

    public function transactions()
    {
        return $this->hasMany(AdoptionTransaction::class);
    }

    public function child(){
        return $this->belongsTo(Child::class);
    }

    public function isRecurring(): bool
    {
        return $this->contribution_type === self::TYPE_RECURRING;
    }

    public function isActive(): bool
    {
        return in_array($this->status, [self::STATUS_ACTIVE, self::STATUS_REQUESTED]);
    }


    public function needsAttention()
    {
        return $this->status === self::STATUS_ATTENTION;
    }

    public function getTotalAmountAttribute()
    {
        return $this->transactions()->where('status', 'success')->sum('amount');
    }

    public function getLastPaymentAttribute()
    {
        return $this->transactions()->where('status', 'success')->latest()->first();
    }

}
