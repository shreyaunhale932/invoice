<?php $page = 'customers'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Customers
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table card p-3">
                        <div class="card-body">
                            <style>
                                #tableSearch {
                                    justify-content: flex-start !important;
                                    gap: 20px !important;
                                }
                                .dataTables_filter {
                                    order: 1 !important;
                                    margin: 0 !important;
                                }
                                .customers-date-filter {
                                    order: 2 !important;
                                    display: flex;
                                    align-items: center;
                                    gap: 15px;
                                }
                                @media (max-width: 767.98px) {
                                    .customers-date-filter {
                                        flex-direction: column;
                                        align-items: stretch;
                                        width: 100%;
                                        gap: 10px;
                                    }
                                }
                            </style>
                            <div id="tableSearch" class="mb-3">
                                <div class="customers-date-filter ">
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted me-2" style="font-size: 13px; font-weight: 500; white-space: nowrap;">From:</span>
                                        <input type="date" id="from_date" class="form-control form-control-sm" style="width: 140px; height: 38px; border-radius: 5px;" value="{{ request('from_date') }}">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted me-2" style="font-size: 13px; font-weight: 500; white-space: nowrap;">To:</span>
                                        <input type="date" id="to_date" class="form-control form-control-sm" style="width: 140px; height: 38px; border-radius: 5px;" value="{{ request('to_date') }}">
                                    </div>
                                    <button type="button" id="btn_clear_dates" class="btn btn-light d-flex align-items-center justify-content-center" style="height: 38px; border-radius: 5px; padding: 0 15px; background-color: #f3f3f9; border-color: #f3f3f9; color: #333; font-size: 13px; font-weight: 500;">
                                        Clear
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>City</th>
                                            {{-- <th>Balance </th> --}}
                                            {{-- <th>Total Invoice </th> --}}
                                            <th>Created</th>
                                            {{-- <th>Status</th> --}}
                                            <th class="no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer['id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">

                                                        <a href="{{ route('customers.details', $customer->id) }}">{{ $customer['name'] }}
                                                            {{-- <span>{{ $customer['email'] }}</span></a> --}}
                                                    </h2>
                                                </td>
                                                <td>{{ $customer['phone'] }}</td>
                                                <td>{{ $customer['email'] }}</td>
                                                <td>{{ $customer['city'] }}</td>
                                                <td>{{ $customer['created_at'] }}</td>
                                                {{-- <td><span class="{{ $customer['Class'] }}">{{ $customer['Status'] }}</span>
                                                </td> --}}
                                                <td class="d-flex align-items-center">
                                                    {{-- <a href="{{ url('add-invoice') }}" class="btn btn-greys me-2"><i
                                                            class="fa fa-plus-circle me-1"></i> Invoice</a>
                                                    <a href="{{ url('customers-ledger') }}" class="btn btn-greys me-2"><i
                                                            class="fa-regular fa-eye me-1"></i> Ledger</a> --}}
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class=" btn-action-icon "
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-v"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('customers.edit', $customer->id) }}"><i
                                                                            class="far fa-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal"
                                                                        onclick="setDeleteAction('{{ route('customers.destroy', $customer->id) }}')"><i
                                                                            class="far fa-trash-alt me-2"></i>Delete</a>
                                                                </li>
                                                                {{-- <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('customer-details') }}"><i
                                                                            class="far fa-eye me-2"></i>View</a>
                                                                </li> --}}
                                                                {{-- <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('active-customers') }}"><i
                                                                            class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                                </li> --}}
                                                                {{-- <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('deactive-customers') }}"><i
                                                                            class="far fa-bell-slash me-2"></i>Deactivate</a>
                                                                </li> --}}
                                                            </ul>
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
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    <!-- Delete Items Modal -->
    <div class="modal custom-modal fade modal-delete" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <div class="delete-modal-icon">
                            <span><i class="fe fe-check-circle"></i></span>
                        </div>
                        <h3>Are You Sure?</h3>
                        <p>You want delete customer</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="modal-footer justify-content-center p-0">
                            <form id="delete_form" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary paid-continue-btn me-2">Yes, Delete</button>
                            </form>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-back cancel-btn">No,
                                Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Items Modal -->

    <script>
        function setDeleteAction(action) {
            document.getElementById('delete_form').action = action;
        }
    </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('.datatable').DataTable();
            
            // Custom DataTable search filter for Date Range
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    // Apply this filter only to the current table
                    if (!settings.nTable.classList.contains('datatable')) {
                        return true;
                    }
                    
                    var fromDate = $('#from_date').val(); // YYYY-MM-DD
                    var toDate = $('#to_date').val();     // YYYY-MM-DD
                    
                    // The "Created" column is index 5
                    var dateStr = data[5] || "";
                    if (!dateStr) return true;
                    
                    // Extract date part (YYYY-MM-DD) from the table string
                    var createdDate = dateStr.replace(/<[^>]*>/g, '').trim().substring(0, 10);
                    
                    if (fromDate && createdDate < fromDate) {
                        return false;
                    }
                    if (toDate && createdDate > toDate) {
                        return false;
                    }
                    return true;
                }
            );

            // Redraw table when dates change
            $('#from_date, #to_date').on('change', function() {
                table.draw();
            });

            // Clear date filter
            $('#btn_clear_dates').on('click', function() {
                $('#from_date').val('');
                $('#to_date').val('');
                table.draw();
            });

            // Intercept click on the CVS download item
            $(document).on('click', '.download-item', function(e) {
                var href = $(this).attr('href');
                if (href && href.indexOf('customers/export/csv') !== -1) {
                    e.preventDefault();
                    exportFilteredCustomersToCSV();
                }
            });

            function exportFilteredCustomersToCSV() {
                var csv = [];
                
                // Get table headers (ignoring Actions)
                var headers = [];
                $('.datatable thead tr th').each(function(index) {
                    var text = $(this).text().trim();
                    if (text && text !== 'Actions') {
                        headers.push('"' + text.replace(/"/g, '""') + '"');
                    }
                });
                csv.push(headers.join(','));

                // Get only filtered/visible rows (across all pages)
                table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
                    var node = this.node();
                    var row = [];
                    $(node).find('td').each(function(colIdx) {
                        // We have 7 columns total: #:0, Name:1, Phone:2, Email:3, City:4, Created:5, Actions:6
                        // Ignore Actions column
                        if (colIdx < 6) {
                            var text = $(this).text().trim();
                            // Clean up spacing and double quotes
                            text = text.replace(/\s+/g, ' ').replace(/"/g, '""');
                            row.push('"' + text + '"');
                        }
                    });
                    csv.push(row.join(','));
                });

                // Trigger file download
                var csvContent = csv.join('\n');
                var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                var filename = "customer_list_" + new Date().toISOString().slice(0, 10) + ".csv";
                
                var link = document.createElement("a");
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    </script>
@endsection
