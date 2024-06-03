<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RestrictSpecialAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and has a special session indicating they are bank_nodal, bank_branch, or department
        if (Auth::check() && (session()->has('bank_nodal_id') || session()->has('bank_branch_id') || session()->has('department_id'))) {
            // Redirect them with an error message or to a specific route if they are trying to access restricted areas
            return redirect()->route('index')->with('error', 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
