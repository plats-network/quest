<?php

namespace App\Http\Middleware;

use App\Models\ReferralLink;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreReferralCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->has('ref')){
            $referral = ReferralLink::whereCode($request->get('ref'))->first();
            $response->cookie('ref', $referral->id, $referral->lifetime_minutes);
        }

        return $response;
    }
}
