<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected  $fillable = [
        'type',
        'phone',
        'amount',
        'reference',
        'description',
        'MerchantRequestID',
        'CheckoutRequestID',
        'status',
        'MpesaReceiptNumber',
        'TransactionDate',
    ];
}
