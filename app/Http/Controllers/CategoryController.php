<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function addcategory(Request $request)
    {
        // Validate incoming fields
        $request->validate([
            'category_name'      => 'required|string|max:255',
        ]);

        // Save data to database
        $metalRate = Category::create([
            'admin_id' => Auth::id(),
            'category_name'      => $request->category_name,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }
    public function update(Request $request, $id)
    {
        $metalRate = Category::findOrFail($id);

        $metalRate->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }
    public function destroy($id)
    {
        $rate = Category::findOrFail($id);
        $rate->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
