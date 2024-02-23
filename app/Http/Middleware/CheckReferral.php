<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckReferral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function handle2($request, Closure $next)
    {
        if( !$request->hasCookie('referral') && $request->query('ref') ) {
            return redirect($request->url())->withCookie(cookie()->forever('referral', $request->query('ref')));
        }

        return $next($request);
    }
}
