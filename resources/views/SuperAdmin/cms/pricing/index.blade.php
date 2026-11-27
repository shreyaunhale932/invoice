<?php $page = 'cms'; ?>
@extends('layout.mainlayout')

@section('content')
<style>
/* Robust Modal Scroller Styles */
#planModal .modal-dialog,
#sectionModal .modal-dialog,
#trialModal .modal-dialog {
    max-height: 92vh;
    margin: 1.5rem auto;
}
#planModal .modal-content,
#sectionModal .modal-content,
#trialModal .modal-content {
    max-height: 92vh;
    height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
#planModal .modal-header,
#sectionModal .modal-header,
#trialModal .modal-header {
    flex-shrink: 0;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
}
#planModal .modal-body,
#sectionModal .modal-body,
#trialModal .modal-body {
    flex: 1 1 auto;
    overflow-y: scroll !important;
    padding: 1.5rem;
    scrollbar-width: thin;
    scrollbar-color: #0d6efd #e9ecef;
}
#planModal .modal-body::-webkit-scrollbar,
#sectionModal .modal-body::-webkit-scrollbar,
#trialModal .modal-body::-webkit-scrollbar {
    width: 10px;
}
#planModal .modal-body::-webkit-scrollbar-track,
#sectionModal .modal-body::-webkit-scrollbar-track,
#trialModal .modal-body::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 5px;
}
#planModal .modal-body::-webkit-scrollbar-thumb,
#sectionModal .modal-body::-webkit-scrollbar-thumb,
#trialModal .modal-body::-webkit-scrollbar-thumb {
    background: #0d6efd;
    border-radius: 5px;
    border: 2px solid #e9ecef;
}
#planModal .modal-body::-webkit-scrollbar-thumb:hover,
#sectionModal .modal-body::-webkit-scrollbar-thumb:hover,
#trialModal .modal-body::-webkit-scrollbar-thumb:hover {
    background: #0b5ed7;
}
#planModal .modal-footer,
#sectionModal .modal-footer,
#trialModal .modal-footer {
    flex-shrink: 0;
    padding: 1rem 1.5rem;
    border-top: 1px solid #dee2e6;
    background-color: #f8f9fa;
}
.feature-badge-point {
    min-width: 90px;
    font-size: 0.82rem;
}
</style>

    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="content-page-header mb-0">
                    <h5 class="mb-1">Pricing Plans CMS</h5>
                    <p class="text-muted small mb-0">Manage "The right plan to grow your jewellery business" section, plan cards, prices, discounts, and features.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sectionModal">
                        <i class="fe fe-edit-3 me-1"></i>Edit Section Heading & Content
                    </button> -->
                    <!-- <button type="button" class="btn btn-primary" onclick="openCreatePlanModal()">
                        <i class="fe fe-plus me-1"></i>Add New Plan
                    </button> -->
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fe fe-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please check the errors below:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Section Overview Card -->
            <div class="card bg-white mb-4 border">
                <div class="card-header bg-light d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fe fe-layout text-primary fs-5"></i>
                        <h6 class="card-title mb-0">Hero Section Heading & Highlights</h6>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#sectionModal">
                        <i class="fe fe-edit me-1"></i>Edit Section
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-semibold">MAIN HEADING</label>
                            <h5 class="fw-bold mb-1">
                                {{ $settings->main_heading }}
                                <span class="text-warning">{{ $settings->main_heading_highlight }}</span>
                            </h5>
                            <p class="text-muted mb-0 small">{!! nl2br(e($settings->subheading)) !!}</p>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-semibold">YEARLY DISCOUNT BADGE</label>
                            <div>
                                <span class="badge bg-success-light text-success fs-6 px-3 py-2">
                                    {{ $settings->yearly_discount_badge ?: 'Save up to 41%' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small fw-semibold">BOTTOM BENEFITS</label>
                            <ul class="list-unstyled mb-0 small">
                                @if(is_array($settings->bottom_benefits))
                                    @foreach($settings->bottom_benefits as $benefit)
                                        <li class="mb-1 text-dark"><i class="fe fe-check text-success me-1"></i>{{ $benefit }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Trial Banner Overview Card -->
            <div class="card bg-white mb-4 border">
                <div class="card-header bg-light d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fe fe-star text-primary fs-5"></i>
                        <h6 class="card-title mb-0">Trial Banner</h6>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#trialModal">
                        <i class="fe fe-edit me-1"></i>Edit Trial Banner
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small fw-semibold">BANNER CONTENT</label>
                            <p class="mb-0 small text-uppercase text-primary fw-bold">{{ $settings->trial_eyebrow ?? 'A LITTLE ROOM TO EXPLORE' }}</p>
                            <h6 class="fw-bold mb-1">{{ $settings->trial_title ?? 'Meet JewelERP for 30 days.' }}</h6>
                            <p class="text-muted mb-0 small">{{ $settings->trial_description ?? 'Try Professional with sample data—no credit card required.' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small fw-semibold">TRIAL FEATURES</label>
                            <ul class="list-unstyled mb-0 small">
                                @php
                                    $trialFeats = $settings->trial_features ?? ['Full Professional features', '1 branch · 3 users', 'Up to 500 products', 'Onboarding assistance'];
                                @endphp
                                @if(is_array($trialFeats))
                                    @foreach($trialFeats as $tf)
                                        <li class="mb-1 text-dark"><i class="fe fe-check text-success me-1"></i>{{ $tf }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="pricingCmsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pricing-plans-tab" data-bs-toggle="tab" data-bs-target="#pricing-plans-pane" type="button" role="tab" aria-controls="pricing-plans-pane" aria-selected="true">
                        Pricing Plans
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="comparison-tab" data-bs-toggle="tab" data-bs-target="#comparison-pane" type="button" role="tab" aria-controls="comparison-pane" aria-selected="false">
                        Plan Comparison
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pricingCmsTabContent">
                <div class="tab-pane fade show active" id="pricing-plans-pane" role="tabpanel" aria-labelledby="pricing-plans-tab">
            <!-- Pricing Plans Cards / Table -->
            <div class="card bg-white border">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Plans List ({{ $plans->count() }})</h5>
                        <small class="text-muted">Cards are rendered on the frontend in the specified order.</small>
                    </div>
                    <!-- <button type="button" class="btn btn-primary btn-sm" onclick="openCreatePlanModal()">
                        <i class="fe fe-plus me-1"></i>Add Plan
                    </button> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">Order</th>
                                    <th>Plan Name & Small Heading</th>
                                    <th>Monthly Billing</th>
                                    <th>Yearly Billing</th>
                                    <th>Features Included</th>
                                    <th>Status</th>
                                    <th class="text-end" style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $plan->sort_order }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div>
                                                    <h6 class="mb-0 fw-bold">{{ $plan->name }}</h6>
                                                    <small class="text-muted">{{ $plan->plan_label }}</small>
                                                </div>
                                                @if($plan->is_featured)
                                                    <span class="badge bg-primary text-white ms-1">{{ $plan->popular_badge_text ?: 'FEATURED' }}</span>
                                                @endif
                                            </div>
                                            <div class="small text-muted mt-1" style="max-width: 260px;">
                                                {{ Str::limit($plan->description, 60) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong class="text-dark">{{ $plan->currency_symbol }}{{ number_format($plan->monthly_price) }}</strong>
                                                <small class="text-muted">/ mo</small>
                                                @if($plan->monthly_cut_price > $plan->monthly_price)
                                                    <del class="fw-bold ms-1" style="color: #dc3545 !important; font-size: 0.85rem;">{{ $plan->currency_symbol }}{{ number_format($plan->monthly_cut_price) }}</del>
                                                @endif
                                            </div>
                                            <div class="small mt-1">
                                                <span class="badge bg-info-light text-info">{{ (int)$plan->monthly_discount }}% OFF</span>
                                                <span class="text-success ms-1 fw-semibold">Save {{ $plan->currency_symbol }}{{ number_format($plan->monthly_savings) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong class="text-dark">{{ $plan->currency_symbol }}{{ number_format($plan->yearly_price) }}</strong>
                                                <small class="text-muted">/ yr</small>
                                                @if($plan->yearly_cut_price > $plan->yearly_price)
                                                    <del class="fw-bold ms-1" style="color: #dc3545 !important; font-size: 0.85rem;">{{ $plan->currency_symbol }}{{ number_format($plan->yearly_cut_price) }}</del>
                                                @endif
                                            </div>
                                            <div class="small mt-1">
                                                <span class="badge bg-success-light text-success">{{ (int)$plan->yearly_discount }}% OFF</span>
                                                <span class="text-success ms-1 fw-semibold">Save {{ $plan->currency_symbol }}{{ number_format($plan->yearly_savings) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border">
                                                {{ is_array($plan->features) ? count($plan->features) : 0 }} points
                                            </span>
                                            @if(is_array($plan->features) && count($plan->features) > 0)
                                                <ul class="list-unstyled mb-0 mt-1 small text-muted" style="max-width: 220px;">
                                                    @foreach(array_slice($plan->features, 0, 2) as $f)
                                                        <li>• {{ Str::limit($f, 30) }}</li>
                                                    @endforeach
                                                    @if(count($plan->features) > 2)
                                                        <li><small class="text-primary">+{{ count($plan->features) - 2 }} more...</small></li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $plan->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $plan->is_active ? 'Active' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                                onclick='openEditPlanModal(@json($plan))'>
                                                <i class="fe fe-edit-2"></i> Edit
                                            </button>
                                            <form action="{{ route('superadmin.cms.pricing.plan.destroy', $plan) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete the plan \'{{ $plan->name }}\'?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fe fe-trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fe fe-info fs-3 d-block mb-2"></i>
                                            No pricing plans created yet. Click "Add New Plan" to get started.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                </div>
                <div class="tab-pane fade" id="comparison-pane" role="tabpanel" aria-labelledby="comparison-tab">
                    <form class="card bg-white border" method="POST" action="{{ route('superadmin.cms.pricing.comparison.update', ['tab' => 'comparison']) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-1">Plan Comparison Content</h5>
                            <small class="text-muted">Edit the public comparison heading and feature values. Columns follow active pricing plans.</small>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Eyebrow</label>
                                    <input type="text" name="eyebrow" class="form-control" value="{{ old('eyebrow', $comparisonSettings->eyebrow) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Heading</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $comparisonSettings->title) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Feature Column Label</label>
                                    <input type="text" name="feature_heading" class="form-control" value="{{ old('feature_heading', $comparisonSettings->feature_heading) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control" rows="2">{{ old('description', $comparisonSettings->description) }}</textarea>
                                </div>
                            </div>

                            @php
                                $comparisonFeatures = old('comparison_features', $comparisonSettings->features ?? []);
                            @endphp
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="fw-bold mb-0">Comparison Features</h6>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="addComparisonFeatureRow()">
                                    <i class="fe fe-plus me-1"></i>Add Feature
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="min-width: 220px;">{{ $comparisonSettings->feature_heading }}</th>
                                            @foreach($comparisonPlans as $comparisonPlan)
                                                <th data-plan-id="{{ $comparisonPlan->id }}" style="min-width: 160px;">{{ $comparisonPlan->name }}</th>
                                            @endforeach
                                            <th style="width: 70px;">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="comparisonFeaturesBody">
                                        @foreach($comparisonFeatures as $featureIndex => $comparisonFeature)
                                            <tr class="comparison-feature-row" data-index="{{ $featureIndex }}">
                                                <th scope="row">
                                                    <input type="text" name="comparison_features[{{ $featureIndex }}][label]" class="form-control" value="{{ $comparisonFeature['label'] ?? '' }}" required>
                                                </th>
                                                @foreach($comparisonPlans as $comparisonPlan)
                                                    <td>
                                                        <input type="text" name="comparison_features[{{ $featureIndex }}][values][{{ $comparisonPlan->id }}]" class="form-control"
                                                            value="{{ $comparisonFeature['values'][$comparisonPlan->id] ?? $comparisonFeature['values'][Str::slug($comparisonPlan->name)] ?? '' }}">
                                                    </td>
                                                @endforeach
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeComparisonFeatureRow(this)" aria-label="Remove feature">
                                                        <i class="fe fe-trash-2"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fe fe-check me-1"></i>Save Comparison
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL 1: EDIT SECTION CONTENT -->
    <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form class="modal-content" method="POST" action="{{ route('superadmin.cms.pricing.settings.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header bg-light d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="sectionModalLabel">
                        <i class="fe fe-layout me-1 text-primary"></i> Edit Pricing Section Content
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fe fe-check me-1"></i> Save Section
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label fw-bold">Main Heading Text</label>
                            <input type="text" name="main_heading" class="form-control"
                                value="{{ old('main_heading', $settings->main_heading) }}" required>
                            <div class="form-text">e.g. "The right plan to grow your"</div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Highlighted Text (Golden/Span)</label>
                            <input type="text" name="main_heading_highlight" class="form-control"
                                value="{{ old('main_heading_highlight', $settings->main_heading_highlight) }}">
                            <div class="form-text">e.g. "jewellery business"</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Subheading / Description</label>
                            <textarea name="subheading" class="form-control" rows="3">{{ old('subheading', $settings->subheading) }}</textarea>
                            <div class="form-text">Shown directly under the main heading.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Yearly Toggle Badge Text</label>
                            <input type="text" name="yearly_discount_badge" class="form-control"
                                value="{{ old('yearly_discount_badge', $settings->yearly_discount_badge) }}">
                            <div class="form-text">e.g. "Save up to 41%"</div>
                        </div>

                        <!-- Bottom Benefits Repeater -->
                        <div class="col-12 mt-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label fw-bold mb-0">Bottom Benefits Points</label>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="addBenefitField()">
                                    <i class="fe fe-plus me-1"></i>Add Benefit
                                </button>
                            </div>
                            <div id="bottomBenefitsContainer">
                                @php
                                    $currentBenefits = old('bottom_benefits', $settings->bottom_benefits ?: []);
                                @endphp
                                @forelse($currentBenefits as $b)
                                    <div class="input-group mb-2 benefit-row">
                                        <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
                                        <input type="text" name="bottom_benefits[]" class="form-control" value="{{ $b }}" placeholder="Benefit text">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeBenefitField(this)">
                                            <i class="fe fe-trash-2"></i>
                                        </button>
                                    </div>
                                @empty
                                    <div class="input-group mb-2 benefit-row">
                                        <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
                                        <input type="text" name="bottom_benefits[]" class="form-control" value="No setup fee" placeholder="Benefit text">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeBenefitField(this)">
                                            <i class="fe fe-trash-2"></i>
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                            <div class="form-text">These points appear at the bottom of the pricing plans section.</div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fe fe-check me-1"></i> Save Section Content
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 2: EDIT TRIAL BANNER -->
    <div class="modal fade" id="trialModal" tabindex="-1" aria-labelledby="trialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form class="modal-content" method="POST" action="{{ route('superadmin.cms.pricing.trial.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header bg-light d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="trialModalLabel">
                        <i class="fe fe-star me-1 text-primary"></i> Edit Trial Banner
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Eyebrow Text (Small Heading)</label>
                            <input type="text" name="trial_eyebrow" class="form-control"
                                value="{{ old('trial_eyebrow', $settings->trial_eyebrow ?? 'A LITTLE ROOM TO EXPLORE') }}" placeholder="A LITTLE ROOM TO EXPLORE">
                            <div class="form-text">Small uppercase text above the main title.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Main Title</label>
                            <input type="text" name="trial_title" class="form-control"
                                value="{{ old('trial_title', $settings->trial_title ?? 'Meet JewelERP for 30 days.') }}" placeholder="Meet JewelERP for 30 days.">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="trial_description" class="form-control" rows="2" placeholder="Try Professional with sample data—no credit card required.">{{ old('trial_description', $settings->trial_description ?? 'Try Professional with sample data—no credit card required.') }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label fw-bold mb-0">Trial Banner Feature Points</label>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="addTrialFeatureField()">
                                    <i class="fe fe-plus me-1"></i>Add Feature
                                </button>
                            </div>
                            <div id="trialFeaturesContainer">
                                @php
                                    $currentTrialFeatures = old('trial_features', $settings->trial_features ?: [
                                        'Full Professional features',
                                        '1 branch · 3 users',
                                        'Up to 500 products',
                                        'Onboarding assistance',
                                    ]);
                                @endphp
                                @forelse($currentTrialFeatures as $tf)
                                    <div class="input-group mb-2 trial-feature-row">
                                        <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
                                        <input type="text" name="trial_features[]" class="form-control" value="{{ $tf }}" placeholder="Feature text">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeTrialFeatureField(this)">
                                            <i class="fe fe-trash-2"></i>
                                        </button>
                                    </div>
                                @empty
                                    <div class="input-group mb-2 trial-feature-row">
                                        <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
                                        <input type="text" name="trial_features[]" class="form-control" value="" placeholder="Feature text">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeTrialFeatureField(this)">
                                            <i class="fe fe-trash-2"></i>
                                        </button>
                                    </div>
                                @endforelse
                            </div>
                            <div class="form-text">These points appear on the right side of the trial banner.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fe fe-check me-1"></i> Save Trial Banner
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: ADD / EDIT PRICING PLAN -->
    <div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form id="planForm" class="modal-content" method="POST" action="{{ route('superadmin.cms.pricing.plan.store') }}">
                @csrf
                <input type="hidden" name="_method" id="planFormMethod" value="POST">

                <div class="modal-header bg-light d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="planModalLabel">
                        <i class="fe fe-package me-1 text-primary"></i> <span id="modalModeTitle">Add New Plan</span>
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <!-- <button type="submit" class="btn btn-primary btn-sm savePlanSubmitBtn">
                            <i class="fe fe-check me-1"></i> <span class="savePlanBtnText">Save Plan</span>
                        </button> -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body p-4">

                    <!-- Plan Quick Navigation Pills -->
                    <div class="d-flex align-items-center gap-2 mb-3 p-2 bg-light rounded border">
                        <span class="small fw-bold text-muted me-1">Jump to:</span>
                        <a href="#sectionBasicInfo" class="badge bg-white text-dark border px-2 py-1 text-decoration-none">
                            <i class="fe fe-info me-1"></i>Basic Info
                        </a>
                        <a href="#sectionPricingCalc" class="badge bg-white text-dark border px-2 py-1 text-decoration-none">
                            <i class="fe fe-dollar-sign me-1"></i>Pricing & Calculator
                        </a>
                        <a href="#sectionButtonTrial" class="badge bg-white text-dark border px-2 py-1 text-decoration-none">
                            <i class="fe fe-link me-1"></i>Button & Note
                        </a>
                        <a href="#sectionFeaturesList" class="badge bg-primary text-white px-2 py-1 text-decoration-none">
                            <i class="fe fe-check-square me-1"></i>What's Included Features ↓
                        </a>
                    </div>

                    <!-- Top details: Name, Label, Sort, Status -->
                    <div class="row g-3 mb-4" id="sectionBasicInfo">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Plan Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="plan_name" class="form-control" required placeholder="e.g. Basic, Pro, Premium">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Small Heading / Label</label>
                            <input type="text" name="plan_label" id="plan_label" class="form-control" placeholder="e.g. For small jewellery shops">
                            <div class="form-text">Appears above the plan name.</div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" id="plan_sort_order" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Active Status</label>
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="plan_is_active" value="1" checked onchange="updateActiveStatusLabel()">
                                <label class="form-check-label fw-bold" for="plan_is_active" id="plan_is_active_label">Active (Visible)</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Short Description</label>
                            <textarea name="description" id="plan_description" class="form-control" rows="2"
                                placeholder="e.g. Essential billing and inventory tools to run your jewellery store with confidence."></textarea>
                        </div>

                        <!-- Featured / Popular badge -->
                        <div class="col-md-4">
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="is_featured" value="0">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="plan_is_featured" value="1" onchange="toggleFeaturedBadgeInput()">
                                <label class="form-check-label fw-bold" for="plan_is_featured">Is Featured / Most Popular?</label>
                            </div>
                        </div>
                        <div class="col-md-4" id="badgeTextWrapper">
                            <label class="form-label fw-bold">Popular Badge Text</label>
                            <input type="text" name="popular_badge_text" id="plan_popular_badge_text" class="form-control" value="MOST POPULAR" placeholder="MOST POPULAR">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Currency Symbol</label>
                            <input type="text" name="currency_symbol" id="plan_currency_symbol" class="form-control" value="₹">
                        </div>
                    </div>

                    <!-- PRICING CALCULATOR SECTION -->
                    <div class="card border mb-4" id="sectionPricingCalc">
                        <div class="card-header bg-light d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fe fe-dollar-sign text-primary"></i>
                                <h6 class="mb-0 fw-bold">Pricing, Cut Price & Discount Calculator</h6>
                            </div>
                            <span class="badge bg-primary-light text-primary small">
                                <i class="fe fe-zap me-1"></i>Auto-Calculates Cut Price & Save Price
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <!-- Monthly Billing Column -->
                                <div class="col-lg-6 border-end-lg">
                                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                        <h6 class="fw-bold text-primary mb-0"><i class="fe fe-calendar me-1"></i> Monthly Billing</h6>
                                        <span class="badge bg-light text-dark border">/ month</span>
                                    </div>

                                    <div class="row g-2">
                                        <!-- 1. Cut Price (Original Price) - TOP LEFT -->
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-dark">
                                                <i class="fe fe-tag me-1 text-danger"></i> Cut Price (Original) <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-success text-dark fw-bold">₹</span>
                                                <input type="number" step="any" name="monthly_cut_price" id="monthly_cut_price"
                                                    class="form-control text-dark fw-bold border-success" required placeholder="e.g. 3000"
                                                    oninput="calculatePricing('monthly')" style="color: #111827 !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-dark fw-semibold">Base / MRP price before discount.</div>
                                        </div>

                                        <!-- 2. Discount Off (%) - TOP RIGHT -->
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-dark">
                                                <i class="fe fe-percent me-1 text-success"></i> Discount (% OFF)
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="any" name="monthly_discount" id="monthly_discount"
                                                    class="form-control text-success fw-bold border-success" placeholder="e.g. 16"
                                                    oninput="calculatePricing('monthly')" style="font-weight: 700; font-size: 0.95rem;">
                                                <span class="input-group-text bg-success-light text-success fw-bold">% OFF</span>
                                            </div>
                                            <div class="form-text small text-muted">Discount percentage.</div>
                                        </div>

                                        <!-- 3. Main Price (Selling Price - Auto calculated) - BOTTOM LEFT -->
                                        <div class="col-6 mt-2">
                                            <label class="form-label fw-bold small text-primary">
                                                <i class="fe fe-check-circle me-1"></i> Main Price (Selling) <span class="badge bg-primary text-white ms-1" style="font-size: 0.65rem;">AUTO</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-primary-light text-primary fw-bold">₹</span>
                                                <input type="number" step="any" name="monthly_price" id="monthly_price"
                                                    class="form-control fw-bold text-primary bg-light border-primary" required placeholder="Auto calculated"
                                                    oninput="calcFromSelling('monthly')" style="color: #0d6efd !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-primary fw-semibold">Selling price user pays.</div>
                                        </div>

                                        <!-- 4. Save Price (Amount - Auto calculated) - BOTTOM RIGHT -->
                                        <div class="col-6 mt-2">
                                            <label class="form-label fw-bold small text-success">
                                                <i class="fe fe-dollar-sign me-1"></i> Save Price (Amount) <span class="badge bg-success text-white ms-1" style="font-size: 0.65rem;">AUTO</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-success-light text-success fw-bold">₹</span>
                                                <input type="number" step="any" name="monthly_savings" id="monthly_savings"
                                                    class="form-control text-success fw-bold bg-light border-success" placeholder="Auto calculated" readonly
                                                    style="color: #198754 !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-success fw-semibold">Cut Price minus Main Price.</div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label class="form-label small text-muted mb-1">Billing Text</label>
                                            <input type="text" name="monthly_billing_text" id="monthly_billing_text"
                                                class="form-control form-control-sm" value="Billed monthly">
                                        </div>

                                        <!-- Live Preview Box -->
                                        <div class="col-12 mt-2">
                                            <div class="p-2 rounded bg-light border text-center small" id="monthlyPreviewBadge">
                                                Preview: <del class="text-danger fw-bold">₹3,000</del> → <strong class="text-primary">₹2,520</strong>
                                                <span class="badge bg-success-light text-success ms-1">16% OFF</span>
                                                <span class="text-success ms-1">You Save ₹480</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Yearly Billing Column -->
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                        <h6 class="fw-bold text-success mb-0"><i class="fe fe-calendar me-1"></i> Yearly Billing</h6>
                                        <span class="badge bg-light text-dark border">/ year</span>
                                    </div>

                                    <div class="row g-2">
                                        <!-- 1. Cut Price (Original Price) - TOP LEFT -->
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-dark">
                                                <i class="fe fe-tag me-1 text-danger"></i> Cut Price (Original) <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-success text-dark fw-bold">₹</span>
                                                <input type="number" step="any" name="yearly_cut_price" id="yearly_cut_price"
                                                    class="form-control text-dark fw-bold border-success" required placeholder="e.g. 50000"
                                                    oninput="calculatePricing('yearly')" style="color: #111827 !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-dark fw-semibold">Base / MRP price before discount.</div>
                                        </div>

                                        <!-- 2. Discount Off (%) - TOP RIGHT -->
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-dark">
                                                <i class="fe fe-percent me-1 text-success"></i> Discount (% OFF)
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" step="any" name="yearly_discount" id="yearly_discount"
                                                    class="form-control text-success fw-bold border-success" placeholder="e.g. 41"
                                                    oninput="calculatePricing('yearly')" style="font-weight: 700; font-size: 0.95rem;">
                                                <span class="input-group-text bg-success-light text-success fw-bold">% OFF</span>
                                            </div>
                                            <div class="form-text small text-muted">Discount percentage.</div>
                                        </div>

                                        <!-- 3. Main Price (Selling Price - Auto calculated) - BOTTOM LEFT -->
                                        <div class="col-6 mt-2">
                                            <label class="form-label fw-bold small text-success">
                                                <i class="fe fe-check-circle me-1"></i> Main Price (Selling) <span class="badge bg-success text-white ms-1" style="font-size: 0.65rem;">AUTO</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-success-light text-success fw-bold">₹</span>
                                                <input type="number" step="any" name="yearly_price" id="yearly_price"
                                                    class="form-control fw-bold text-success bg-light border-success" required placeholder="Auto calculated"
                                                    oninput="calcFromSelling('yearly')" style="color: #198754 !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-success fw-semibold">Selling price user pays per year.</div>
                                        </div>

                                        <!-- 4. Save Price (Amount - Auto calculated) - BOTTOM RIGHT -->
                                        <div class="col-6 mt-2">
                                            <label class="form-label fw-bold small text-success">
                                                <i class="fe fe-dollar-sign me-1"></i> Save Price (Amount) <span class="badge bg-success text-white ms-1" style="font-size: 0.65rem;">AUTO</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-success-light text-success fw-bold">₹</span>
                                                <input type="number" step="any" name="yearly_savings" id="yearly_savings"
                                                    class="form-control text-success fw-bold bg-light border-success" placeholder="Auto calculated" readonly
                                                    style="color: #198754 !important; font-weight: 700; font-size: 0.95rem;">
                                            </div>
                                            <div class="form-text small text-success fw-semibold">Cut Price minus Main Price.</div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label class="form-label small text-muted mb-1">Billing Text</label>
                                            <input type="text" name="yearly_billing_text" id="yearly_billing_text"
                                                class="form-control form-control-sm" value="Billed annually">
                                        </div>

                                        <!-- Live Preview Box -->
                                        <div class="col-12 mt-2">
                                            <div class="p-2 rounded bg-light border text-center small" id="yearlyPreviewBadge">
                                                Preview: <del class="text-danger fw-bold">₹50,000</del> → <strong class="text-success">₹29,500</strong>
                                                <span class="badge bg-success-light text-success ms-1">41% OFF</span>
                                                <span class="text-success ms-1">You Save ₹20,500</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON & TRIAL SECTION -->
                    <div class="row g-3 mb-4" id="sectionButtonTrial">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Text on Button <span class="text-danger">*</span></label>
                            <input type="text" name="button_text" id="plan_button_text" class="form-control" required
                                placeholder="e.g. Start free trial, Start 30-day free trial, Choose Premium">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Button Link / Modal Target <span class="text-danger">*</span></label>
                            <input type="text" name="button_link" id="plan_button_link" class="form-control" required
                                value="#jewelSignupModal" placeholder="#jewelSignupModal or URL">
                            <div class="form-text">Use <code>#jewelSignupModal</code> to open trial signup modal.</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Trial Note Under Button</label>
                            <input type="text" name="trial_note" id="plan_trial_note" class="form-control"
                                value="30 days free · Cancel anytime" placeholder="30 days free · Cancel anytime">
                            <div class="form-text">e.g. "30 days free · Cancel anytime"</div>
                        </div>
                    </div>

                    <!-- WHAT'S INCLUDED: DYNAMIC ADD / EDIT / DELETE REPEATER -->
                    <div class="card border border-primary shadow-sm mb-3" id="sectionFeaturesList">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h6 class="mb-0 fw-bold text-white"><i class="fe fe-check-square me-1"></i> What's Included Features</h6>
                                <small class="text-white-50">Points shown on the plan card. You can add, edit, or delete multiple points.</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-light text-primary fw-bold" onclick="addFeatureRow()">
                                <i class="fe fe-plus me-1"></i> Add Feature Point
                            </button>
                        </div>
                        <div class="card-body bg-white p-3">
                            <div id="featuresListContainer">
                                <!-- Dynamic rows inserted here -->
                            </div>
                            <div class="text-center mt-3 pt-2 border-top">
                                <button type="button" class="btn btn-outline-primary btn-sm px-4" onclick="addFeatureRow()">
                                    <i class="fe fe-plus me-1"></i> Add Another Feature Point
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 savePlanSubmitBtn" id="savePlanBtn">
                        <i class="fe fe-check me-1"></i> <span class="savePlanBtnText">Save Plan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT FOR MODALS & DYNAMIC REPEATERS -->
    <script>
    // ---------- Bottom Benefits Repeater in Section Modal ----------
    function addBenefitField(value = '') {
        const container = document.getElementById('bottomBenefitsContainer');
        const row = document.createElement('div');
        row.className = 'input-group mb-2 benefit-row';
        row.innerHTML = `
            <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
            <input type="text" name="bottom_benefits[]" class="form-control" value="${escapeHtml(value)}" placeholder="Benefit text">
            <button type="button" class="btn btn-outline-danger" onclick="removeBenefitField(this)" title="Delete point">
                <i class="fe fe-trash-2"></i>
            </button>
        `;
        container.appendChild(row);
    }

    function removeBenefitField(btn) {
        const row = btn.closest('.benefit-row');
        if (row) {
            row.remove();
        }
    }

    // ---------- Trial Features Repeater in Section Modal ----------
    function addTrialFeatureField(value = '') {
        const container = document.getElementById('trialFeaturesContainer');
        const row = document.createElement('div');
        row.className = 'input-group mb-2 trial-feature-row';
        row.innerHTML = `
            <span class="input-group-text"><i class="fe fe-check text-success"></i></span>
            <input type="text" name="trial_features[]" class="form-control" value="${escapeHtml(value)}" placeholder="Feature text">
            <button type="button" class="btn btn-outline-danger" onclick="removeTrialFeatureField(this)" title="Delete point">
                <i class="fe fe-trash-2"></i>
            </button>
        `;
        container.appendChild(row);
    }

    function removeTrialFeatureField(btn) {
        const row = btn.closest('.trial-feature-row');
        if (row) {
            row.remove();
        }
    }

    // ---------- Plan Comparison Feature Repeater ----------
    function addComparisonFeatureRow() {
        const body = document.getElementById('comparisonFeaturesBody');
        const indices = Array.from(body.querySelectorAll('.comparison-feature-row'))
            .map(row => Number(row.dataset.index))
            .filter(Number.isFinite);
        const index = indices.length ? Math.max(...indices) + 1 : 0;
        const row = document.createElement('tr');
        row.className = 'comparison-feature-row';
        row.dataset.index = index;

        let cells = `
            <th scope="row">
                <input type="text" name="comparison_features[${index}][label]" class="form-control" required>
            </th>
        `;
        document.querySelectorAll('#comparison-pane thead th[data-plan-id]').forEach(header => {
            const planId = header.dataset.planId;
            cells += `
                <td>
                    <input type="text" name="comparison_features[${index}][values][${planId}]" class="form-control">
                </td>
            `;
        });
        cells += `
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeComparisonFeatureRow(this)" aria-label="Remove feature">
                    <i class="fe fe-trash-2"></i>
                </button>
            </td>
        `;
        row.innerHTML = cells;
        body.appendChild(row);
    }

    function removeComparisonFeatureRow(button) {
        const row = button.closest('.comparison-feature-row');
        if (row) {
            row.remove();
        }
    }

    // ---------- Features Repeater in Plan Modal ----------
    function addFeatureRow(value = '') {
        const container = document.getElementById('featuresListContainer');
        const count = container.querySelectorAll('.feature-point-row').length + 1;
        const row = document.createElement('div');
        row.className = 'input-group mb-2 feature-point-row';
        row.innerHTML = `
            <span class="input-group-text bg-light text-primary fw-bold feature-badge-point">
                <i class="fe fe-check-circle text-success me-1"></i> Point <span class="point-num">${count}</span>
            </span>
            <input type="text" name="features[]" class="form-control" value="${escapeHtml(value)}" placeholder="e.g. Inventory & tag management, GST billing...">
            <button type="button" class="btn btn-danger" onclick="removeFeatureRow(this)" title="Delete point">
                <i class="fe fe-trash-2 me-1"></i> Delete
            </button>
        `;
        container.appendChild(row);
        renumberFeaturePoints();
    }

    function removeFeatureRow(btn) {
        const row = btn.closest('.feature-point-row');
        if (row) {
            row.remove();
            renumberFeaturePoints();
        }
    }

    function renumberFeaturePoints() {
        const rows = document.querySelectorAll('#featuresListContainer .feature-point-row');
        rows.forEach((row, idx) => {
            const numSpan = row.querySelector('.point-num');
            if (numSpan) numSpan.textContent = idx + 1;
        });
    }

    // ---------- Price / Discount / Cut Price / Save Price Calculations ----------
    // Called when user enters Cut Price or Discount (%): Auto calculates Main Price and Save Price!
    function calculatePricing(period) {
        const cutPriceEl = document.getElementById(period + '_cut_price');
        const discountEl = document.getElementById(period + '_discount');
        const priceEl = document.getElementById(period + '_price');
        const savingsEl = document.getElementById(period + '_savings');

        const cut = parseFloat(cutPriceEl.value) || 0;
        const discount = parseFloat(discountEl.value) || 0;

        if (cut > 0) {
            if (discount > 0 && discount < 100) {
                const savings = Math.round((cut * discount) / 100);
                const mainPrice = Math.max(0, cut - savings);
                priceEl.value = mainPrice;
                savingsEl.value = savings;
            } else if (discount === 0) {
                priceEl.value = cut;
                savingsEl.value = 0;
            } else if (discount >= 100) {
                priceEl.value = 0;
                savingsEl.value = cut;
            }
        } else {
            priceEl.value = '';
            savingsEl.value = '';
        }
        updatePreview(period);
    }

    // Called if user manually adjusts Main Price
    function calcFromSelling(period) {
        const cutPriceEl = document.getElementById(period + '_cut_price');
        const discountEl = document.getElementById(period + '_discount');
        const priceEl = document.getElementById(period + '_price');
        const savingsEl = document.getElementById(period + '_savings');

        const cut = parseFloat(cutPriceEl.value) || 0;
        const selling = parseFloat(priceEl.value) || 0;

        if (cut > 0 && selling <= cut) {
            const savings = Math.max(0, cut - selling);
            savingsEl.value = savings;
            discountEl.value = Math.round((savings / cut) * 100);
        } else if (selling > 0 && cut === 0) {
            cutPriceEl.value = selling;
            discountEl.value = 0;
            savingsEl.value = 0;
        }
        updatePreview(period);
    }

    function updatePreview(period) {
        const price = parseFloat(document.getElementById(period + '_price').value) || 0;
        const discount = parseFloat(document.getElementById(period + '_discount').value) || 0;
        const cut = parseFloat(document.getElementById(period + '_cut_price').value) || 0;
        const save = parseFloat(document.getElementById(period + '_savings').value) || 0;
        const sym = document.getElementById('plan_currency_symbol').value || '₹';

        const previewEl = document.getElementById(period + 'PreviewBadge');
        if (!previewEl) return;

        if (cut > 0 && discount > 0) {
            previewEl.innerHTML = `Preview: <del class="fw-bold" style="color: #dc3545 !important;">${sym}${cut.toLocaleString()}</del> → <strong class="text-dark fw-bold">${sym}${price.toLocaleString()}</strong> <span class="badge bg-success-light text-success ms-1">${discount}% OFF</span> <span class="text-success ms-1 fw-bold">You Save ${sym}${save.toLocaleString()}</span>`;
        } else if (price > 0) {
            previewEl.innerHTML = `Preview: <strong class="text-dark fw-bold">${sym}${price.toLocaleString()}</strong>`;
        } else if (cut > 0) {
            previewEl.innerHTML = `Preview: <strong class="text-dark fw-bold">${sym}${cut.toLocaleString()}</strong>`;
        } else {
            previewEl.innerHTML = `Preview: <span class="text-muted">Enter Cut Price & Discount</span>`;
        }
    }

    function toggleFeaturedBadgeInput() {
        const isFeatured = document.getElementById('plan_is_featured').checked;
        const wrapper = document.getElementById('badgeTextWrapper');
        if (wrapper) {
            wrapper.style.display = isFeatured ? 'block' : 'none';
        }
    }

    function updateActiveStatusLabel() {
        const isChecked = document.getElementById('plan_is_active').checked;
        const label = document.getElementById('plan_is_active_label');
        if (label) {
            label.textContent = isChecked ? 'Active (Visible on site)' : 'Hidden (Inactive)';
            label.className = isChecked ? 'form-check-label fw-bold text-success' : 'form-check-label fw-bold text-muted';
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // ---------- Modal Openers ----------
    function openCreatePlanModal() {
        const form = document.getElementById('planForm');
        form.reset();
        document.getElementById('planFormMethod').value = 'POST';
        form.action = "{{ route('superadmin.cms.pricing.plan.store') }}";
        document.getElementById('modalModeTitle').textContent = 'Add New Plan';
        document.querySelectorAll('.savePlanBtnText').forEach(el => el.textContent = 'Create Plan');

        // Defaults
        document.getElementById('plan_sort_order').value = '{{ $plans->count() + 1 }}';
        document.getElementById('plan_is_active').checked = true;
        updateActiveStatusLabel();
        document.getElementById('plan_is_featured').checked = false;
        document.getElementById('plan_popular_badge_text').value = 'MOST POPULAR';
        document.getElementById('plan_currency_symbol').value = '₹';
        document.getElementById('plan_button_text').value = 'Start free trial';
        document.getElementById('plan_button_link').value = '#jewelSignupModal';
        document.getElementById('plan_trial_note').value = '30 days free · Cancel anytime';

        // Initialize default cut price & discount to auto calculate main & save price
        document.getElementById('monthly_cut_price').value = 3000;
        document.getElementById('monthly_discount').value = 16;
        calculatePricing('monthly');

        document.getElementById('yearly_cut_price').value = 50000;
        document.getElementById('yearly_discount').value = 41;
        calculatePricing('yearly');

        toggleFeaturedBadgeInput();

        // Clear features and add 3 blank rows
        const container = document.getElementById('featuresListContainer');
        container.innerHTML = '';
        addFeatureRow('Inventory & tag management');
        addFeatureRow('GST billing');
        addFeatureRow('Barcode printing');

        updatePreview('monthly');
        updatePreview('yearly');

        const modalEl = document.getElementById('planModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        // Reset scroll position to top
        const modalBody = modalEl.querySelector('.modal-body');
        if (modalBody) modalBody.scrollTop = 0;
    }

    function openEditPlanModal(plan) {
        const form = document.getElementById('planForm');
        form.reset();
        document.getElementById('planFormMethod').value = 'PUT';

        let url = "{{ route('superadmin.cms.pricing.plan.update', ':id') }}";
        form.action = url.replace(':id', plan.id);

        document.getElementById('modalModeTitle').textContent = 'Edit Plan: ' + plan.name;
        document.querySelectorAll('.savePlanBtnText').forEach(el => el.textContent = 'Update Plan');

        document.getElementById('plan_name').value = plan.name || '';
        document.getElementById('plan_label').value = plan.plan_label || '';
        document.getElementById('plan_sort_order').value = plan.sort_order || 0;
        
        const isActive = (plan.is_active == 1 || plan.is_active === true || plan.is_active === '1');
        document.getElementById('plan_is_active').checked = isActive;
        updateActiveStatusLabel();

        const isFeatured = (plan.is_featured == 1 || plan.is_featured === true || plan.is_featured === '1');
        document.getElementById('plan_is_featured').checked = isFeatured;
        toggleFeaturedBadgeInput();
        document.getElementById('plan_popular_badge_text').value = plan.popular_badge_text || 'MOST POPULAR';
        document.getElementById('plan_description').value = plan.description || '';
        document.getElementById('plan_currency_symbol').value = plan.currency_symbol || '₹';

        // Monthly (Cut Price & Discount on top, Main & Save Price auto)
        document.getElementById('monthly_cut_price').value = plan.monthly_cut_price || '';
        document.getElementById('monthly_discount').value = plan.monthly_discount || 0;
        document.getElementById('monthly_price').value = plan.monthly_price || 0;
        document.getElementById('monthly_savings').value = plan.monthly_savings || 0;
        document.getElementById('monthly_billing_text').value = plan.monthly_billing_text || 'Billed monthly';

        // Yearly (Cut Price & Discount on top, Main & Save Price auto)
        document.getElementById('yearly_cut_price').value = plan.yearly_cut_price || '';
        document.getElementById('yearly_discount').value = plan.yearly_discount || 0;
        document.getElementById('yearly_price').value = plan.yearly_price || 0;
        document.getElementById('yearly_savings').value = plan.yearly_savings || 0;
        document.getElementById('yearly_billing_text').value = plan.yearly_billing_text || 'Billed annually';

        // Button & note
        document.getElementById('plan_button_text').value = plan.button_text || 'Start free trial';
        document.getElementById('plan_button_link').value = plan.button_link || '#jewelSignupModal';
        document.getElementById('plan_trial_note').value = plan.trial_note || '30 days free · Cancel anytime';

        toggleFeaturedBadgeInput();

        // Features repeater with safe JSON decoding
        const container = document.getElementById('featuresListContainer');
        container.innerHTML = '';
        let features = plan.features;
        if (typeof features === 'string') {
            try { features = JSON.parse(features); } catch (e) { features = []; }
        }
        if (Array.isArray(features) && features.length > 0) {
            features.forEach(f => addFeatureRow(f));
        } else {
            addFeatureRow('');
        }

        updatePreview('monthly');
        updatePreview('yearly');

        const modalEl = document.getElementById('planModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        // Reset scroll position to top
        const modalBody = modalEl.querySelector('.modal-body');
        if (modalBody) modalBody.scrollTop = 0;
    }

    document.addEventListener("DOMContentLoaded", function () {
        toggleFeaturedBadgeInput();

        const comparisonTab = document.getElementById('comparison-tab');
        if (new URLSearchParams(window.location.search).get('tab') === 'comparison' && comparisonTab) {
            bootstrap.Tab.getOrCreateInstance(comparisonTab).show();
        }

        document.querySelectorAll('#pricingCmsTabs [data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function () {
                const url = new URL(window.location.href);
                url.searchParams.set('tab', this.id === 'comparison-tab' ? 'comparison' : 'plans');
                window.history.replaceState({}, '', url);
            });
        });
    });
    </script>
@endsection
