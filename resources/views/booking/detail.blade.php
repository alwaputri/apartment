@extends('layout.layout')

@section('content')
    @php
        $pageTitle = "Customer Details";
    @endphp

    <div class="content">
    <div class="row">
        @if ($customer)
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="numbers">
                        <p class="card-category">No KTP</p>
                        <p class="card-title">{{ $customer->ktp }}</p>
                        <p class="card-category">Nama Customer</p>
                        <p class="card-title">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="numbers">
                        <p class="card-category">Gender<p>
                        <p class="card-title">{{ $customer->gender }}</p>
                        <p class="card-category">Email</p>
                        <p class="card-title">{{ $customer->email }}</p>
                        <p class="card-category">Phone</p>
                        <p class="card-title">{{ $customer->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="numbers">
                        <p>Customer not found.</p>
                    </div>
                </div>
            </div>
        </div>            
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12">
    <a href="{{ route('booking.status') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>    
    @include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
