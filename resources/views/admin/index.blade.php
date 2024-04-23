@extends('admin.layout.template')

@section('konten')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Refresh Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Kamar Kosong</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Kamar::where('status', 'tersedia')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pesanan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Penyewaan::where('status', 'Belum Dikonfirmasi')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Barang
                                Sewa berlangsung
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            @php
                                                use Illuminate\Support\Carbon;
                                                $today = Carbon::now();
                                                $countPenyewaan = \App\Models\Penyewaan::where('status', 'Sewa Berhasil Dikonfirmasi')
                                                    ->get()
                                                    ->filter(function ($item) use ($today) {
                                                        return Carbon::parse($item->tanggal_masuk)->addMonths($item->jangka_sewa)->isFuture();
                                                    })
                                                    ->count();
                                            @endphp
                                            {{ $countPenyewaan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Member Terdaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\User::where('role', 'admin')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Nomor WhatsApp</th>
                                        <th>Status User</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                    @foreach ($user as $item)
                                    @if ($item->role == 'user')
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td>
                                            <button
                                                class="badge bg-{{ $item->status == 'Tidak Aktif' ? 'warning' : 'success' }} border-0">
                                                {{ $item->status == 'Tidak Aktif' ? 'Tidak Aktif' : 'Akun Aktif' }}
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="example_kamar" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nomor Kamar</th>
                                        <th>Lokasi</th>
                                        <th>Harga</th>
                                        <th>Status Kamar</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                    @foreach ($kamar as $item)
                                    <tr>
                                        <td>{{ $item->nomor }}</td>
                                        <td>{{ $item->lokasi == 'lantai1' ? 'Lantai 1' : 'Lantai 2' }}</td>
                                        <td>Rp.{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <button
                                                class="badge bg-{{ $item->status == 'tersedia' ? 'success' : 'warning' }} border-0">
                                                {{ $item->status == 'tersedia' ? 'Kamar Tersedia' : 'Tidak Tersedia' }}
                                            </button>
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
    </div> --}}
   
</div>

@endsection