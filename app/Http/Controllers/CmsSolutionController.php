<?php

namespace App\Http\Controllers;

use App\Models\CmsSolution;
use Illuminate\Http\Request;

class CmsSolutionController extends Controller
{
    public function index()
    {
        $solutions = CmsSolution::orderBy('sort_order')->orderBy('id')->paginate(15);

        return view('SuperAdmin.cms.solutions.index', compact('solutions'));
    }

    public function create()
    {
        return view('SuperAdmin.cms.solutions.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['is_active'] = $request->boolean('is_active');

        CmsSolution::create($data);

        return redirect()->route('superadmin.cms.solutions.index')
            ->with('success', 'Solution created successfully.');
    }

    public function edit(CmsSolution $solution)
    {
        return view('SuperAdmin.cms.solutions.edit', compact('solution'));
    }

    public function update(Request $request, CmsSolution $solution)
    {
        $data = $this->validatedData($request);
        $data['is_active'] = $request->boolean('is_active');

        $solution->update($data);

        return redirect()->route('superadmin.cms.solutions.index')
            ->with('success', 'Solution updated successfully.');
    }

    public function destroy(CmsSolution $solution)
    {
        $solution->delete();

        return redirect()->route('superadmin.cms.solutions.index')
            ->with('success', 'Solution deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'home_description' => ['required', 'string', 'max:1000'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'url' => [
                'required',
                'string',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $isLocalPath = strpos($value, '/') === 0 && strpos($value, '//') !== 0;
                    $isHttpUrl = filter_var($value, FILTER_VALIDATE_URL)
                        && in_array(parse_url($value, PHP_URL_SCHEME), ['http', 'https'], true);

                    if (!$isLocalPath && !$isHttpUrl) {
                        $fail('The destination must be a site path or an HTTP(S) URL.');
                    }
                },
            ],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ]);
    }
}
