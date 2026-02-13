<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{
    /**
     * Display a listing of firms.
     */
    public function index()
    {
        $firms = Firm::all();
        return view('firms.index', compact('firms'));
    }

    /**
     * Show the form for creating a new firm.
     */
    public function create()
    {
        return view('firms.create');
    }

    /**
     * Store a newly created firm in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'gstin' => 'nullable|string',
            'pan' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $firm = Firm::create($request->all());

        // If it's the first firm, select it automatically
        if (Firm::count() === 1) {
            Session::put('selected_firm_id', $firm->id);
            Session::put('selected_firm_name', $firm->name);
            return redirect()->route('admin.dashboard')->with('success', 'First firm created and selected successfully.');
        }

        return redirect()->route('firms.index')->with('success', 'Firm created successfully.');
    }

    /**
     * Show the firm selection page.
     */
    public function select()
    {
        $firms = Firm::all();
        return view('firms.select', compact('firms'));
    }

    /**
     * Switch the active firm.
     */
    public function switch(Request $request)
    {
        $request->validate([
            'firm_id' => 'required|exists:firms,id',
        ]);

        $firm = Firm::findOrFail($request->firm_id);
        Session::put('selected_firm_id', $firm->id);
        Session::put('selected_firm_name', $firm->name);

        return redirect()->route('admin.dashboard')->with('success', "Switched to {$firm->name} successfully.");
    }

    /**
     * Show the form for editing the specified firm.
     */
    public function edit($firm)
    {
        $firm = Firm::findOrFail($firm);  // ✅ get single record
        return view('firms.edit', compact('firm'));
    }

    /**
     * Update the specified firm in storage.
     */
    public function update(Request $request, $firm)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        $firm = Firm::findOrFail($firm);
        $firm->update($request->all());

        if (Session::get('selected_firm_id') == $firm->id) {
            Session::put('selected_firm_name', $firm->name);
        }

        return redirect()->route('firms.index')->with('success', 'Firm updated successfully.');
    }

    /**
     * Remove the specified firm from storage.
     */
    public function destroy($id)
    {
        $firm = Firm::findOrFail($id);

        $selectedFirmId = Session::get('selected_firm_id');

        // If selected firm is being deleted and more than one firm exists
        if ($selectedFirmId == $firm->id && Firm::count() > 1) {
            return redirect()->back()
                ->with('error', 'Cannot delete the active firm. Please switch to another firm first.');
        }

        // Optional: prevent deleting last remaining firm
        if (Firm::count() == 1) {
            return redirect()->back()
                ->with('error', 'At least one firm must exist.');
        }

        $firm->delete();

        // Clear session if deleted firm was selected
        if ($selectedFirmId == $firm->id) {
            Session::forget('selected_firm_id');
            Session::forget('selected_firm_name');
        }

        return redirect()->route('firms.index')
            ->with('success', 'Firm deleted successfully.');
    }
}
