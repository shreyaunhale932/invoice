<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('id')->paginate(15);

        return view('SuperAdmin.cms.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('SuperAdmin.cms.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:10000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'name' => ['required', 'string', 'max:255'],
            'short_detail' => ['required', 'string', 'max:255'],
        ]);

        Testimonial::create($data);

        return redirect()->route('superadmin.cms.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('SuperAdmin.cms.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:10000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'name' => ['required', 'string', 'max:255'],
            'short_detail' => ['required', 'string', 'max:255'],
        ]);

        $testimonial->update($data);

        return redirect()->route('superadmin.cms.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('superadmin.cms.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
