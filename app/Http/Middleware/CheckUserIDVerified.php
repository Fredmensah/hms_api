<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserIDVerified
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
        if (Auth::guard('api')->check()) {
            $user = Auth::user();

            if (!$user->idVerified){
                return response()->json([
                    'error' => 'Your account has not been validated to take this action. Please add a credited national identification card'
                ], 401);
            }
        }

        return $next($request);
    }
}
