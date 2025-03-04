<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MailList extends Model
{
    protected $fillable = ['email', 'email_is_verified', 'verification_token'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($subscriber) {
            $subscriber->verification_token = Str::random(40); // Generate a secure 40-character token
        });
    }
}
