@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kamar</h1>
        <div class="align-item-end">
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#tambahModal">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Tambah Kamar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahModalLabel">Tambah Kamar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kamar.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nomor">Nomor Kamar</label>
                                            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Kamar">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="harga">Harga Sewa</label>
                                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Contoh: 300000">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fasilitas">Fasilitas Kamar</label>
                                    <div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Tidak Ada"
                                                        id="Tidak Ada" name="fasilitas[]">
                                                    <label class="form-check-label" for="Tidak Ada">
                                                        Tidak Ada
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kamar Mandi"
                                                        id=" Kamar Mandi" name="fasilitas[]">
                                                    <label class="form-check-label" for=" Kamar Mandi">
                                                        Kamar Mandi
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Dapur"
                                                        id="Dapur" name="fasilitas[]">
                                                    <label class="form-check-label" for="Dapur">
                                                        Dapur
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Ruang Tengah"
                                                        id="Ruang Tengah" name="fasilitas[]">
                                                    <label class="form-check-label" for="Ruang Tengah">
                                                        Ruang Tengah
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Teras"
                                                        id="Teras" name="fasilitas[]">
                                                    <label class="form-check-label" for="Teras">
                                                        Teras
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Gudang"
                                                        id="Gudang" name="fasilitas[]">
                                                    <label class="form-check-label" for="Gudang">
                                                        Gudang
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kipas Angin"
                                                        id="Kipas Angin" name="fasilitas[]">
                                                    <label class="form-check-label" for="Kipas Angin">
                                                        Kipas Angin
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Ac"
                                                        id="Ac" name="fasilitas[]">
                                                    <label class="form-check-label" for="Ac">
                                                        Ac
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Lemari"
                                                        id="Lemari" name="fasilitas[]">
                                                    <label class="form-check-label" for="Lemari">
                                                        Lemari
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kasur"
                                                        id="Kasur" name="fasilitas[]">
                                                    <label class="form-check-label" for="Kasur">
                                                        Kasur
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Kompor"
                                                        id="Kompor" name="fasilitas[]">
                                                    <label class="form-check-label" for="Kompor">
                                                        Kompor
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Listrik"
                                                        id="Listrik" name="fasilitas[]">
                                                    <label class="form-check-label" for="Listrik">
                                                        Listrik
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Air"
                                                        id="Air" name="fasilitas[]">
                                                    <label class="form-check-label" for="Air">
                                                        Air
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi Kamar</label>
                                            <select name="lokasi" id="" class="form-control">
                                                <option hidden value="">Pilih Opsi</option>
                                                <option value="lantai1">Lantai 1</option>
                                                <option value="lantai2">Lantai 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option hidden value="">Pilih Opsi</option>
                                                <option value="tersedia">Kamar Tersedia</option>
                                                <option value="terisi">Kamar Terisi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea type="text" class="form-control" id="keterangan"
                                        name="keterangan" placeholder="Berikan (-) jika tidak ada keterangan"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor Kamar</th>
                                <th>LokasiKamar</th>
                                <th>Harga Sewa</th>
                                <th>Status Kamar</th>
                                <th>Aksi</th>
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
                                        class="badge bg-{{ $item->status == 'terisi' ? 'warning' : 'success' }} border-0">
                                        {{ $item->status == 'terisi' ? 'Kamar Terisi' : 'Kamar Tersedia' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start gap-2">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                            data-target="#showKamar{{ $item->id }}"><i class="bi bi-eye"></i></button>
                                        <div class="modal fade" id="showKamar{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="lihatModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihatModalLabel">Detail
                                                            Kamar</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><strong>Nomor Kamar :</strong>
                                                                {{ $item->nomor }}</li>
                                                            <li class="list-group-item"><strong>Harga Sewa :</strong>
                                                                Rp.{{ number_format($item->harga, 0, ',', '.') }}</li>
                                                            <li class="list-group-item"><strong>Fasilitas Kamar
                                                                    :</strong> {{ $item->fasilitas }}</li>
                                                            <li class="list-group-item"><strong>Lokasi Kamar :</strong>
                                                                {{ $item->lokasi }}</li>
                                                            <li class="list-group-item"><strong>Status Kamar :</strong>
                                                                {{ $item->status }}</li>
                                                            <li class="list-group-item"><strong>Keterangan :</strong> {{
                                                                $item->keterangan }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('gambar', $item->id) }}" class="btn btn-sm btn-success"
                                            type="button"><i class="bi bi-card-image"></i></a>
                                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                            data-target="#editKamar{{ $item->id }}"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <div class="modal fade" id="editKamar{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="lihatModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihatModalLabel">Edit
                                                            Kamar</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('kamar.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="nomor">Nomor Kamar</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nomor" name="nomor"
                                                                            value="{{ $item->nomor }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="harga">Harga Sewa</label>
                                                                        <input type="number" class="form-control"
                                                                            id="harga" name="harga"
                                                                            value="{{ $item->harga }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fasilitas">Fasilitas Kamar</label>
                                                                <div class="row">
                                                                    @php
                                                                        $fasilitasTerpilih = array_map('trim', explode(',', $item->fasilitas));
                                                                        $fasilitasOptions = ['Tidak Ada', 'Kamar Mandi', 'Dapur', 'Ruang Tengah', 'Teras', 'Gudang', 'Kipas Angin', 'Ac', 'Lemari', 'Kasur', 'Kompor', 'Listrik', 'Air'];
                                                                    @endphp
                                                            
                                                                    @foreach ($fasilitasOptions as $option)
                                                                        <div class="col-4">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" value="{{ $option }}"
                                                                                       id="fasilitas_{{ $option }}" name="fasilitas[]" {{ in_array($option, $fasilitasTerpilih) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="fasilitas_{{ $option }}">
                                                                                    {{ $option }}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="lokasi">Lokasi Kamar</label>
                                                                        <select name="lokasi" id=""
                                                                            class="form-control">
                                                                            <option hidden value="{{ $item->lokasi }}">
                                                                                {{ $item->lokasi }}</option>
                                                                            <option value="lantai1">Lantai 1</option>
                                                                            <option value="lantai2">Lantai 2</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="status">Status</label>
                                                                        <select name="status" id=""
                                                                            class="form-control">
                                                                            <option hidden value="{{ $item->status }}">
                                                                                {{ $item->status }}</option>
                                                                            <option value="tersedia">Kamar Tersedia
                                                                            </option>
                                                                            <option value="terisi">Kamar Terisi</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea type="text" class="form-control"
                                                                    id="keterangan"
                                                                    name="keterangan">{{ $item->keterangan }}</textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('kamar.destroy', $item->id) }}" method="POST"
                                            class="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
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