<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        return view( 'SuperAdmin.dashboard' );
    }

    // public function createAdmin()
    // {
    //     $users = User::where('role', 'admin')->get();
    //     // dd($users);
    //     return view('UserManagement/users', compact('users'));
        
    // }
    public function createAdmin()
    {
        $users = User::where('role', 'admin')->get();
        return view('UserManagement/users', compact('users'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'role' => 'required|in:superadmin,admin',
            'password' => 'required|min:6|confirmed',
            'status' => 'required|in:active,inactive',
        ]);
    
        User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);
    
        return redirect()->back()->with('success', 'User added successfully.');
    }
    public function settings()
    {
        return view('Settings/settings');
    }
}
