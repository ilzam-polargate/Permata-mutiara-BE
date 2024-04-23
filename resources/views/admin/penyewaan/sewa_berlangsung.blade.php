@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Sewa Berlangsung</h1>
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
                                <th>Total Harga</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sewa as $item)
                            <tr>
                                <td>{{ $item->kamar->nomor }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->jangka_sewa }} Bulan</td>
                                <td>Rp. {{ number_format($item->kamar->harga * $item->jangka_sewa, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d F Y') }}</td>
                                <td>
                                    @php
                                    $tanggalMasuk = \Carbon\Carbon::parse($item->tanggal_masuk);
                                    $endDate = $tanggalMasuk->addMonths($item->jangka_sewa);
                                    @endphp
                                    {{ $endDate->format('d F Y') }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start gap-2">
                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#jangkaSewa{{ $item->id }}"><i
                                                class="bi bi-plus-lg"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="jangkaSewa{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahModalLabel">Tambah Jangka Sewa
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tambah_jangka_sewa', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                class="btn btn-primary rounded-0"
                                                                                onclick="decrementValue()">-</button>
                                                                        </span>
                                                                        <input type="text" class="form-control"
                                                                            name="jangka_sewa"
                                                                            value="{{ $item->jangka_sewa }}"
                                                                            style="pointer-events: none;">
                                                                        <span class="input-group-btn">
                                                                            <button type="button"
                                                                                class="btn btn-primary rounded-0"
                                                                                onclick="incrementValue()">+</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="d-grid gap-2">
                                                                        <button type="submit"
                                                                            class="btn btn-primary rounded-0">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <script>
                                                            function incrementValue() {
                                                            var value = parseInt(document.querySelector('input[name="jangka_sewa"]').value, 10);
                                                            value = isNaN(value) ? {{ $item->jangka_sewa }} : value;
                                                            value++;
                                                            document.querySelector('input[name="jangka_sewa"]').value = value;
                                                        }
                                                    
                                                        function decrementValue() {
                                                            var value = parseInt(document.querySelector('input[name="jangka_sewa"]').value, 10);
                                                            value = isNaN(value) ? {{ $item->jangka_sewa }} : value;
                                                            if (value > {{ $item->jangka_sewa }}) {
                                                                value--;
                                                                document.querySelector('input[name="jangka_sewa"]').value = value;
                                                            }
                                                        }
                                                        </script>
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