<!-- room/detail.blade.php -->
@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Detail Kamar"; // Default title for Daftar Kamar
@endphp
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        @if(session('totalRentalPeriod'))
            Total Masa Sewa: {{ session('totalRentalPeriod')->format('%y years, %m months, %d days') }}
        @endif
    </div>
@endif

<div class="content">
    @foreach ($kamarr->reservasis as $reservasi)
                    @if ($reservasi->status === 'Uncompleted')
@if (now() > $reservasi->check_out_date)
                                    <div class="alert alert-danger">
                                    Jam check-out telah berlalu. Dikenakan denda sebesar 50% dari harga kamar.
                                    </div>
                                    @else
                                    
                                @endif
                                @endif
                    @endforeach
{{-- @if (now() > $kamarr->check_out_date)
                                    <div class="alert alert-danger">
                                    Jam check-out telah berlalu. Dikenakan denda sebesar 50% dari harga kamar.
                                    </div>
                                @endif --}}
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="numbers">
                        <p class="card-category">Kamar Nomor</p>
                        <p class="card-title">{{ $kamarr->no_kamar }}</p>
                        <p class="card-category">Status</p>
                        <p class="card-title">{{ $kamarr->status }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="numbers">
                    @foreach ($kamarr->reservasis as $reservasi)
                    @if ($reservasi->status === 'Uncompleted')
                        <p class="card-category">Customer Name</p>
                        <p class="card-title">{{ $reservasi->customer->first_name }} {{ $reservasi->customer->last_name }}</p>
                        <p class="card-category">Phone</p>
                        <p class="card-title">{{ $reservasi->customer->phone }}</p>
                        <p class="card-category">Check-In Date</p>
                        <p class="card-title">{{ $reservasi->check_in_date }}</p>
                        <p class="card-category">Check-Out Date</p>
                        <p class="card-title">{{ $reservasi->check_out_date }}</p>
                    @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <form action="{{ route('checkout.kamar', ['id' => $kamarr->id, 'reservation_id' => $reservasi->reservation_id]) }}" method="POST">
    @csrf
    @method('PUT')
    @if (auth()->user()->isAdmin())
    <button type="submit" class="btn btn-primary">Checkout</button>
    @endif
</form>
    <a href="{{ route('kamars.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
