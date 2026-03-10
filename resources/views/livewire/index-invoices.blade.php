<div class="col-md-6 col-sm-6">
    @if (Route::is(['index']))
        <div class="card mb-0">
    @endif
    @if (!Route::is(['index']))
        <div class="card">
    @endif
    <div class="card-header">
        <div class="row align-center">
            <div class="col">
                <h5 class="card-title">Recent Invoices</h5>
            </div>
            <div class="col-auto">
                <a href="{{ url('invoices') }}" class="btn-right btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <div class="progress progress-md rounded-pill mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 47%" aria-valuenow="47"
                    aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 28%" aria-valuenow="28"
                    aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15"
                    aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <i class="fas fa-circle text-success me-1"></i> Paid
                </div>
                <div class="col-auto">
                    <i class="fas fa-circle text-warning me-1"></i> Unpaid
                </div>
                <div class="col-auto">
                    <i class="fas fa-circle text-danger me-1"></i> Overdue
                </div>
                <div class="col-auto">
                    <i class="fas fa-circle text-info me-1"></i> Draft
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-stripped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="{{ url('invoice-details/' . $invoice->id) }}">
                                        @if($invoice->customer && $invoice->customer->image)
                                            <img class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                src="{{ asset('/public/assets/img/profiles/' . $invoice->customer->image) }}"
                                                alt="User Image">
                                        @else
                                            <img class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                src="{{ asset('/public/assets/img/profiles/avatar-01.jpg') }}"
                                                alt="User Image">
                                        @endif
                                        {{ $invoice->customer->name ?? 'Unknown' }}
                                    </a>
                                </h2>
                            </td>
                            <td>₹{{ number_format($invoice->final_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->invoice_due_date)->format('d M Y') }}</td>
                            <td>
                                @php
                                    $statusClass = 'badge bg-info-light text-info';
                                    if($invoice->status == 'paid') $statusClass = 'badge bg-success-light';
                                    elseif($invoice->status == 'partial') $statusClass = 'badge bg-warning-light text-warning';
                                    elseif($invoice->status == 'pending') $statusClass = 'badge bg-info-light text-info';
                                    elseif($invoice->status == 'overdue') $statusClass = 'badge bg-danger-light';
                                @endphp
                                <span class="{{ $statusClass }}">{{ ucfirst($invoice->status) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ url('sell-invoice/edit/' . $invoice->id) }}"><i
                                                class="far fa-edit me-2"></i>Edit</a>
                                        <a class="dropdown-item" href="{{ url('sell-invoice/view/' . $invoice->id) }}"><i
                                                class="far fa-eye me-2"></i>View</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
