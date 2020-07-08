<?php

namespace App\Http\Middleware;

use Closure;

class CreateUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // create user profile immediately after user is created
        var_dump($response);

        return $response;
    }
}
