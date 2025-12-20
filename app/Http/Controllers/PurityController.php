<?php

namespace App\Http\Controllers;

use App\Models\PurityModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurityController extends Controller
{
    // Show list of purities
public function index()
{
    $purities = PurityModel::where('admin_id', Auth::id())
        ->orderBy('id', 'DESC')
        ->get();

    return view('Inventory/Products/purity', compact('purities'));
}


    // Show form to add
    public function create()
    {
        return view('purity.create');
    }

    // Save new purity
public function store(Request $request)
{
    $request->validate([
        'purity_type'  => 'required|in:karat,percent',
        'purity_value' => 'required|numeric|min:0',
    ]);

    // Check if purity already exists for this admin
    $exists = PurityModel::where('admin_id', Auth::id())
        ->where('purity_type', $request->purity_type)
        ->where('purity_value', $request->purity_value)
        ->exists();

    if ($exists) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'This purity already exists.');
    }

    PurityModel::create([
        'admin_id'     => Auth::id(),
        'purity_type'  => $request->purity_type,
        'purity_value' => $request->purity_value,
    ]);

    return redirect()->back()->with('success', 'Purity added successfully');
}


    // Edit form
   public function edit($id)
    {
        return PurityModel::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'purity_value' => 'required|string|max:50',
            'purity_type'  => 'required|string|max:50',
        ]);

        $purity = PurityModel::findOrFail($id);

        $purity->update([
            'purity_value' => $request->purity_value,
            'purity_type'  => $request->purity_type,
        ]);

        return redirect()->back()->with('success', 'Purity updated successfully!');
    }

    public function destroy($id)
    {
        PurityModel::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Purity deleted successfully!');
    }
}
