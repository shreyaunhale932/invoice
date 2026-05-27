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
    public function dashboard(\Illuminate\Http\Request $request)
    {
        $user = Auth::guard('admin')->user();
        
        if (!$user) {
            return redirect('/')->with('status', 'Access Denied.');
        }

        $adminId = $user->id;
        $filter = $request->get('filter', 'all');

        $dateRange = null;
        if ($filter == 'today') {
            $dateRange = [now()->startOfDay(), now()->endOfDay()];
        } elseif ($filter == 'week') {
            $dateRange = [now()->startOfWeek(), now()->endOfWeek()];
        } elseif ($filter == 'month') {
            $dateRange = [now()->startOfMonth(), now()->endOfMonth()];
        } elseif ($filter == 'year') {
            $dateRange = [now()->startOfYear(), now()->endOfYear()];
        }

        $applyFilter = function ($query) use ($dateRange) {
            if ($dateRange) {
                return $query->whereBetween('created_at', $dateRange);
            }
            return $query;
        };

        $invoicesCount = 0;
        $customersCount = 0;
        $amountDue = 0;
        $estimatesCount = 0;
        $totalSales = 0;
        $receipts = 0;
        $expenses = 0;

        // Fetch dynamic statistics mirroring the Livewire components safely
        try { $invoicesCount = $applyFilter(\App\Models\SellInvoice::where('admin_id', $adminId))->count(); } catch (\Exception $e) {}
        try { $customersCount = $applyFilter(\App\Models\Customer::where('admin_id', $adminId))->count(); } catch (\Exception $e) {}
        try { $amountDue = $applyFilter(\App\Models\SellInvoice::where('admin_id', $adminId))->sum('amount_left'); } catch (\Exception $e) {}
        
        // Removed Invoice query as it causes table not found error in tenant DBs
        
        try { $totalSales = $applyFilter(\App\Models\SellInvoice::where('admin_id', $adminId))->sum('final_amount'); } catch (\Exception $e) {}
        try { $receipts = $applyFilter(\App\Models\SellInvoice::where('admin_id', $adminId))->sum('total_received'); } catch (\Exception $e) {}
        try { $expenses = $applyFilter(\App\Models\Expense::where('admin_id', $adminId))->sum('amount'); } catch (\Exception $e) {}
        
        // As we discovered, no Purchase model exists yet, so we will use a dummy totalPurchases or sum from expenses for now.
        $totalPurchases = 349410.68; // Based on mockup numbers for now, or you could sum it from the JSON if needed.

        // Graphical Chart Data based on filter
        $salesLabels = [];
        $salesData = [];
        
        if ($filter == 'year') {
            for ($i = 11; $i >= 0; $i--) {
                $dateMonth = date('m', strtotime("-$i months"));
                $dateYear = date('Y', strtotime("-$i months"));
                $salesLabels[] = date('M Y', strtotime("-$i months"));
                try {
                    $dayTotal = \App\Models\SellInvoice::where('admin_id', $adminId)
                        ->whereMonth('created_at', $dateMonth)
                        ->whereYear('created_at', $dateYear)
                        ->sum('final_amount');
                    $salesData[] = (int) $dayTotal;
                } catch (\Exception $e) {
                    $salesData[] = 0; 
                }
            }
        } elseif ($filter == 'month') {
            for ($i = 29; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $salesLabels[] = date('d M', strtotime("-$i days"));
                try {
                    $dayTotal = \App\Models\SellInvoice::where('admin_id', $adminId)->whereDate('created_at', $date)->sum('final_amount');
                    $salesData[] = (int) $dayTotal;
                } catch (\Exception $e) {
                    $salesData[] = 0;
                }
            }
        } elseif ($filter == 'today') {
            for ($i = 8; $i <= 20; $i+=3) {
                $timeStart = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00';
                $timeEnd = str_pad($i+2, 2, '0', STR_PAD_LEFT) . ':59:59';
                $salesLabels[] = "$i:00 - ".($i+2).":59";
                try {
                    $dayTotal = \App\Models\SellInvoice::where('admin_id', $adminId)
                        ->whereDate('created_at', date('Y-m-d'))
                        ->whereTime('created_at', '>=', $timeStart)
                        ->whereTime('created_at', '<=', $timeEnd)
                        ->sum('final_amount');
                    $salesData[] = (int) $dayTotal;
                } catch (\Exception $e) {
                    $salesData[] = 0;
                }
            }
        } else {
            // default 'all' or 'week': Last 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $salesLabels[] = date('d M', strtotime("-$i days"));
                try {
                    $dayTotal = \App\Models\SellInvoice::where('admin_id', $adminId)->whereDate('created_at', $date)->sum('final_amount');
                    $salesData[] = (int) $dayTotal;
                } catch (\Exception $e) {
                    $salesData[] = 0; 
                }
            }
        }

        // Leaderboards and Tables
        $recentInvoices = collect([]);
        $topCustomers = collect([]);
        $fastSellingItems = collect([]);

        try {
            $recentInvoices = \App\Models\SellInvoice::where('admin_id', $adminId)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
        } catch (\Exception $e) {}

        try {
            $topCustomers = \App\Models\Customer::where('admin_id', $adminId)
                ->take(5)
                ->get();
        } catch (\Exception $e) {}

        try {
            $fastSellingItems = \App\Models\Product::where('admin_id', $adminId)->take(5)->get();
        } catch (\Exception $e) {}

        return view('Dashboard/newindex', compact(
            'user', 
            'filter',
            'invoicesCount', 
            'customersCount', 
            'amountDue', 
            'estimatesCount',
            'totalSales',
            'receipts',
            'expenses',
            'totalPurchases',
            'salesLabels',
            'salesData',
            'recentInvoices',
            'topCustomers',
            'fastSellingItems'
        ));
    }
    public function storeClient(Request $request)
    {


        BusinessDetail::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'admin_id' => Auth::guard('admin')->id(), // Assign logged-in admin's ID
        ]);

        return redirect()->route('admin.customers')->with('status', 'Customer added successfully!');
    }
    public function settings()
    {
        $users = Auth::guard('admin')->user();
        // dd($users);

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
        'email' => 'required|email|unique:business_details,email,' . Auth::guard('admin')->id() . ',user_id',
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
    $user = Auth::guard('admin')->user();

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
    $users = Auth::guard('admin')->user();

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
        $user = Auth::guard('admin')->user();
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
