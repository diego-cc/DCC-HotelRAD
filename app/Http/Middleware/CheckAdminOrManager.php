<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrManager
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
        // check whether authenticated user is admin or manager
        $user = Auth::user();

        if (isset($user)) {
            if (
                $user->user_type_id === \App\UserType::whereRaw('lower(type) LIKE ?', ['%administrator%'])->value('id') ||
                $user->user_type_id === \App\UserType::whereRaw('lower(type) LIKE ?', ['%manager%'])->value('id')
            ) {
                return $next($request);
            }
        }

        return redirect('login');
    }
}
