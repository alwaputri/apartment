<!-- create.blade.php -->
@extends('layout.layout')

@section('content')
@php
    $pageTitle = "Tambah Kamar"; // Title for Tambah Kamar page
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
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <h4 class="card-title">Tambah Kamar Baru</h4>
                    <form action="{{ route('room.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="no_kamar">Nomor Kamar</label>
                            <input type="text" name="no_kamar" class="form-control" required>
                        </div>
                        <!-- Set the status to "Available" by default -->
                        <input type="hidden" name="status" value="Available">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('kamars.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.notif', ['pageTitle' => $pageTitle])
@endsection
