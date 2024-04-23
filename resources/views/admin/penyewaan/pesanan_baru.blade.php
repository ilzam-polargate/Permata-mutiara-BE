@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pemesanan Baru</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Pemesanan Baru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor Kamar</th>
                                <th>Nama</th>
                                <th>WhatsApp</th>
                                <th>Tanggal Reservasi</th>
                                <th>Tanggal Masuk</th>
                                <th>Jangka Sewa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewa as $item)
                            <tr>
                                <td>{{ $item->kamar->nomor }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->number }}</td>
                                <td>{{ $item->created_at->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d F Y') }}</td>
                                <td>{{ $item->jangka_sewa }} Bulan</td>
                                <td>
                                    <div class="d-flex justify-content-start gap-2">
                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#updateStatus{{ $item->id }}"><i
                                                class="bi bi-check-lg"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="updateStatus{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahModalLabel">Konfirmasi Pesanan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Nomor Kamar</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name="" value="{{ $item->kamar->nomor }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Nama Penghuni</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name="" value="{{ $item->user->name }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Tanggal Reservasi</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name=""
                                                                        value="{{ $item->created_at->format('d F Y') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Tanggal Masuk</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name=""
                                                                        value="{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d F Y') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Jangka Sewa</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name="" value="{{ $item->jangka_sewa }} Bulan"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="">Total Harga</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        name=""
                                                                        value="Rp. {{  number_format($item->kamar->harga * $item->jangka_sewa, 0, ',', '.') }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('penyewaan.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input hidden type="text" name="status"
                                                                value="Sewa Berhasil Dikonfirmasi">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Konfirmasi
                                                                Sewa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('penyewaan.destroy', $item->id) }}" method="POST"
                                            class="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </form>
                                    </div>
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