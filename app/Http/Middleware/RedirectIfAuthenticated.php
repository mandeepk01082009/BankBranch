<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  ...$guards
     * @return \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'bank_nodals':
                        // Redirect to the bank nodal dashboard or any other desired route
                        return redirect()->route('bank_nodals_dashboard');
                    case 'bank_branches':
                        // Redirect to the bank branch dashboard or any other desired route
                        return redirect()->route('bank_branches_dashboard');
                    case 'departments':
                        // Redirect to the department dashboard or any other desired route
                        return redirect()->route('department_dashboard');
                    default:
                        // Redirect to the home route for other guards
                        return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}


//return redirect()->route('index')->with('error', 'Unauthorized');
