<div class="row">
@foreach ($cards as $invoice)
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 d-flex">
        <div class="card inovices-card w-100">
            <div class="card-body">
                <div class="dash-widget-header">
                    <span class="inovices-widget-icon {{ $invoice['class'] }}">
                        <img src="{{ asset('assets/img/icons/' . $invoice['icon']) }}" alt="icon">
                    </span>
                    <div class="dash-count">
                        <div class="dash-title">{{ $invoice['title'] }}</div>
                        <div class="dash-counts">
                            <p>₹{{ number_format($invoice['amount'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="inovices-all">
                        No of Invoice
                        <span class="rounded-circle bg-light-gray">
                            {{ $invoice['number_of_invoice'] }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
