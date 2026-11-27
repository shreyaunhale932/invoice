@extends('layout.newlayout')

@section('content')
<div class="page-wrapper page-wrapper-new">
    <div class="container-fluid py-4">

        <div class="text-center mb-4">
            <h2 class="fw-bold">Choose Your Subscription Plan</h2>
            <p class="text-muted">Select a plan that suits your jewellery business.</p>
        </div>

        @if($activeSubscription)
            <div class="alert alert-success">
                You currently have an active subscription:
                <strong>{{ $activeSubscription->plan_name }}</strong>
            </div>
        @else
            <div class="text-center mb-4">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary billing-btn active"
                        data-cycle="monthly">Monthly</button>
                    <button type="button" class="btn btn-outline-primary billing-btn"
                        data-cycle="yearly">Yearly</button>
                </div>
            </div>
        @endif

        @php
            $plans = [
                'basic' => [
                    'name' => 'Basic',
                    'monthly' => 2950,
                    'yearly' => 35400,
                    'description' => 'For small jewellery shops',
                ],
                'pro' => [
                    'name' => 'Pro',
                    'monthly' => 4956,
                    'yearly' => 58646,
                    'description' => 'For growing jewellery businesses',
                ],
                'premium' => [
                    'name' => 'Premium',
                    'monthly' => 7351.40,
                    'yearly' => 81774,
                    'description' => 'For established jewellery businesses',
                ],
            ];
        @endphp

        <div class="row justify-content-center g-4">
            @foreach($plans as $key => $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0"
                         style="border-radius:16px;">

                        <div class="card-body p-4 text-center">

                            <h4 class="fw-bold">{{ $plan['name'] }}</h4>

                            <p class="text-muted">
                                {{ $plan['description'] }}
                            </p>

                            <h3 class="fw-bold text-primary mt-4">
                                ₹<span class="plan-price"
                                    data-monthly="{{ $plan['monthly'] }}"
                                    data-yearly="{{ $plan['yearly'] }}">
                                    {{ number_format($plan['monthly'], 2) }}
                                </span>
                            </h3>

                            <p class="text-muted billing-label">Per month</p>

                            <p class="small text-muted">Including 18% GST</p>

                            @if(!$activeSubscription)
                                <button type="button"
                                    class="btn btn-primary w-100 subscribe-btn"
                                    data-plan="{{ $key }}"
                                    data-cycle="monthly">
                                    Subscribe to {{ $plan['name'] }}
                                </button>
                            @else
                                <button type="button"
                                    class="btn btn-secondary w-100" disabled>
                                    Active Subscription
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="subscriptionMessage" class="mt-3"></div>

    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let billingCycle = 'monthly';

    document.querySelectorAll('.billing-btn').forEach(button => {
        button.addEventListener('click', function () {

            billingCycle = this.dataset.cycle;

            document.querySelectorAll('.billing-btn').forEach(btn => {
                btn.classList.remove('btn-primary', 'active');
                btn.classList.add('btn-outline-primary');
            });

            this.classList.add('btn-primary', 'active');
            this.classList.remove('btn-outline-primary');

            document.querySelectorAll('.plan-price').forEach(price => {
                const amount = price.dataset[billingCycle];
                price.textContent = Number(amount).toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            });

            document.querySelectorAll('.billing-label').forEach(label => {
                label.textContent = billingCycle === 'monthly'
                    ? 'Per month'
                    : 'Per year';
            });

            document.querySelectorAll('.subscribe-btn').forEach(btn => {
                btn.dataset.cycle = billingCycle;
            });
        });
    });

    document.querySelectorAll('.subscribe-btn').forEach(button => {

        button.addEventListener('click', async function () {

            const btn = this;
            const planType = btn.dataset.plan;
            const cycle = btn.dataset.cycle;

            btn.disabled = true;
            btn.textContent = 'Please wait...';

            try {
                const response = await fetch(
                    "{{ route('admin.subscription.create') }}",
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                        },
                        body: JSON.stringify({
                            plan_type: planType,
                            billing_cycle: cycle
                        })
                    }
                );

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Subscription creation failed.');
                }

                const cashfree = Cashfree({
                    mode: 'sandbox'
                });

                cashfree.subscriptionsCheckout({
                    subsSessionId: result.subscription_session_id,
                    redirectTarget: '_self'
                });

            } catch (error) {
                alert(error.message);
                btn.disabled = false;
                btn.textContent = 'Subscribe to ' +
                    planType.charAt(0).toUpperCase() + planType.slice(1);
            }
        });
    });

});
</script>
@endsection
