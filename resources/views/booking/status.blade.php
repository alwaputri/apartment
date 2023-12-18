@extends('layout.layout')

@section('content')
    @php
        $pageTitle = "History Reservasi"; // Default title for Daftar Kamar
    @endphp
    <style>
        a{
            color: #0018f0;
        }
    </style>
    <div class="container">
        <!-- Button to Trigger Modal -->
        <!-- <div class="mb-3">
        <a href="" class="btn btn-primary">Add Reservation</a> -->
    </div>

    <form action="{{ route('filterBookings') }}" method="GET">
        <div class="row mb-3">
            <div class="col">
                <label for="checkin_date">Filter Check-In Date:</label>
                <input type="date" name="checkin_date" class="form-control" id="checkin_date">
            </div>
            <div class="col">
                <label for "customer_name">Search by Customer Name:</label>
                <input type="text" name="customer_name" class="form-control" id="customer_name">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filter/Search</button>
            </div>
        </div>
    </form>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        {{-- <li class="nav-item">
            <a class="nav-link active bg-success text-white" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="true">Completed</a>
        </li> --}}
        
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Completed Tab Content -->
        <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th>Check-In Date</th>
                            <th>Check-Out Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = ($currentPage - 1) * $itemsPerPage + 1;
                    @endphp
                        @foreach ($completedBookings as $booking)
                            <tr class="table-success">
                                <td>{{ $no++ }}</td>
                                <td>Completed</td>
                                <td>
                                    <a href="{{ route('customer.detail', ['id' => $booking->customer->id]) }}" >{{ $booking->customer->first_name }}</a>
                                </td>
                                <td>{{ $booking->check_in_date }}</td>
                                <td>{{ $booking->check_out_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $completedBookings->links('pagination') }}
            </div>
        </div>
        
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
