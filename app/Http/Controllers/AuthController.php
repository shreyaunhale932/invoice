<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login'); // Ensure you have this view
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     // Change 'email' to 'name' in Auth::attempt()
    //     if (Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
    //         $request->session()->regenerate();

    //         // Redirect user based on role
    //         if (Auth::user()->role === 'admin') {
    //             return redirect('/admin/dashboard');
    //         } elseif (Auth::user()->role === 'editor') {
    //             return redirect('/editor/dashboard');
    //         } else {
    //             return redirect('/');
    //         }
    //     }

    //     return back()->with('status', 'Invalid login credentials.');
    // }
    public function authenticate(Request $request)
    {
        $loginInput = $request->input('email') ?? $request->input('username') ?? $request->input('login');
        $password = $request->input('password');

        if (!$loginInput || !$password) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email/Username and password are required.',
                ], 422);
            }
            return back()->with('status', 'Email/Username and password are required.');
        }

        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $primaryField = $isEmail ? 'email' : 'username';

        // 1. Try Superadmin login (web guard)
        $webAttempt = Auth::guard('web')->attempt([$primaryField => $loginInput, 'password' => $password]);
        if (!$webAttempt) {
            $fallbackField = $isEmail ? 'username' : 'email';
            $webAttempt = Auth::guard('web')->attempt([$fallbackField => $loginInput, 'password' => $password]);
        }

        if ($webAttempt) {
            $request->session()->regenerate();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => url('/superadmin/dashboard'),
                ]);
            }
            return redirect('/superadmin/dashboard');
        }

        // 2. Try Admin login (admin guard)
        $adminAttempt = Auth::guard('admin')->attempt([$primaryField => $loginInput, 'password' => $password]);
        if (!$adminAttempt) {
            $fallbackField = $isEmail ? 'username' : 'email';
            $adminAttempt = Auth::guard('admin')->attempt([$fallbackField => $loginInput, 'password' => $password]);
        }

        if ($adminAttempt) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();

            // Store tenant info in session
            $request->session()->put('tenant_db', $admin->db_name);

            // Switch database
            if ($admin->db_name) {
                \App\Services\DatabaseSwitcher::switch($admin->db_name);

                // Update default firm name to company name if available
                if (!empty($admin->company)) {
                    \App\Models\Firm::where('name', 'Default Firm')->update(['name' => $admin->company]);
                }
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => url('/admin/dashboard'),
                ]);
            }
            return redirect('/admin/dashboard');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials. Please check your email and password.',
            ], 401);
        }

        return back()->with('status', 'Invalid credentials. Please check your email and password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
