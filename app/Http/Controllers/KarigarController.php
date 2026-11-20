<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karigar;
use App\Models\KarigarAssignment;
use App\Models\KarigarReceipt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KarigarController extends Controller
{
    /**
     * Display a listing of the karigars.
     */
    public function index(Request $request)
    {
        $query = Karigar::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('speciality')) {
            $query->where('speciality', $request->speciality);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('shop_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $totalKarigars     = Karigar::count();
        $activeKarigars    = Karigar::where('status', 'active')->count();
        $activeAssignments = KarigarAssignment::whereIn('status', ['assigned', 'in_progress'])->count();
        $totalMetalHeld    = Karigar::where('status', 'active')->sum('current_metal_balance');

        $karigars = $query->withCount([
            'assignments',
            'activeAssignments',
            'receipts'
        ])->latest()->paginate(15)->withQueryString();

        return view('karigars.index', compact(
            'karigars',
            'totalKarigars',
            'activeKarigars',
            'activeAssignments',
            'totalMetalHeld'
        ));
    }

    /**
     * Show the form for creating a new karigar.
     */
    public function create()
    {
        // Suggest next code
        $lastKarigar = Karigar::withTrashed()->orderBy('id', 'desc')->first();
        $nextId = $lastKarigar ? ($lastKarigar->id + 1) : 1;
        $suggestedCode = 'KG-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('karigars.create', compact('suggestedCode'));
    }

    /**
     * Store a newly created karigar in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                   => 'required|string|max:255',
            'code'                   => 'nullable|string|max:50',
            'shop_name'              => 'nullable|string|max:255',
            'phone'                  => 'nullable|string|max:25',
            'email'                  => 'nullable|email|max:255',
            'speciality'             => 'nullable|string|max:255',
            'address'                => 'nullable|string',
            'city'                   => 'nullable|string|max:100',
            'state'                  => 'nullable|string|max:100',
            'pincode'                => 'nullable|string|max:20',
            'pan_card'               => 'nullable|string|max:50',
            'adhar_card'             => 'nullable|string|max:50',
            'bank_name'              => 'nullable|string|max:255',
            'branch'                 => 'nullable|string|max:255',
            'account_number'         => 'nullable|string|max:50',
            'ifsc_code'              => 'nullable|string|max:25',
            'opening_metal_balance'  => 'nullable|numeric',
            'opening_amount_balance' => 'nullable|numeric',
            'status'                 => 'nullable|in:active,inactive',
            'notes'                  => 'nullable|string',
        ]);

        $code = $request->filled('code') ? $request->code : null;
        if (!$code) {
            $last = Karigar::withTrashed()->orderBy('id', 'desc')->first();
            $nextId = $last ? ($last->id + 1) : 1;
            $code = 'KG-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        }

        $openingMetal = (float)($request->opening_metal_balance ?? 0);

        $karigar = Karigar::create([
            'admin_id'               => Auth::guard('admin')->id(),
            'code'                   => $code,
            'name'                   => $request->name,
            'shop_name'              => $request->shop_name,
            'phone'                  => $request->phone,
            'email'                  => $request->email,
            'speciality'             => $request->speciality,
            'address'                => $request->address,
            'city'                   => $request->city,
            'state'                  => $request->state,
            'pincode'                => $request->pincode,
            'pan_card'               => $request->pan_card,
            'adhar_card'             => $request->adhar_card,
            'bank_name'              => $request->bank_name,
            'branch'                 => $request->branch,
            'account_number'         => $request->account_number,
            'ifsc_code'              => $request->ifsc_code,
            'opening_metal_balance'  => $openingMetal,
            'opening_amount_balance' => $request->opening_amount_balance ?? 0,
            'current_metal_balance'  => $openingMetal,
            'status'                 => $request->status ?? 'active',
            'notes'                  => $request->notes,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Karigar added successfully!',
                'karigar' => $karigar,
            ]);
        }

        return redirect()->route('karigars.index')
            ->with('success', 'Karigar ' . $karigar->name . ' registered successfully!');
    }

    /**
     * Display the specified karigar.
     */
    public function show($id)
    {
        $karigar = Karigar::with([
            'assignments.order.customer',
            'receipts.order',
        ])->findOrFail($id);

        $totalIssuedWeight = $karigar->assignments()->sum('metal_issued_weight');
        $totalReceivedWeight = $karigar->receipts()->sum('finished_net_weight');
        $totalScrapReturned = $karigar->receipts()->sum('scrap_metal_returned');
        $totalWastage = $karigar->receipts()->sum('actual_wastage');
        $totalMakingChargesPaid = $karigar->receipts()->sum('total_making_charges');

        return view('karigars.show', compact(
            'karigar',
            'totalIssuedWeight',
            'totalReceivedWeight',
            'totalScrapReturned',
            'totalWastage',
            'totalMakingChargesPaid'
        ));
    }

    /**
     * Show the form for editing the specified karigar.
     */
    public function edit($id)
    {
        $karigar = Karigar::findOrFail($id);
        return view('karigars.edit', compact('karigar'));
    }

    /**
     * Update the specified karigar in storage.
     */
    public function update(Request $request, $id)
    {
        $karigar = Karigar::findOrFail($id);

        $request->validate([
            'name'                   => 'required|string|max:255',
            'code'                   => 'nullable|string|max:50',
            'shop_name'              => 'nullable|string|max:255',
            'phone'                  => 'nullable|string|max:25',
            'email'                  => 'nullable|email|max:255',
            'speciality'             => 'nullable|string|max:255',
            'address'                => 'nullable|string',
            'city'                   => 'nullable|string|max:100',
            'state'                  => 'nullable|string|max:100',
            'pincode'                => 'nullable|string|max:20',
            'pan_card'               => 'nullable|string|max:50',
            'adhar_card'             => 'nullable|string|max:50',
            'bank_name'              => 'nullable|string|max:255',
            'branch'                 => 'nullable|string|max:255',
            'account_number'         => 'nullable|string|max:50',
            'ifsc_code'              => 'nullable|string|max:25',
            'opening_metal_balance'  => 'nullable|numeric',
            'opening_amount_balance' => 'nullable|numeric',
            'status'                 => 'required|in:active,inactive',
            'notes'                  => 'nullable|string',
        ]);

        $diffOpening = (float)($request->opening_metal_balance ?? 0) - (float)$karigar->opening_metal_balance;

        $karigar->update([
            'code'                   => $request->code ?: $karigar->code,
            'name'                   => $request->name,
            'shop_name'              => $request->shop_name,
            'phone'                  => $request->phone,
            'email'                  => $request->email,
            'speciality'             => $request->speciality,
            'address'                => $request->address,
            'city'                   => $request->city,
            'state'                  => $request->state,
            'pincode'                => $request->pincode,
            'pan_card'               => $request->pan_card,
            'adhar_card'             => $request->adhar_card,
            'bank_name'              => $request->bank_name,
            'branch'                 => $request->branch,
            'account_number'         => $request->account_number,
            'ifsc_code'              => $request->ifsc_code,
            'opening_metal_balance'  => $request->opening_metal_balance ?? 0,
            'opening_amount_balance' => $request->opening_amount_balance ?? 0,
            'current_metal_balance'  => (float)$karigar->current_metal_balance + $diffOpening,
            'status'                 => $request->status,
            'notes'                  => $request->notes,
        ]);

        return redirect()->route('karigars.index')
            ->with('success', 'Karigar ' . $karigar->name . ' updated successfully!');
    }

    /**
     * Remove the specified karigar from storage.
     */
    public function destroy($id)
    {
        $karigar = Karigar::findOrFail($id);

        if ($karigar->activeAssignments()->exists()) {
            return redirect()->route('karigars.index')
                ->with('error', 'Cannot delete karigar with active ongoing work assignments!');
        }

        $karigar->delete();

        return redirect()->route('karigars.index')
            ->with('success', 'Karigar deleted successfully.');
    }

    /**
     * Show detailed ledger for the karigar.
     */
    public function ledger($id)
    {
        $karigar = Karigar::findOrFail($id);

        // Fetch all transactions: Assignments (Metal Issue) and Receipts (Metal Received)
        $assignments = $karigar->assignments()->with('order')->get()->map(function($item) {
            return [
                'date'           => $item->assigned_date,
                'type'           => 'issue',
                'ref_no'         => $item->assignment_no,
                'order_no'       => $item->order ? $item->order->order_no : 'N/A',
                'description'    => 'Metal Issued for ' . ($item->order ? $item->order->item_name : 'Order') . ' (' . ($item->metal_issued_type ?? 'Gold') . ')',
                'metal_in'       => 0,
                'metal_out'      => (float)$item->metal_issued_weight,
                'making_charges' => 0,
            ];
        });

        $receipts = $karigar->receipts()->with('order')->get()->map(function($item) {
            return [
                'date'           => $item->received_date,
                'type'           => 'receipt',
                'ref_no'         => $item->receipt_no,
                'order_no'       => $item->order ? $item->order->order_no : 'N/A',
                'description'    => 'Finished Item Received (Net Wt: ' . number_format($item->finished_net_weight, 3) . 'g, Scrap: ' . number_format($item->scrap_metal_returned, 3) . 'g, Wastage: ' . number_format($item->actual_wastage, 3) . 'g)',
                'metal_in'       => (float)($item->finished_net_weight + $item->scrap_metal_returned + $item->actual_wastage),
                'metal_out'      => 0,
                'making_charges' => (float)$item->total_making_charges,
            ];
        });

        $transactions = $assignments->concat($receipts)->sortBy('date')->values();

        return view('karigars.ledger', compact('karigar', 'transactions'));
    }
}
