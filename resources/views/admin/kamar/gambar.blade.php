@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gambar Kamar Nomor {{ $item->nomor }}</h1>
        <div class="align-item-end">
            <a href="{{ route('kamar.index') }}" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-skip-backward"></i>
                Kembali
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Gambar harus berupa JPG, JPEG, atau PNG dan max 2MB
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Gambar</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('gambarKamar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kamar" value="{{ $item->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="file" class="form-control" name="gambar" style="margin-right: 10px" required>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        @foreach ($gambar as $row)
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 position-relative">
                            <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                data-ripple-color="light">
                                <img src="{{ asset('storage/gambarKamar/'.$row->gambar) }}" class="w-100" />
                                <form action="{{ route('gambarKamar.destroy', $row->id) }}" method="POST" class="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                        style="z-index: 1;margin-right:22px;margin-top:10px"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection