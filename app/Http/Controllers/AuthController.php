<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        $user = Auth::user(); 
        // Redirect based on role
        $role = Auth::user()->role;
        if ($role === 'superadmin') {
            return redirect('/superadmin/dashboard');
        } elseif ($role === 'admin') {
            // return redirect('admin/dashboard');
            return redirect('/admin/dashboard/');
        } elseif ($role === 'client') {
            return redirect('/client/dashboard');
        }

        return redirect('/');
    }

    return back()->with('status', 'Invalid login credentials.');
}



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
