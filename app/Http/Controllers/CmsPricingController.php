<?php

namespace App\Http\Controllers;

use App\Models\CmsPricingPlan;
use App\Models\CmsPricingComparisonSetting;
use App\Models\CmsPricingSetting;
use Illuminate\Http\Request;

class CmsPricingController extends Controller
{
    public function index()
    {
        $settings = CmsPricingSetting::firstOrCreate([], [
            'main_heading' => 'The right plan to grow your',
            'main_heading_highlight' => 'jewellery business',
            'subheading' => "Everything you need to bill faster, manage inventory, and make smarter decisions.\nStart free—no credit card required.",
            'yearly_discount_badge' => 'Save up to 41%',
            'bottom_benefits' => [
                'No setup fee',
                'Free data migration',
                'Friendly onboarding support',
            ],
        ]);

        $plans = CmsPricingPlan::orderBy('sort_order', 'asc')->get();
        $comparisonPlans = $plans->where('is_active', true)->values();
        $comparisonSettings = CmsPricingComparisonSetting::firstOrCreate([], [
            'eyebrow' => 'COMPARE PLANS',
            'title' => 'Find your perfect fit',
            'description' => 'All plans cover the essentials. Choose based on your team and reporting needs.',
            'feature_heading' => 'Feature',
            'features' => [],
        ]);

        return view('SuperAdmin.cms.pricing.index', compact('settings', 'plans', 'comparisonPlans', 'comparisonSettings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'main_heading' => ['required', 'string', 'max:255'],
            'main_heading_highlight' => ['nullable', 'string', 'max:255'],
            'subheading' => ['nullable', 'string'],
            'yearly_discount_badge' => ['nullable', 'string', 'max:100'],
            'bottom_benefits' => ['nullable', 'array'],
            'bottom_benefits.*' => ['nullable', 'string', 'max:255'],
        ]);

        $settings = CmsPricingSetting::firstOrCreate([]);

        // Filter out empty benefit items
        $benefits = array_values(array_filter(array_map('trim', $request->input('bottom_benefits', []))));

        $settings->update([
            'main_heading' => $validated['main_heading'],
            'main_heading_highlight' => $validated['main_heading_highlight'] ?? '',
            'subheading' => $validated['subheading'] ?? '',
            'yearly_discount_badge' => $validated['yearly_discount_badge'] ?? '',
            'bottom_benefits' => $benefits,
        ]);

        return redirect()->route('superadmin.cms.pricing.index')
            ->with('success', 'Pricing section settings updated successfully.');
    }

    public function updateTrialSettings(Request $request)
    {
        $validated = $request->validate([
            'trial_eyebrow' => ['nullable', 'string', 'max:255'],
            'trial_title' => ['nullable', 'string', 'max:255'],
            'trial_description' => ['nullable', 'string'],
            'trial_features' => ['nullable', 'array'],
            'trial_features.*' => ['nullable', 'string', 'max:255'],
        ]);

        $trialFeatures = array_values(array_filter(array_map('trim', $validated['trial_features'] ?? [])));
        $settings = CmsPricingSetting::firstOrCreate([]);
        $settings->update([
            'trial_eyebrow' => $validated['trial_eyebrow'] ?? 'A LITTLE ROOM TO EXPLORE',
            'trial_title' => $validated['trial_title'] ?? 'Meet JewelERP for 30 days.',
            'trial_description' => $validated['trial_description'] ?? '',
            'trial_features' => $trialFeatures,
        ]);

        return redirect()->route('superadmin.cms.pricing.index')
            ->with('success', 'Trial banner settings updated successfully.');
    }

    public function updateComparisonSettings(Request $request)
    {
        $validated = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'feature_heading' => ['nullable', 'string', 'max:255'],
            'comparison_features' => ['nullable', 'array'],
            'comparison_features.*.label' => ['required', 'string', 'max:255'],
            'comparison_features.*.values' => ['nullable', 'array'],
            'comparison_features.*.values.*' => ['nullable', 'string', 'max:255'],
        ]);

        $features = array_values(array_map(function ($feature) {
            $values = array_filter(
                array_map('trim', $feature['values'] ?? []),
                function ($value) {
                    return $value !== '';
                }
            );

            return [
                'label' => trim($feature['label']),
                'values' => $values,
            ];
        }, $validated['comparison_features'] ?? []));

        $comparisonSettings = CmsPricingComparisonSetting::firstOrCreate([]);
        $comparisonSettings->update([
            'eyebrow' => $validated['eyebrow'] ?? 'COMPARE PLANS',
            'title' => $validated['title'] ?? 'Find your perfect fit',
            'description' => $validated['description'] ?? '',
            'feature_heading' => $validated['feature_heading'] ?? 'Feature',
            'features' => $features,
        ]);

        return redirect()->route('superadmin.cms.pricing.index', ['tab' => 'comparison'])
            ->with('success', 'Plan comparison settings updated successfully.');
    }

    public function storePlan(Request $request)
    {
        $data = $this->validateAndCalculatePlan($request);

        CmsPricingPlan::create($data);

        return redirect()->route('superadmin.cms.pricing.index')
            ->with('success', 'Pricing plan created successfully.');
    }

    public function updatePlan(Request $request, CmsPricingPlan $plan)
    {
        $data = $this->validateAndCalculatePlan($request, $plan->id);

        $plan->update($data);

        return redirect()->route('superadmin.cms.pricing.index')
            ->with('success', 'Pricing plan "' . $plan->name . '" updated successfully.');
    }

    public function destroyPlan(CmsPricingPlan $plan)
    {
        $planName = $plan->name;
        $plan->delete();

        return redirect()->route('superadmin.cms.pricing.index')
            ->with('success', 'Pricing plan "' . $planName . '" deleted successfully.');
    }

    protected function validateAndCalculatePlan(Request $request, $planId = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'plan_label' => ['nullable', 'string', 'max:150'],
            'is_featured' => ['nullable', 'boolean'],
            'popular_badge_text' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string'],

            // Monthly
            'monthly_cut_price' => ['required', 'numeric', 'min:0'],
            'monthly_discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'monthly_price' => ['nullable', 'numeric', 'min:0'],
            'monthly_savings' => ['nullable', 'numeric', 'min:0'],
            'monthly_billing_text' => ['nullable', 'string', 'max:100'],

            // Yearly
            'yearly_cut_price' => ['required', 'numeric', 'min:0'],
            'yearly_discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'yearly_price' => ['nullable', 'numeric', 'min:0'],
            'yearly_savings' => ['nullable', 'numeric', 'min:0'],
            'yearly_billing_text' => ['nullable', 'string', 'max:100'],

            // Common
            'currency_symbol' => ['nullable', 'string', 'max:10'],
            'button_text' => ['required', 'string', 'max:100'],
            'button_link' => ['required', 'string', 'max:255'],
            'trial_note' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:255'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $monthlyCutPrice = (float) $validated['monthly_cut_price'];
        $monthlyDiscount = isset($validated['monthly_discount']) ? (float) $validated['monthly_discount'] : 0.0;
        $monthlySavings = round(($monthlyCutPrice * $monthlyDiscount) / 100);
        $monthlyPrice = isset($validated['monthly_price']) && (float) $validated['monthly_price'] > 0
            ? (float) $validated['monthly_price']
            : max(0, $monthlyCutPrice - $monthlySavings);
        if ($monthlySavings <= 0 && $monthlyCutPrice > $monthlyPrice) {
            $monthlySavings = $monthlyCutPrice - $monthlyPrice;
        }

        $yearlyCutPrice = (float) $validated['yearly_cut_price'];
        $yearlyDiscount = isset($validated['yearly_discount']) ? (float) $validated['yearly_discount'] : 0.0;
        $yearlySavings = round(($yearlyCutPrice * $yearlyDiscount) / 100);
        $yearlyPrice = isset($validated['yearly_price']) && (float) $validated['yearly_price'] > 0
            ? (float) $validated['yearly_price']
            : max(0, $yearlyCutPrice - $yearlySavings);
        if ($yearlySavings <= 0 && $yearlyCutPrice > $yearlyPrice) {
            $yearlySavings = $yearlyCutPrice - $yearlyPrice;
        }

        // Clean features array (strip empties)
        $features = array_values(array_filter(array_map('trim', $request->input('features', []))));

        return [
            'name' => $validated['name'],
            'plan_label' => $validated['plan_label'] ?? '',
            'is_featured' => $request->boolean('is_featured'),
            'popular_badge_text' => $validated['popular_badge_text'] ?? 'MOST POPULAR',
            'description' => $validated['description'] ?? '',

            'monthly_price' => $monthlyPrice,
            'monthly_discount' => $monthlyDiscount,
            'monthly_cut_price' => $monthlyCutPrice,
            'monthly_savings' => $monthlySavings,
            'monthly_billing_text' => $validated['monthly_billing_text'] ?: 'Billed monthly',

            'yearly_price' => $yearlyPrice,
            'yearly_discount' => $yearlyDiscount,
            'yearly_cut_price' => $yearlyCutPrice,
            'yearly_savings' => $yearlySavings,
            'yearly_billing_text' => $validated['yearly_billing_text'] ?: 'Billed annually',

            'currency_symbol' => $validated['currency_symbol'] ?: '₹',
            'button_text' => $validated['button_text'],
            'button_link' => $validated['button_link'],
            'trial_note' => $validated['trial_note'] ?? '30 days free · Cancel anytime',
            'features' => $features,

            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
