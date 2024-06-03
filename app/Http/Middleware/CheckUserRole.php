<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        $user = $request->user();
    
        if ($user) {
            switch ($user->guard) {
                case 'bank_nodals':
                    if ($user->user_type_id != $role) {
                        return redirect()->route('index')->with('error', 'Unauthorized');
                    }
                    break;
                case 'bank_branches':
                    if ($user->user_type_id != $role) {
                        return redirect()->route('index')->with('error', 'Unauthorized');
                    }
                    break;
                case 'departments':
                    if ($user->user_type_id != $role) {
                        return redirect()->route('index')->with('error', 'Unauthorized');
                    }
                    break;
                default:
                    if ($user->user_type_id != $role) {
                        return redirect()->route('index')->with('error', 'Unauthorized');
                    }
                    break;
            }
        }
    
        return $next($request);
    }
}
