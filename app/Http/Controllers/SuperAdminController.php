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
        $states = [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
            'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh',
            'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
            'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh',
            'Uttarakhand', 'West Bengal', 'Andaman and Nicobar Islands', 'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu', 'Delhi', 'Jammu and Kashmir',
            'Ladakh', 'Lakshadweep', 'Puducherry'
        ];
        return view('UserManagement/users', compact('users', 'states'));
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
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
        ]);

        $admin = \App\Models\Admin::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
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
    public function updateAdmin(Request $request, $id)
    {
        // dd( $request);
        $admin = \App\Models\Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'phone' => 'required|string|max:15',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
            'password' => 'nullable|min:6', // Password optional on update
        ]);
// dd($request->address);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ];

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->back()->with('success', 'Admin updated successfully.');
    }

    public function destroyAdmin($id)
    {
        $admin = \App\Models\Admin::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin deleted successfully.');
    }

    public function settings()
    {
        return view('Settings/settings');
    }
}
