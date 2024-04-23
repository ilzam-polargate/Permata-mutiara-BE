@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Setting Halaman</h1>
        <div class="align-item-end">
            <a href="" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-skip-backward"></i>
                Refresh
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
        Terdapat field yang belum diisi..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jumbroton</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->logo }}" name="logo">
                                <input type="text" class="form-control mb-3" value="{{ $page->header }}" name="header">
                                <textarea type="text" class="form-control mb-3" name="sub_header">{{ $page->sub_header }}</textarea>
                                <input type="file" class="form-control" value="{{ $page->img_header }}" name="img_header">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">About</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->about }}" name="about">
                                <textarea type="text" class="form-control mb-3"
                                    style="height: 153px;" name="sub_about">{{ $page->sub_about }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Layanan</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->layanan_1 }}" name="layanan_1">
                                <input type="text" class="form-control mb-3" value="{{ $page->layanan_2 }}" name="layanan_2">
                                <input type="text" class="form-control mb-3" value="{{ $page->layanan_3 }}" name="layanan_3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Sosial Media</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->twitter }}" name="twitter">
                                <input type="text" class="form-control mb-3" value="{{ $page->facebook }}" name="facebook">
                                <input type="text" class="form-control mb-3" value="{{ $page->instagram }}" name="instagram">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kamar</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->kamar }}" name="kamar">
                                <textarea type="text" class="form-control" name="sub_kamar">{{ $page->sub_kamar }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="card shadow mb-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kontak</h6>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control mb-3" value="{{ $page->kontak }}" name="kontak">
                                <textarea type="text" class="form-control" name="sub_kontak">{{ $page->sub_kontak }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary mb-4" type="submit">Update</button>
        </div>

    </form>

</div>
@endsection