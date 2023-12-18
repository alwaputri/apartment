@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Kamar Kosong"; // Default title for Daftar Kamar
@endphp
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Available Room Numbers</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($vacantRoomNumbers as $roomNumber)
                            <li class="list-group-item">{{ $roomNumber }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
