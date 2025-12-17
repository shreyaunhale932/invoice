<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
class SubCategoryController extends Controller
{
    //
       public function addsubcategory(Request $request)
    {
        // Validate incoming fields
        $request->validate([
            'subcategory_name'  => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        // Save data to database
        $metalRate = Subcategory::create([
            'admin_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_name'  => $request->subcategory_name,
        ]);

        return redirect()->back()->with('success', 'SubCategory added successfully!');
    }
       public function update(Request $request, $id)
    {
        $metalRate = Subcategory::findOrFail($id);

        $metalRate->update([
           'category_id' => $request->category_id,
            'subcategory_name'  => $request->subcategory_name,
        ]);

        return redirect()->back()->with('success', 'SubCategory updated successfully!');
    }
    public function destroy($id)
    {
        $rate = Subcategory::findOrFail($id);
        $rate->delete();

        return redirect()->back()->with('success', 'SubCategory deleted successfully.');
    }
}
