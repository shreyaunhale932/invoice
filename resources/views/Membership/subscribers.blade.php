<?php $page = 'subscribers'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Subscribers
                @endslot
            @endcomponent
            <!-- /Page Header -->

            <!-- Table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped table-hover datatable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Provider Name</th>
                                            <th>Subscription</th>
                                            <th>Amount</th>
                                            <th>Subscription Durations</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $json = file_get_contents(public_path('../public/assets/json/subscribers.json'));
                                            $subscribers = json_decode($json, true);
                                        @endphp
                                        @foreach ($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ $subscriber['Id'] }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{ url('profile') }}" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ URL::asset('/public/assets/img/profiles/' . $subscriber['Image']) }}"
                                                                alt="User Image"></a>
                                                        <a href="{{ url('profile') }}">{{ $subscriber['ProviderName'] }}
                                                            <span>{{ $subscriber['Email'] }}</span></a>
                                                    </h2>
                                                </td>
                                                <td>{{ $subscriber['Subscription'] }}</td>
                                                <td>{{ $subscriber['Amount'] }}</td>
                                                <td>{{ $subscriber['SubscriptionDurations'] }}</td>
                                                <td>{{ $subscriber['StartDate'] }}</td>
                                                <td>{{ $subscriber['EndDate'] }}</td>
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
    <!-- /Page Wrapper -->
@endsection
