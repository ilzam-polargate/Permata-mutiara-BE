@extends('admin.layout.template')

@section('konten')
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ Auth()->user()->username }}</h6>
                </div>
                <div class="card-body">
                    <style>
                        body {
                            background: -webkit-linear-gradient(left, #ececec, #d4d4d4);
                        }


                        .profile-head h6 {
                            color: #0062cc;
                        }


                        .proile-rating {
                            font-size: 12px;
                            color: #818182;
                            margin-top: 5%;
                        }

                        .proile-rating span {
                            color: #495057;
                            font-size: 15px;
                            font-weight: 600;
                        }

                        .profile-head .nav-tabs {
                            margin-bottom: 5%;
                        }

                        .profile-head .nav-tabs .nav-link {
                            font-weight: 600;
                            border: none;
                        }

                        .profile-head .nav-tabs .nav-link.active {
                            border: none;
                            border-bottom: 2px solid #0062cc;
                        }

                        .profile-work {
                            padding: 14%;
                            margin-top: -15%;
                        }

                        .profile-work p {
                            font-size: 12px;
                            color: #818182;
                            font-weight: 600;
                            margin-top: 10%;
                        }

                        .profile-work a {
                            text-decoration: none;
                            color: #495057;
                            font-weight: 600;
                            font-size: 14px;
                        }

                        .profile-work ul {
                            list-style: none;
                        }

                        .profile-tab label {
                            font-weight: 600;
                        }

                        .profile-tab p {
                            font-weight: 600;
                            color: #0062cc;
                        }
                    </style>

                    <div class="container emp-profile">

                        @if (session('success'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            // Menampilkan SweetAlert ketika halaman dimuat dan terdapat 'success' dalam session
                            document.addEventListener('DOMContentLoaded', function() {
                                if ("{{ session('success') }}") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: "{{ session('success') }}",
                                        showConfirmButton: false,
                                        timer: 3000  // Notifikasi akan hilang setelah 3 detik
                                    });
                                }
                            });
                        </script>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Terdapat field yang belum diisi..
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            </div>
                            <div class="col-md-6">
    <div class="profile-head">
        <h5>
            Ganti Password
        </h5>
        <p class="proile-rating" style="margin-bottom: 60px"></p>
        <form id="changePasswordForm" action="{{ route('password_admin') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="password" class="form-label mb-2">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control mb-2" required>

            <label for="password_confirmation" class="form-label mb-2">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mb-2" required>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
        var newPassword = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;

        // Periksa apakah password baru minimal 8 karakter
        if (newPassword.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password harus minimal 8 karakter!',
            });
            event.preventDefault(); // Mencegah pengiriman formulir
            return;
        }

        // Periksa apakah konfirmasi password sesuai dengan password baru
        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Konfirmasi password tidak sesuai dengan password baru!',
            });
            event.preventDefault(); // Mencegah pengiriman formulir
            return;
        }
    });
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection