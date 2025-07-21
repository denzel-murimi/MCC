<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Request;

class MultiFactorThrottle extends ThrottleRequests
{
    /**
     * Resolve request signature for throttling.
     * Combines user ID (if authenticated), device ID (from cookie/header), and IP address.
     */
    protected function resolveRequestSignature($request): string
    {
        // Get user ID if authenticated, else 'guest'
        $userId = $request->user()?->id ?? 'guest';
        // Try to get device ID from cookie or header, else fallback
        $deviceId = $request->cookie('device_id') ?? $request->header('X-Device-Id') ?? 'no-device';
        // Get IP address
        $ip = $request->ip();

        // Combine all for a unique signature
        return sha1($userId . '|' . $deviceId . '|' . $ip);
    }
}
