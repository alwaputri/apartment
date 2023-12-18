@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Daftar Penghuni";
@endphp

<div class="container">
    
<ul class="nav nav-tabs" id="myTabs">
        <li>   
            <form action="{{ route('searchPenghuni') }}" method="GET" style="padding-left: 450px;">
            <div class="form-group">
                <input type="text" name="search" class="form-control" id="search" placeholder="Search By Name or KTP">
            </div>
        </form>
    </li>
    </ul>
    
    <div class="tab-content" id="myTabContent">        
        <div class="tab-pane fade show active" id="occupied" role="tabpanel" aria-labelledby="occupied-tab">
            <div class="row">
                <div class="col-lg-14">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>No Kamar</th>
                                <th>KTP</th>
                                <th>Nama</th>
                                <th>Masa Huni</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamarss as $room)
                                    <tr>
                                        <td>{{ $room->kamar->no_kamar }}</td>
                                        <td>{{ $room->customer->ktp }}</td>
                                        <td>{{ $room->customer->first_name }} {{ $room->customer->last_name }}</td>
                                        <td>
                                            {{ $room->getRentalDuration() }}
                                            ({{ $room->check_in_date->format('d M') }} - {{ $room->check_out_date->format('d M') }})
                                        </td>
                                        <td>{{ $room->customer->phone }}</td>
                                        <td>{{ $room->customer->email }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kamarss->links('pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
