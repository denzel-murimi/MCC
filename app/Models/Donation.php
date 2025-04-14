<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected  $fillable = [
        'type',
        'phone',
        'amount',
        'currency',
        'reference',
        'description',
        'MerchantRequestID',
        'CheckoutRequestID',
        'status',
        'ReceiptNumber',
        'TransactionDate',
    ];
}
