<?php

namespace App\Providers;

use App\Models\CmsBanner;
use App\Models\CmsSolution;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
