<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        // Retrieve the email and password from the request
        $credentials = $request->only('email', 'password');
        $email = $credentials['email'];
        $password = $credentials['password'];
    
        // First, try to authenticate as a regular user (assuming you still have some logic for that)
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if ($user && Auth::getProvider()->validateCredentials($user, $credentials)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard'); // or any other route specific to regular users
        }
    
        // If not a regular user, check if the user is a bank nodal
        $bankNodal = DB::table('bank_nodals')->where('email', $email)->first();
        if ($bankNodal && Hash::check($password, $bankNodal->password)) {
            // Manually log in the bank nodal user
            // Note: This assumes your bank nodal users do not have corresponding user records in the `users` table.
            // If they do, you should retrieve and log in the corresponding User model instead.
            Auth::loginUsingId($bankNodal->id); // or use a custom method to handle authentication for bank nodals
            
            // Store bank nodal's information in session to maintain the login state
            session(['bank_nodal_id' => $bankNodal->id]);
            
            $request->session()->regenerate();
            return redirect()->route('bank_nodals_dashboard'); // Ensure this route is defined in your web.php
        }

        $bankBranch = DB::table('bank_branches')->where('email', $email)->first();
        if ($bankBranch && Hash::check($password, $bankBranch->password)) {
            // Manually log in the bank nodal user
            // Note: This assumes your bank nodal users do not have corresponding user records in the `users` table.
            // If they do, you should retrieve and log in the corresponding User model instead.
            Auth::loginUsingId($bankBranch->id); // or use a custom method to handle authentication for bank nodals
            
            // Store bank nodal's information in session to maintain the login state
            session(['bank_branch_id' => $bankBranch->id]);
            
            $request->session()->regenerate();
            return redirect()->route('bank_branches_dashboard'); // Ensure this route is defined in your web.php
        }

        $department = DB::table('departments')->where('email', $email)->first();
        if ($department && Hash::check($password, $department->password)) {
            // Manually log in the bank nodal user
            // Note: This assumes your bank nodal users do not have corresponding user records in the `users` table.
            // If they do, you should retrieve and log in the corresponding User model instead.
            Auth::loginUsingId($department->id); // or use a custom method to handle authentication for bank nodals
            
            // Store bank nodal's information in session to maintain the login state
            session(['department_id' => $department->id]);
            
            $request->session()->regenerate();
            return redirect()->route('department_dashboard'); // Ensure this route is defined in your web.php
        }
    
        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }
    
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();
    //     if (auth()->user()->user_type_id == 1) {
    //         return redirect()->route('dashboard');
    //     } elseif (auth()->check() && auth()->user()->isBankNodal()) {
    //         return redirect()->route('bank_nodals_dashboard'); // Use the actual route name
    //     }
    //      elseif (auth()->user()->user_type_id == 3) {
    //         return redirect()->route('bank_branches_dashboard');
    //     } elseif (auth()->user()->user_type_id == 4) {
    //         return redirect()->route('department_dashboard');
    //     } 
    //     // else {
    //     //     // Handle other user types or invalid user_type_id
    //     //     return redirect()->route('dashboard'); // For example, redirect to a default dashboard
    //     // }
        
        
    // }

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
