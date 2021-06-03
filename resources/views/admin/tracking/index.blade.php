@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Filter Data Pengiriman</h3>
        </div>
        <div class="card-body">
            <div class="button">
              <a href="{{ route('tracking.index') }}" class="btn btn-sm btn-success">All</a>
              <a href="{{ route('tracking.dikemas') }}" class="btn btn-sm btn-danger">Dikemas</a>
              <a href="{{ route('tracking.dikirim') }}" class="btn btn-sm btn-warning">Dikirim</a>
              <a href="{{ route('tracking.sampai') }}" class="btn btn-sm btn-primary">Sampai</a>
              <a href="{{ route('tracking.diterima') }}" class="btn btn-sm btn-success">Diterima</a>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($data as $item)
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-bold text-center">Data Pengiriman</h3>
                    <ul>
                        <li>Pelabuhan : {{ $item->nama_pelabuhan }}</li>
                        <li>Nama Kapal : {{ $item->nama_kapal }}</li>
                        <li>Total Kapal : {{ $item->qty_kapal }} Kapal</li>
                        <li>Tanggal : {{ $item->tgl_pengiriman }}</li>
                        <li>Deskripsi : {{ $item->deskripsi }}</li>
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-bold text-center">Data Pengiriman</h3>
                    <ul>
                        <li>Tidak Ada Data Yang Ditemukan!</li>
                    </ul>
                </div>
            </div>
        </div>
    @endforelse
    </div>

@endsection
