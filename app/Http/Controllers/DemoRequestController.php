<?php

namespace App\Http\Controllers;

use App\Models\DemoRequest;
use Illuminate\Http\Request;

class DemoRequestController extends Controller
{
    /**
     * Store a demo request from the frontend home page.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'business_name' => 'nullable|string|max:255',
            'message'       => 'required|string',
        ]);

        DemoRequest::create([
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'business_name' => $request->business_name,
            'message'       => $request->message,
            'status'        => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Thank you! Your demo request has been submitted successfully. Our team will get back to you soon.');
    }

    /**
     * Display a listing of demo requests in SuperAdmin panel.
     */
    public function index()
    {
        $demoRequests = DemoRequest::latest()->get();
        return view('UserManagement.demo_requests', compact('demoRequests'));
    }

    /**
     * Update status of a demo request.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Contacted,Scheduled,Completed,Cancelled',
        ]);

        $demoRequest = DemoRequest::findOrFail($id);
        $demoRequest->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Demo request status updated successfully.');
    }

    /**
     * Delete a demo request.
     */
    public function destroy($id)
    {
        $demoRequest = DemoRequest::findOrFail($id);
        $demoRequest->delete();

        return redirect()->back()->with('success', 'Demo request deleted successfully.');
    }
}
