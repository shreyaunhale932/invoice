<?php $page = 'category'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Metal Rates
                @endslot
            @endcomponent
            <!-- /Page Header -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <!-- Search Filter -->
            @component('components.search-filter')
            @endcomponent
            <!-- /Search Filter -->

            <!-- All Invoice -->
            @component('components.products-header')
            @endcomponent
            <!-- /All Invoice -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class=" card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Metal Name</th>
                                            <th>Price Per Gram</th>
                                            {{-- <th>Gram</th> --}}
                                            <th>Purity</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($metalRates as $rate)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>

                                                <td>{{ $rate->metal_type }}</td>

                                                <td>{{ $rate->price_per_gram }}</td>

                                                {{-- <td>{{ $rate->gram }}</td> --}}

                                                <td>
                                                    {{ $rate->karat ?? '-' }}
                                                    @if ($rate->purity_type === 'percent')
                                                        %
                                                    @elseif($rate->purity_type === 'karat')
                                                        K
                                                    @endif
                                                </td>


                                                <td class="d-flex align-items-center">
                                                    <!-- Edit -->
                                                    <a href="javascript:void(0);"
                                                        class="btn-action-icon me-2 editMetalRateBtn" data-bs-toggle="modal"
                                                        data-bs-target="#edit_metalrate" data-id="{{ $rate->id }}"
                                                        data-metal="{{ $rate->metal_type }}"
                                                        data-price="{{ $rate->price_per_gram }}"
                                                        data-gram="{{ $rate->gram }}" data-karat="{{ $rate->karat }}"
                                                        data-purity="{{ $rate->purity_type }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>



                                                    <!-- Delete -->
                                                    <a class="btn-action-icon" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                        data-id="{{ $rate->id }}">
                                                        <i class="fe fe-trash-2"></i>
                                                    </a>
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
            <!-- /Table -->

        </div>
    </div>
    <script>
        $(document).on("click", ".editMetalRateBtn", function() {

            let id = $(this).data("id");
            // console.log($(this).data("purity"));

            $("#edit_metal_type").val($(this).data("metal")).trigger("change");;
            $("#edit_price_per_gram").val($(this).data("price"));
            $("#edit_metal_purity_type").val($(this).data("purity")).trigger("change");
            $("#edit_karat").val($(this).data("karat"));

            // FIX: Set form action using Laravel route()
            let url = "{{ route('metal-rates.update', ':id') }}";
            url = url.replace(':id', id);

            $("#editMetalRateForm").attr("action", url);
        });
    </script>
    <script>
        $(document).on("click", "[data-bs-target='#delete_modal']", function() {
            let id = $(this).data("id");

            let url = "{{ route('metal-rates.destroy', ':id') }}";
            url = url.replace(':id', id);

            $("#deleteMetalRateForm").attr("action", url);
        });
    </script>

    <!-- /Page Wrapper -->
@endsection
