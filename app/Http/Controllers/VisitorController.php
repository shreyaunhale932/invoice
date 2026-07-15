<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|max:20',
            'business_name'  => 'nullable|max:255',
            'message'        => 'required',
        ]);

        Visitor::create([
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'business_name' => $request->business_name,
            'message'       => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you! We have received your enquiry.');
    }

    public function getvisitor(){
        $visitors = Visitor::all();
        return view('UserManagement.visitor',compact('visitors'));
    }
}
