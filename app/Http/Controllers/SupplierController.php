<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index(Request $request)
    {
        $query = Supplier::where('admin_id', Auth::guard('admin')->id());

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('shop_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('gst_no', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->latest()->get();

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'shop_name'      => 'nullable|string|max:255',
            'gst_no'         => 'nullable|string|max:50',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string',
            'city'           => 'nullable|string|max:100',
            'state'          => 'nullable|string|max:100',
            'pincode'        => 'nullable|string|max:10',
            'bank_name'      => 'nullable|string|max:255',
            'branch'         => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc_code'      => 'nullable|string|max:20',
            'adhar_card'     => 'nullable|string|max:50',
            'pan_card'       => 'nullable|string|max:50',
        ]);

        $supplier = Supplier::create([
            'admin_id'       => Auth::guard('admin')->id(),
            'name'           => $request->name,
            'shop_name'      => $request->shop_name,
            'gst_no'         => $request->gst_no,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'pincode'        => $request->pincode,
            'bank_name'      => $request->bank_name,
            'branch'         => $request->branch,
            'account_number' => $request->account_number,
            'ifsc_code'      => $request->ifsc_code,
            'adhar_card'     => $request->adhar_card,
            'pan_card'       => $request->pan_card,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Supplier added successfully!',
                'supplier' => $supplier
            ]);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier added successfully!');
    }

    /**
     * Display the specified supplier.
     */
    public function show($id)
    {
        $supplier = Supplier::where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit($id)
    {
        $supplier = Supplier::where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'shop_name'      => 'nullable|string|max:255',
            'gst_no'         => 'nullable|string|max:50',
            'phone'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'        => 'nullable|string',
            'city'           => 'nullable|string|max:100',
            'state'          => 'nullable|string|max:100',
            'pincode'        => 'nullable|string|max:10',
            'bank_name'      => 'nullable|string|max:255',
            'branch'         => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc_code'      => 'nullable|string|max:20',
            'adhar_card'     => 'nullable|string|max:50',
            'pan_card'       => 'nullable|string|max:50',
        ]);

        $supplier->update([
            'name'           => $request->name,
            'shop_name'      => $request->shop_name,
            'gst_no'         => $request->gst_no,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'address'        => $request->address,
            'city'           => $request->city,
            'state'          => $request->state,
            'pincode'        => $request->pincode,
            'bank_name'      => $request->bank_name,
            'branch'         => $request->branch,
            'account_number' => $request->account_number,
            'ifsc_code'      => $request->ifsc_code,
            'adhar_card'     => $request->adhar_card,
            'pan_card'       => $request->pan_card,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Supplier updated successfully!',
                'supplier' => $supplier
            ]);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully!');
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        $supplier->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Supplier deleted successfully!'
            ]);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully!');
    }
}
