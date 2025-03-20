<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    protected $fillable = [
        'child_id', 'name', 'email', 'phone', 'contribution_type', 'amount', 'payment_method'
    ];
    
}
