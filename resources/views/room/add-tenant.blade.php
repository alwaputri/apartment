<!-- room/add-tenant.blade.php -->
@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Tampah Penghuni"; // Default title for Daftar Kamar
@endphp
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="content">
    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <form action="{{ route('room.store.tenant', ['id' => $kamar->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="ktp">KTP</label>
                            <input type="number" name="ktp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
    <label for="check_in">Check-In Date and Time</label>
    <input type="datetime-local" name="check_in" class="form-control" required>
</div>
<div class="form-group">
    <label for="check_out">Check-Out Date and Time</label>
    <input type="datetime-local" name="check_out" class="form-control" required>
</div>

                        <button type="submit" class="btn btn-success">Tambah Penghuni</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
