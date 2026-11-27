<?php

namespace App\Http\Controllers;

use App\Models\CmsInvoiceSolutionPage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

class CmsInvoiceSolutionPageController extends Controller
{
    public function edit()
    {
        $page = $this->page();
        $defaults = CmsInvoiceSolutionPage::defaultContent();
        $content = array_replace_recursive(
            $defaults,
            Arr::only($page->content ?? [], array_keys($defaults))
        );

        return view('SuperAdmin.cms.invoice-solution.edit', [
            'content' => $content,
        ]);
    }

    public function update(Request $request)
    {
        $page = $this->page();
        $rules = [
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'dashboard_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];

        foreach (Arr::dot(CmsInvoiceSolutionPage::defaultContent()) as $field => $value) {
            if (in_array($field, ['hero.image', 'dashboard.image'], true)) {
                continue;
            }

            $rules['content.' . $field] = ['required', 'string', 'max:2000'];
        }

        $validated = $request->validate($rules);
        $defaults = CmsInvoiceSolutionPage::defaultContent();
        $content = array_replace_recursive(
            $defaults,
            Arr::only($page->content ?? [], array_keys($defaults))
        );
        $content = array_replace_recursive(
            $content,
            $validated['content']
        );

        foreach (['hero_image' => 'hero', 'dashboard_image' => 'dashboard'] as $field => $section) {
            if ($request->hasFile($field)) {
                $content[$section]['image'] = $this->storeImage($request->file($field), $section);
            }
        }

        $page->content = $content;
        $page->save();

        return redirect()->route('superadmin.cms.invoice-solution.edit')
            ->with('success', 'Invoice & Solution page updated successfully.');
    }

    private function page(): CmsInvoiceSolutionPage
    {
        return CmsInvoiceSolutionPage::firstOrCreate(
            [],
            ['content' => CmsInvoiceSolutionPage::defaultContent()]
        );
    }

    private function storeImage(UploadedFile $file, string $section): string
    {
        $directory = public_path('front_assets/img/cms/invoice-solution');
        File::ensureDirectoryExists($directory);

        $filename = $section . '-' . Str::uuid() . '.jpg';
        $path = $directory . DIRECTORY_SEPARATOR . $filename;
        $manager = new ImageManager(new GdDriver());
        $manager->read($file->getPathname())
            ->cover(1320, 626)
            ->toJpeg(90)
            ->save($path);

        return 'front_assets/img/cms/invoice-solution/' . $filename;
    }
}
