<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authorise
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
        $currentUser = Auth::user();
        $requestProfile = $request->route('profile');

        if ($currentUser->id !== $requestProfile->user_id) {
            // the requested profile does not belong to this user
            $msg = 'You do not have permission to view the profile requested';
            return redirect(route('home', compact('msg')));
        }

        return $next($request);
    }
}
