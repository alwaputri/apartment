<!-- room/add-tenant.blade.php -->
@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Tampah Penghuni"; // Default title for Daftar Kamar
@endphp
<div class="container">
    <h1>Create Reservation</h1>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="no_kamar">Room Number</label>
            <select name="no_kamar" class="form-control" required>
                @foreach($kamars as $kamar)
                    <option value="{{ $kamar->no_kamar }}">{{ $kamar->no_kamar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ktp">KTP</label>
            <input type="text" name="ktp" class="form-control" required>
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
            <input type="text" name="phone" class="form-control" required>
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
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit Reservation</button>
        </div>
    </form>
</div>
@endsection
