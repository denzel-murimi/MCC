<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureDeviceIDCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if(!$request->hasCookie('cookie_identifier')){
            $deviceID = (string) Str::uuid();
            $response->cookie('cookie_identifier', $deviceID, 60 * 24 * 365 * 5);
        }
        return $response;
    }
}
