<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\CmsBanner;
use App\Models\CmsSeoPage;
use App\Models\CmsSolution;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('invoice_front.includes.header', function ($view) {
            $route = request()->route();
            $routeName = $route?->getName();

            if (in_array($routeName, ['blogdetails', 'blogdetails.show'], true)) {
                $blog = $route?->parameter('blog');
                if (!$blog instanceof BlogPost) {
                    $blog = $blog
                        ? BlogPost::find($blog)
                        : BlogPost::orderByDesc('date')->orderByDesc('id')->first();
                }

                $pageSeo = $blog ? (object) [
                    'title' => $blog->seo_title ?: $blog->heading,
                    'description' => $blog->seo_description ?: Str::limit(
                        trim(strip_tags($blog->content1)),
                        160
                    ),
                    'keywords' => $blog->seo_keywords,
                    'canonical_url' => $blog->seo_canonical_url ?: route('blogdetails.show', $blog),
                ] : null;
            } else {
                $pageKey = [
                    'invoice-front' => 'home',
                    'pricing' => 'pricing',
                    'videos' => 'videos',
                    'contact' => 'contact',
                    'FAQS' => 'faqs',
                    'integration' => 'integration',
                    'invoiceandsolution' => 'invoice-solution',
                    'purchasemanagement' => 'purchase-management',
                    'karigarandjobwork' => 'karigar-job-work',
                    'barcodeandrfidtagging' => 'barcode-rfid',
                    'discountandschememanagement' => 'discount-scheme',
                    'realtimemisreport' => 'real-time-mis',
                    'multibranchmanagement' => 'multi-branch',
                    'oldgoldexchange' => 'old-gold-exchange',
                    'inventorymanagement' => 'inventory-management',
                ][$routeName ?? ''] ?? null;

                $pageSeo = $pageKey ? CmsSeoPage::where('page_key', $pageKey)->first() : null;
            }

            $view->with('pageSeo', $pageSeo);
        });

        View::composer('invoice_front.includes.ai-tools', function ($view) {
            $view->with('aiToolsContent', CmsBanner::first());
        });

        View::composer([
            'invoice_front.includes.navbar',
            'invoice_front.index',
            'invoice_front11.index',
        ], function ($view) {
            $view->with(
                'cmsSolutions',
                CmsSolution::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get()
            );
        });

    }
}
