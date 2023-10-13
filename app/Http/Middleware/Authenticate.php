<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //Back to login page

            if ($request->is('api/*')) {
                throw new HttpResponseException(
                    response()->json(
                        'Unauthorized', Response::HTTP_UNAUTHORIZED
                    )
                );
            }else{
                return route('admin.loginAdmin');
            }
        }
    }
}
