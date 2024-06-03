<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard !== null && Auth::guard($guard)->guest()) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Unauthorized.'], 401);
                }

                $loginRouteName = 'guest.' . $guard . '_login';

                if (! Route::has($loginRouteName)) {
                    throw new \Exception('Login route not defined: ' . $loginRouteName);
                }

                return redirect()->route($loginRouteName);
            }
        }

        return $next($request);
    }

}
