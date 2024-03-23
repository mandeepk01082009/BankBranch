<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        if ($userType === 'bank_nodal' && Auth::check() && session()->has('bank_nodal_id')) {
            return $next($request);
        }

        if ($userType === 'bank_branch' && Auth::check() && session()->has('bank_branch_id')) {
            return $next($request);
        }

        if ($userType === 'department' && Auth::check() && session()->has('department_id')) {
            return $next($request);
        }

        return redirect()->route('index')->with('error', 'You are not authorized to access this page.');
    }
}
