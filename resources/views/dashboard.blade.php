@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Dashboard"; // Default title for Dashboard
    if (Request::is('DaftarKamar')) {
        $pageTitle = "Daftar Kamar";
    } elseif (Request::is('Reservasi')) {
        $pageTitle = "List Reservasi";
    } elseif (Request::is('DaftarPenghuni')) {
        $pageTitle = "Daftar Penghuni";
    }
@endphp
<div class="content">
    <div class="row justify-content-center"> <!-- Center the cards within the row -->
        <!-- Card: Kamar Sudah Terisi -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> <!-- Adjust the column width -->
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-check-2 text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <div class="text-center">
                        <p class="card-category fs-20" style="font-size: 20px;">Kamar Sudah Terisi</p>
                        <p class="card-title fs-24" style="font-size: 24px; font-weight:bold;">{{ $occupiedRooms }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Kamar Kosong -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> <!-- Adjust the column width -->
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-simple-remove text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <div class="text-center">
                        <p class="card-category fs-20" style="font-size: 20px;"> Kamar Kosong</p>
                        <p class="card-title fs-24" style="font-size: 24px; font-weight:bold;" >{{ $vacantRooms }}</p>
                        <a href="{{ route('available-rooms') }}" class="btn btn-info mt-3 px-4 py-2 fs-14">View Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3"> <!-- Adjust the column width -->
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-calendar-60 text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <div class="text-center">
                        <p class="card-category fs-20" style="font-size: 20px;">Check Out Hari ini</p>
                        <p class="card-title fs-24" style="font-size: 24px; font-weight:bold;">{{ $checkout }}</p>
                        <a href="{{ route('checkout') }}" class="btn btn-info mt-3 px-4 py-2 fs-14">View Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Kamar Kosong -->
        <div class="col-lg-3 col-md-3 col-sm-6 mb-3"> <!-- Adjust the column width -->
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="icon-big text-center icon-warning">
                        <i class="nc-icon nc-time-alarm text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                    <div class="text-center">
                        <p class="card-category fs-20" style="font-size: 20px;">Telat Check Out</p>
                        <p class="card-title fs-24" style="font-size: 24px; font-weight:bold;" >{{ $checkOutOverdue }}</p>
                        <a href="{{ route('latecheckout') }}" class="btn btn-info mt-3 px-4 py-2 fs-14">View Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="card-title mb-0">Apartemen Easton Park Residence - Tipe Studio Fully Furnished</h4><br>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/kamar1.jpeg') }}" class="d-block w-100" alt="Kamar 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/kamar2.jpeg') }}" class="d-block w-100" alt="Kamar 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/kamar3.jpeg') }}" class="d-block w-100" alt="Kamar 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">
                <h6 class="mt-4 mb-3  text-center">Deskripsi Apartemen</h6>
                    <p class="text-center">
                        Unit full furnish minimalis yang nyaman. Lokasi seberang kampus IPDN, berada di jalan Utama Jatinangor.
                        Cocok untuk mahasiswa, karyawan ataupun keluarga. Dekat kampus IKOPIN, ITB, UNPAD.
                    </p>
                    <h6 class="mb-3 text-center">Detail Apartment</h6>
                    <div class="row">
                            <div class="col-md-6">
                                <p class="text-center"><i class="fa-solid fa-ruler"></i> Luas Unit 25 m²</p>
                            </div>
                            <div class="col-md-6">

                                <p class="text-center"><i class="fa fa-bed"></i> Unit 1-Room Studio</p>
                            </div>
                        </div>
                    <h6 class="mb-3 text-center">Fasilitas Unit</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <i class="fa fa-bed"></i> Kasur
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-tv"></i> TV
                        </div>
                        <div class="col-md-3">
                            <i class="fa-solid fa-snowflake"></i> AC
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-tint"></i> Dispenser
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-door-closed"></i> Kulkas Mini
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-fire"></i> Air panas
                        </div>
                        
                    </div>
                    <!-- Apartment Facilities -->
                    <h6 class="mt-4 mb-3 text-center">Fasilitas Apartemen</h6>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <i class="fa fa-swimming-pool"></i> Swimming Pool
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-basketball-ball"></i> Basketball Court
                        </div>
                        <div class="col-md-4">
                            <i class="fa fa-coffee"></i> Cafe
                        </div>
                    </div>
                    <h6 class="mt-4 mb-3 text-center">Harga UNIT APARTEMEN</h6>
                    <div class="row">
                    <div class="col-md-3">
                            <p class="fs-16"><strong>1 Hari</strong></span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-16"><strong>1 Minggu</strong></span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-24 "><strong>1 Bulan</strong></span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-16"><strong>1 Tahun</strong></span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-16">Rp 300.000</p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-16">Rp 1.500.000</p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-24 ">Rp 2.500.000</span></p>
                        </div>
                        <div class="col-md-3">
                            <p class="fs-16">Rp 27.000.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Aturan Menginap</h5>
                </div>
                <div class="card-body">
                    <p><strong>Check-in:</strong> Mulai pukul 14.00</p>
                    <p><strong>Check-out:</strong> Sampai pukul 12.00</p>
                    <p><strong>Late Check-out:</strong> Denda 50% dari harga kamar</p>
                    <hr>
                    <p><strong>Kebijakan Anak:</strong></p>
                    <p>Anak-anak bisa menginap.</p>
                    <p>Anak berusia 6 tahun ke atas akan dikenakan harga dewasa di akomodasi ini.</p>
                    <p>Tidak tersedia ranjang bayi dan tempat tidur ekstra di akomodasi ini.</p>
                    <hr>
                    <p><strong>Batasan Usia:</strong> Usia minimum untuk check-in adalah 18</p>
                    <hr>
                    <p><strong>Hewan Peliharaan:</strong> Hewan peliharaan tidak diperbolehkan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
