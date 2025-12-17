<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\PurityModel;
use App\Models\MetalRate;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customers()
    {
        $customers = Customer::where('admin_id', Auth::id())->get();
        return view('Customers/customers', compact('customers'));
    }
    public function addcustomer()
    {

        return view('Customers/add-customer');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address1' => 'nullable|string',
            'address2' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'bank_name' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc' => 'nullable|string|max:20',
        ]);
      //  dd($request);exit();
        $customer = Customer::create([
            'admin_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'account_holder_name' => $request->account_holder_name,
            'account_number' => $request->account_number,
            'ifsc' => $request->ifsc,
        ]);

        return redirect()->route('add-customer')->with('success', 'Customer added successfully!');
    }
    public function addproducts()
    {
         $adminId = Auth::id();

    $categories = Category::where('admin_id', $adminId)
        ->orderBy('category_id', 'DESC')
        ->get();

    $subcategories = Subcategory::where('admin_id', $adminId)
        ->orderBy('subcategory_id', 'DESC')
        ->get();

    $purities = PurityModel::where('admin_id', $adminId)
        ->orderBy('id', 'DESC')
        ->get();

    $metalRates = MetalRate::where('admin_id', $adminId)
        ->orderBy('id', 'DESC')
        ->get();

    return view('Inventory/Products/add-products', compact(
        'categories',
        'subcategories',
        'purities',
        'metalRates'
    ));
   }
}
