<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveFrameworkHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $request;
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->remove('X-Laravel-Version');
        $response->headers->remove('X-Laravel-Id');
        $response->headers->remove('X-Laravel-Session');
        $response->headers->remove('X-Backend');
        return $next($response);
    }
}
