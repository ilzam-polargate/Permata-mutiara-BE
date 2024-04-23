@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Riwayat Transaksi</h1>
        <div class="align-item-end">
            <a href="" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                data-toggle="modal" data-target="#tambahModal">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Refresh Data
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Sewa Berlangsung</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor Kamar</th>
                                <th>Nama</th>
                                <th>Jangka Sewa</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewa as $item)
                            <tr>
                                <td>{{ $item->kamar->nomor }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->jangka_sewa }} Bulan</td>
                                <td>Rp. {{ number_format($item->kamar->harga, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item->kamar->harga * $item->jangka_sewa, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d F Y') }}</td>
                                <td>
                                    @php
                                    $tanggalMasuk = \Carbon\Carbon::parse($item->tanggal_masuk);
                                    $endDate = $tanggalMasuk->addMonths($item->jangka_sewa);
                                    @endphp
                                    {{ $endDate->format('d F Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection