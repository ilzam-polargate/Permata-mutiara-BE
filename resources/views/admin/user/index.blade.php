@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Admin</h1>
        <div class="align-item-end">
            <a href="" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Refresh Page
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

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                </div>

                <button class="btn btn-sm btn-success mx-1" type="button" data-toggle="modal"
        data-target="#addUserModal"><i class="bi bi-person-add"></i> Tambah User</button>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="{{ route('addUser') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (Minimal 8 karakter)</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div id="passwordError" class="text-danger"></div> <!-- Tempat menampilkan pesan kesalahan -->
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        // Dapatkan nilai password dari input
        var password = document.getElementById('password').value;

        // Periksa apakah panjang password kurang dari 8 karakter
        if (password.length < 8) {
            // Tampilkan pesan kesalahan di elemen dengan id 'passwordError'
            document.getElementById('passwordError').innerText = 'Password harus minimal 8 karakter';
            event.preventDefault(); // Mencegah pengiriman formulir
        } else {
            // Bersihkan pesan kesalahan jika password sudah valid
            document.getElementById('passwordError').innerText = '';
        }
    });
</script>

                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($user as $item)
                            @if ($item->role == 'admin')
                            <tr>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    <div class="d-flex justify-content-start gap-2">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal"
                                            data-target="#showUser{{ $item->id }}"><i class="bi bi-eye"></i></button>
                                        <div class="modal fade" id="showUser{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="lihatModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihatModalLabel">Data
                                                            Admin</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><strong>Username :</strong> {{ $item->username }}</li>
                                                            <li class="list-group-item"><strong>Role :</strong> {{ $item->role }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                            data-target="#editUser{{ $item->id }}"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <div class="modal fade" id="editUser{{ $item->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="lihatModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="lihatModalLabel">Edit
                                                            Admin</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="role" value="admin">

                                                            {{-- <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group mb-4">
                                                                        <label for="role">Role</label>
                                                                        <select name="role" id="" class="form-control">
                                                                            <option hidden value="{{ $item->role }}">{{
                                                                                $item->role }}</option>
                                                                            <option value="Admin">Admin</option>
                                                                            <option value="superadmin">Superadmin</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="form-group mb-4">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control"
                                                                    id="password" name="password"
                                                                    value="{{ substr($item->password, 0, 8) }}">
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST"
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
@endsection