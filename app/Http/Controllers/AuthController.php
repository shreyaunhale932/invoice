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
        // dd($request->username.'-'.$request->password);
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 1. Try Superadmin login (web guard)
        if (Auth::guard('web')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'redirect' => url('/superadmin/dashboard'),
            ]);
        }
        // dd($credentials['username'].'-'.$credentials['password']);

        // 2. Try Admin login (admin guard)
        if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();

            // Store tenant info in session
            $request->session()->put('tenant_db', $admin->db_name);

            // Switch database
            if ($admin->db_name) {
                \App\Services\DatabaseSwitcher::switch($admin->db_name);
            }

            return response()->json([
                'success' => true,
                'redirect' => url('/admin/dashboard'),
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password.',
            ], 401);
        }

        return back()->with('status', 'Invalid username or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
