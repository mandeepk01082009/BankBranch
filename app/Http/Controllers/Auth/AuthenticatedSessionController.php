<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // dd(auth()->user()->user_type_id);
        // if(auth()->user()->user_type_id == 1){
        //     return redirect('cms-admin');
        // }
        // else if(auth()->user()->user_type_id == 2){
        //     return redirect('bank-nodals');
        // }
        // else if(auth()->user()->user_type_id == 3){
        //     return redirect('bank-branhes');
        // }
        // else if(auth()->user()->user_type_id == 4){
        //     return redirect('department');
        // }
        if (auth()->user()->user_type_id == 1) {
            return redirect()->route('dashboard');
        } elseif (auth()->user()->user_type_id == 2) {
            return redirect()->route('bank_nodals_dashboard');
        } elseif (auth()->user()->user_type_id == 3) {
            return redirect()->route('bank_branches_dashboard');
        } elseif (auth()->user()->user_type_id == 4) {
            return redirect()->route('department_dashboard');
        } 
        // else {
        //     // Handle other user types or invalid user_type_id
        //     return redirect()->route('dashboard'); // For example, redirect to a default dashboard
        // }
        
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
