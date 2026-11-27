<?php

namespace App\Http\Controllers;

use App\Models\CmsSeoPage;
use Illuminate\Http\Request;

class CmsSeoPageController extends Controller
{
    public function index()
    {
        $seoPages = CmsSeoPage::orderBy('id')->get();
        $requestedPage = request()->query('tab');
        $activePage = $seoPages->contains('page_key', $requestedPage)
            ? $requestedPage
            : $seoPages->first()?->page_key;

        return view('SuperAdmin.cms.seo.index', compact('seoPages', 'activePage'));
    }

    public function update(Request $request, string $page)
    {
        $seoPage = CmsSeoPage::where('page_key', $page)->firstOrFail();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'keywords' => ['nullable', 'string', 'max:10000'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
        ]);

        $seoPage->update($data);

        return redirect()->route('superadmin.cms.seo.index', ['tab' => $seoPage->page_key])
            ->with('success', $seoPage->page_name . ' SEO settings updated successfully.');
    }
}
