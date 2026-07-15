<?php $page = 'users'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        @component('components.page-header')
        @slot('title')
       Visitor
        @endslot
        @endcomponent
         @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
        <!-- /Page Header -->
      
        <div class="row">
            <div class="col-sm-12">
                <div class="card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-center table-hover " id="example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone no. </th>

                                        <th>Buisness Name</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitors as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h2 class="table-avatar">

                                                <a href="{{ url('profile') }}">{{ $user->full_name }}
                                                    <span>{{ $user->email }}</span>
                                                </a>
                                            </h2>
                                        </td>
                                        <td>{{ $user->email ?? 'N/A' }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->business_name}}</td>
                                        <td>{{ $user->message }}</td>
                                        
                                       
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
<!-- jQuery (Load First) -->




@endsection
