<?php

namespace App\Http\Middleware;

use App\Models\Video;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Limit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $request->video->limit_id === 1 || $request->video->limit_id === 3  ? $next($request) : redirect()->back();
    }
}
