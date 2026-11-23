<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id')->paginate(15);

        return view('SuperAdmin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('SuperAdmin.faq.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'answer' => ['required', 'string', 'max:10000'],
        ]);

        Faq::create($data);

        return redirect()->route('superadmin.cms.faq.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('SuperAdmin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:1000'],
            'answer' => ['required', 'string', 'max:10000'],
        ]);

        $faq->update($data);

        return redirect()->route('superadmin.cms.faq.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('superadmin.cms.faq.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}
