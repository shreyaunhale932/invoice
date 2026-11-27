<?php $page = 'contact-messages'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            @component('components.page-header')
                @slot('title')
                    Contact Messages
                @endslot
            @endcomponent
            <!-- /Page Header -->

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Business Name</th>
                                            <th>Message</th>
                                            <th>Submitted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contactmessages as $contactmessage)
                                            <tr>
                                                <td>{{ $contactmessage->id }}</td>
                                                <td>
                                                    <strong>{{ $contactmessage->full_name }}</strong>
                                                </td>
                                                <td><a href="mailto:{{ $contactmessage->email }}">{{ $contactmessage->email }}</a></td>
                                                <td>{{ $contactmessage->phone }}</td>
                                                <td>{{ $contactmessage->business_name ?: 'N/A' }}</td>
                                                <td class="text-break">{{ $contactmessage->message }}</td>
                                                <td>{{ $contactmessage->created_at->format('d M Y, h:i A') }}</td>
                                                <td>
                                                    <form action="{{ route('superadmin.contact-messages.destroy', $contactmessage) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Delete this contact enquiry?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No contact enquiries have been submitted.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $contactmessages->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Table -->

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
