<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:20',
            'business_name' => 'nullable|string|max:255',
            'message'       => 'required|string|max:10000',
        ]);

        $visitor = Visitor::create($validated);

        Mail::raw(
            "A new contact enquiry has been submitted.\n\n"
                . "Name: {$visitor->full_name}\n"
                . "Email: {$visitor->email}\n"
                . "Phone: {$visitor->phone}\n"
                . "Business: " . ($visitor->business_name ?: 'Not provided') . "\n\n"
                . "Message:\n{$visitor->message}",
            function ($mail) use ($visitor) {
                $mail->to('priyanka.kadam@sirsonite.com')
                    ->replyTo($visitor->email, $visitor->full_name)
                    ->subject('New contact enquiry');
            }
        );

        return redirect()->route('contact')->with('success', 'Thank you! We have received your enquiry.');
    }

    public function contactMessages()
    {
        $contactmessages = Visitor::latest()->paginate(25);

        return view('Support.contact-messages', compact('contactmessages'));
    }

    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('contact-messages')->with('success', 'Contact enquiry deleted successfully.');
    }

    public function getvisitor()
    {
        $visitors = Visitor::latest()->get();

        return view('UserManagement.visitor', compact('visitors'));
    }
}
