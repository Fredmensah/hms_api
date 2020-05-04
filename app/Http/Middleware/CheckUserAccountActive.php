<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserAccountActive
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

            switch ($user->status){
                case 'inactive';
                    return response()->json([
                       'error' => 'Your account has not been verified'
                    ], 401);
                    break;
                case 'suspended';
                    return response()->json([
                        'error' => 'Your account has not been suspended. Please contact administrator @ administrator@udel.com'
                    ], 401);
                    break;
            }
        }

        return $next($request);
    }
}
