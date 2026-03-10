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
                <h5 class="card-title">Recent Estimates</h5>
            </div>
            <div class="col-auto">
                <a href="{{ url('invoice-details') }}" class="btn-right btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <div class="progress progress-md rounded-pill mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 39%" aria-valuenow="39"
                    aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35"
                    aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-warning" role="progressbar" style="width: 26%" aria-valuenow="26"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <i class="fas fa-circle text-success me-1"></i> Sent
                </div>
                <div class="col-auto">
                    <i class="fas fa-circle text-warning me-1"></i> Draft
                </div>
                <div class="col-auto">
                    <i class="fas fa-circle text-danger me-1"></i> Expired
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Customer</th>
                        <th>Expiry Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($estimates as $estimate)
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="{{ url('invoice-details/' . $estimate->uuid) }}">
                                        @if($estimate->customer && $estimate->customer->image)
                                            <img class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                src="{{ asset('/assets/img/profiles/' . $estimate->customer->image) }}"
                                                alt="User Image">
                                        @else
                                            <img class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                src="{{ asset('/assets/img/profiles/avatar-02.jpg') }}"
                                                alt="User Image">
                                        @endif
                                        {{ $estimate->customer->name ?? 'Unknown' }}
                                    </a>
                                </h2>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($estimate->due_date)->format('d M Y') }}</td>
                            <td>₹{{ number_format($estimate->total_amount, 2) }}</td>
                            <td>
                                @php
                                    $statusClass = 'badge bg-info-light text-info';
                                    if($estimate->status == 'accepted' || $estimate->status == 'paid') $statusClass = 'badge bg-success-light';
                                    elseif($estimate->status == 'draft') $statusClass = 'badge bg-warning-light text-warning';
                                    elseif($estimate->status == 'expired') $statusClass = 'badge bg-danger-light';
                                    elseif($estimate->status == 'sent') $statusClass = 'badge bg-info-light text-info';
                                @endphp
                                <span class="{{ $statusClass }}">{{ ucfirst($estimate->status) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ url('edit-invoice/' . $estimate->uuid) }}"><i
                                                class="far fa-edit me-2"></i>Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="dropdown-item" href="{{ url('invoice-details/' . $estimate->uuid) }}"><i
                                                class="far fa-eye me-2"></i>View</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
