<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BusinessDetail;
use App\Models\BankDetails;
use Intervention\Image\Facades\Image as ResizeImage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        // return view( 'Dashboard/index' );
        $user = Auth::user();

        // Check if the logged-in admin is trying to access their own dashboard
        if ($user->role === 'admin') {
            return view('Dashboard/index', compact('user'));
        } else {
            return redirect('/')->with('status', 'Access Denied.');
        }
    }
    public function storeClient(Request $request)
    {


        BusinessDetail::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'admin_id' => Auth::id(), // Assign logged-in admin's ID
        ]);

        return redirect()->route('admin.customers')->with('status', 'Customer added successfully!');
    }
    public function settings()
    {
        $users = Auth::user();
    
        $user = BusinessDetail::where('user_id', $users->id)->first(); // Or firstOrFail()
    
        // dd($businessDetail); // Remove or comment out after debugging
    
        return view('Settings/settings', compact('user'));
    }



public function storeSetting(Request $request)
{
    // Validate request
    $request->validate([
        'image' => 'nullable|image|mimes:jpg,png,svg|max:2048',
        'business_name' => 'nullable|string|max:255',
        'gstin' => 'nullable|string|max:15',
        'pan' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'country' => 'nullable|string',
        'state' => 'nullable|string',
        'city' => 'nullable|string',
        'postalcode' => 'nullable|string|max:6',
        'contact_number' => 'nullable|string|max:20',
        'email' => 'required|email|unique:business_details,email,' . Auth::id() . ',user_id',
    ]);

    // Handle image upload
    $imageName = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        $path = public_path('assets/images/logo/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Resize and save
        // $img = Image::make($image);
        // $img->resize(152, 152)->save($path . $imageName);

        $img = Image::read($image)
        ->resize(152, 152)->save($path . $imageName);
    }

    // Get the authenticated user
    $user = Auth::user();

    // Update or create business details
    BusinessDetail::updateOrCreate(
        ['user_id' => $user->id],
        [
            'business_name' => $request->business_name,
            'logo' => $imageName,
            'gstin' => $request->gstin,
            'pan' => $request->pan,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'postalcode' => $request->postalcode,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
        ]
    );

    return redirect()->back()->with('success', 'Business details updated successfully!');
}
public function invoice_settings()
{
  
    return view('Settings/invoice-settings');
}
public function bank_account()
{
    $users = Auth::user();
    
    $user = BankDetails::where('user_id', $users->id)->get();
    // dd($user);exit();
    return view('Settings/bank-account', compact('user'));
}
public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'bankname' => 'required|string|max:255',
            'accno' => 'required|numeric|unique:bankdetails,accno',
            'holdername' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'ifsc' => 'required|string|max:20',
        ]);
        $user = Auth::user();
        // Store data in the database
        BankDetails::create([
            'user_id' => $user->id, // Assuming logged-in user
            'bankname' => $request->bankname,
            'accno' => $request->accno,
            'holdername' => $request->holdername,
            'branch' => $request->branch,
            'ifsc' => $request->ifsc,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Bank details added successfully!');
    }

}
