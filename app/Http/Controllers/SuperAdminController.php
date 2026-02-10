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
        $users = \App\Models\Admin::all();
        return view('UserManagement/users', compact('users'));
    }

    public function storeAdmin(Request $request, \App\Services\TenantService $tenantService)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
            'status' => 'required|in:active,inactive',
        ]);
    
        $admin = \App\Models\Admin::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => $request->status,
        ]);

        try {
            $dbName = $tenantService->createTenant($admin);
            $admin->update(['db_name' => $dbName]);
        } catch (\Exception $e) {
            // Optionally handle cleanup if DB creation fails
            return redirect()->back()->with('error', 'Admin created but database setup failed: ' . $e->getMessage());
        }
    
        return redirect()->back()->with('success', 'Admin added and database initialized successfully.');
    }
    public function settings()
    {
        return view('Settings/settings');
    }
}
