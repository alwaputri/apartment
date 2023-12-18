<!-- daftarkamar.blade.php -->
@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Daftar Kamar"; // Default title for Daftar Kamar
@endphp
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="content">
    <div class="row">
        <!-- Place the "Tambah Kamar" button and search input side by side -->
        <div class="col-lg-6 mb-4">
            @if (auth()->user()->isAdmin()) <!-- Check if the user is an Admin -->
                <a href="{{ route('room.tambah') }}" class="btn btn-primary btn-sm-2">Tambah Kamar</a>
            @endif
        </div>
        <div class="col-lg-6 mb-4">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Search room number...">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="searchRooms()">Search</button>
                </div>
            </div>
        </div>
        <!-- Loop through your existing room cards here -->
        @foreach($kamars as $kamar)
        <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
            <div class="card h-100"> <!-- Added h-100 class to make card sizes consistent -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-bed fa-3x {{ $kamar->status == 'Occupied' ? 'text-primary' : 'text-success' }}"></i>
                        </div>
                        <div class="col-8">
                            <div class="numbers">
                                <p class="card-title font-weight-bold" style="font-size: 16px;">Kamar Nomor</p>
                                <p class="card-text" style="font-size: 16px;">{{ $kamar->no_kamar }}</p>
                                <p class="card-title font-weight-bold" style="font-size: 16px;">Status</p>
                                <p class="card-text" style="font-size: 16px;">{{ $kamar->status }}</p>

                                <p class="card-title font-weight-bold" style="font-size: 16px;">Total Masa Sewa</p>
                                @if ($kamar->reservasis->count() > 0)
                                    @php
                                        $totalRentalPeriod = $kamar->reservasis->first()->getTotalRentalPeriod();
                                        $rentalDuration = '';

                                        if (isset($totalRentalPeriod['years']) && $totalRentalPeriod['years'] >= 1) {
                                            $rentalDuration .= $totalRentalPeriod['years'] . ' years ';
                                        }
                                        if (isset($totalRentalPeriod['months']) && $totalRentalPeriod['months'] >= 1) {
                                            $rentalDuration .= $totalRentalPeriod['months'] . ' months ';
                                        }
                                        if (isset($totalRentalPeriod['weeks']) && $totalRentalPeriod['weeks'] >= 1) {
                                            $rentalDuration .= $totalRentalPeriod['weeks'] . ' weeks';
                                        } elseif (isset($totalRentalPeriod['days']) && $totalRentalPeriod['days'] >= 1) {
                                            $rentalDuration .= $totalRentalPeriod['days'] . ' days';
                                        }

                                        if (empty($rentalDuration)) {
                                            $rentalDuration = 'Less than 1 day';
                                        }
                                    @endphp
                                    @if ($kamar->status == 'Available')
                                        <p class="card-text" style="font-size: 16px;">-</p>
                                    @else
                                        <p class="card-text" style="font-size: 16px;">{{ $rentalDuration }}</p>
                                    @endif
                                @endif

                                <div class="d-flex">
                                    @if ($kamar->status == 'Available' && auth()->user()->isAdmin())
                                        <button class="btn btn-danger btn-sm mr-2" onclick="deleteRoom({{ $kamar->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                    @if ($kamar->status == 'Available' && auth()->user()->isAdmin())
                                        <a href="{{ route('room.add.tenant', ['id' => $kamar->id]) }}"
                                            class="btn btn-success btn-sm">Tambah Penghuni</a>
                                    @elseif ($kamar->status != 'Available')
                                        <a href="{{ route('room.detail', ['id' => $kamar->id]) }}"
                                            class="btn btn-info btn-sm">View Detail</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection

<script>
    function deleteRoom(roomId) {
        if (confirm("Are you sure you want to delete this room?")) {
            // You can make an AJAX request to delete the room or perform any other necessary action here.
            // For demonstration purposes, we'll simply reload the page.
            window.location.href = "{{ route('room.delete', ['id' => $kamar->id]) }}";
        }
    }

    function searchRooms() {
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();
        var roomCards = document.querySelectorAll(".card");

        roomCards.forEach(function(card) {
            var roomNumber = card.querySelector(".card-text").textContent.toLowerCase();
            if (roomNumber.includes(searchTerm)) {
                card.style.display = "block"; // Show the card
            } else {
                card.style.display = "none"; // Hide the card
            }
        });
    }
</script>
