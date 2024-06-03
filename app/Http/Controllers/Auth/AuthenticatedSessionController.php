<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function createAdmin()
     { 
        $routeName = 'guest.web_login'; 
        return view('auth.login', ['guard' => 'web', 'routeName' => $routeName]);
     }

    // public function createAdmin()
    // {
    //     return view('auth.login', ['guard' => 'web']);
    // }
    
    public function createBankNodal()
    {
        //dd('kk');
        $routeName = 'guest.bank_nodals_login'; 
        return view('auth.login', ['guard' => 'bank_nodals', 'routeName' => $routeName]);
    }
    
    public function createBankBranch()
    {
        $routeName = 'guest.bank_branches_login';
        return view('auth.login', ['guard' => 'bank_branches', 'routeName' => $routeName]);
    }
    
    public function createDepartment()
    {
        $routeName = 'guest.departments_login';
        return view('auth.login', ['guard' => 'departments', 'routeName' => $routeName]);
    }

    public function createApplicant()
    {
        $routeName = 'guest.applicants_login';
        return view('auth.login', ['guard' => 'applicants', 'routeName' => $routeName]);
    }

    /**
     * Handle an incoming authentication request for the 'web' guard.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();

            if ($user->user_type_id == 1) {
                return redirect()->route('dashboard');
            }
        }

        // If authentication fails, return the user back to the login page
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle an incoming authentication request for the 'bank_nodals' guard.
     */
    public function storeBankNodal(LoginRequest $request): RedirectResponse
    {
        //dd("kk");
        $credentials = $request->only('email', 'password');

        if (Auth::guard('bank_nodals')->attempt($credentials)) {
            $bankNodal = auth('bank_nodals')->user();
            //dd($bankNodal->user_type_id);

            if ($bankNodal->user_type_id == 2) {
                return redirect()->route('bank_nodals_dashboard');
            }
        }

        // If authentication fails, return the user back to the login page
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle an incoming authentication request for the 'bank_branches' guard.
     */
    public function storeBankBranch(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('bank_branches')->attempt($credentials)) {
            $bankBranch = auth('bank_branches')->user();

            if ($bankBranch->user_type_id == 3) {
                return redirect()->route('bank_branches_dashboard');
            }
        }

        // If authentication fails, return the user back to the login page
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle an incoming authentication request for the 'departments' guard.
     */
    public function storeDepartment(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('departments')->attempt($credentials)) {
            $department = auth('departments')->user();

            if ($department->user_type_id == 4) {
                return redirect()->route('department_dashboard');
            }
        }

        // If authentication fails, return the user back to the login page
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    public function storeApplicant(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('applicants')->attempt($credentials)) {
            $applicant = auth('applicants')->user();

            if ($applicant->user_type_id == 5) {
                return redirect()->route('applicants_dashboard');
            }
        }

        // If authentication fails, return the user back to the login page
        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }
// ...

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Clear all custom session variables
        $request->session()->forget(['bank_nodal_id', 'bank_branch_id', 'department_id']);

        // Logout from all guards
        auth()->guard('bank_nodals')->logout();
        auth()->guard('bank_branches')->logout();
        auth()->guard('departments')->logout();
        auth()->guard('applicants')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}