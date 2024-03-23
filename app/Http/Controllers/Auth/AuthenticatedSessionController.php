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
            // Additional check for user_type_id to be 1
            if ($user->user_type_id == 1) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->route('dashboard'); // Redirect to dashboard or another route specific to user_type_id 1
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
}
    
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
    
    //     $request->session()->regenerate();
    
    //     $user = auth()->user();
    
    //     if ($user->user_type_id == 1) {
    //         return redirect()->route('dashboard');
    //     } elseif ($user->user_type_id == 2) {
    //         return redirect()->route('bank_nodals_dashboard');
    //     } elseif ($user->user_type_id == 3) {
    //         return redirect()->route('bank_branches_dashboard');
    //     } elseif ($user->user_type_id == 4) {
    //         return redirect()->route('department_dashboard');
    //     } else {
    //         // Handle other user types or invalid user_type_id
    //         return redirect()->route('dashboard'); // For example, redirect to a default dashboard
    //     }
    // }
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

         // Clear all custom session variables
        $request->session()->forget(['bank_nodal_id', 'bank_branch_id', 'department_id']);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
