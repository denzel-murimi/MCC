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
        $request->headers->remove('X-Powered-By');
        $request->headers->remove('Server');
        $request->headers->remove('X-Laravel-Version');
        $request->headers->remove('X-Laravel-Id');
        $request->headers->remove('X-Laravel-Session');
        $request->headers->remove('X-Backend');
        return $next($request);
    }
}
