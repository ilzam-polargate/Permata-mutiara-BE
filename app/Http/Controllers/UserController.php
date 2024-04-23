<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $userRole = auth()->user()->role;

    // Periksa apakah peran pengguna adalah 'admin' atau 'superadmin'
    if ($userRole == 'admin' || $userRole == 'superadmin') {
        // Jika peran pengguna memenuhi syarat, tampilkan halaman index user
        return view('admin.user.index', [
            'user' => User::get()
        ]);
    }

    // Jika peran pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
    return redirect()->route('home');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $userRole = auth()->user()->role;

    // Periksa apakah peran pengguna adalah 'admin' atau 'superadmin'
    if ($userRole == 'admin' || $userRole == 'superadmin') {
        // Jika peran pengguna memenuhi syarat, tampilkan halaman profile dengan data user
        $admin = User::findOrFail($id);
        return view('admin.profile.index', compact('admin'));
    }

    // Jika peran pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
    return redirect()->route('home');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $userRole = auth()->user()->role;

    // Periksa apakah peran pengguna adalah 'admin' atau 'superadmin'
    if ($userRole == 'admin' || $userRole == 'superadmin') {
        // Validasi data yang diterima dari request
        $data = $this->validate($request, [
            // 'role' => 'required',
            'password' => 'required',
        ]);

        // Enkripsi password yang diterima sebelum disimpan
        $data['password'] = Hash::make($data['password']);

        // Update data pengguna berdasarkan ID yang diberikan
        User::where('id', $id)->update($data);

        return redirect()->route('user.index')->with(['success' => 'Berhasil merubah data User']);
    }

    // Jika peran pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
    return redirect()->route('home');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $userRole = auth()->user()->role;

    // Periksa apakah peran pengguna adalah 'admin' atau 'superadmin'
    if ($userRole == 'admin' || $userRole == 'superadmin') {
        // Hapus user dengan ID yang diberikan jika peran pengguna memenuhi syarat
        User::where('id', $id)->firstOrFail()->delete();
        return redirect()->route('user.index')->with(['success' => 'Berhasil menghapus data user']);
    }

    // Jika peran pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
    return redirect()->route('home');
}

    public function passwordAdmin(Request $request)
    {
        $userRole = auth()->user()->role;
    
        // Periksa apakah peran pengguna adalah 'admin' atau 'superadmin'
        if ($userRole == 'admin' || $userRole == 'superadmin') {
            // Validasi data yang diterima dari request
            $data = $this->validate($request, [
                'password' => 'required|min:8|confirmed',
            ]);
    
            // Update password pengguna yang sedang login
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($data['password']),
            ]);
    
            return redirect()->back()->with(['success' => 'Berhasil merubah password']);
        }
    
        // Jika peran pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
        return redirect()->route('home');
    }

    public function addUser(Request $request)
{
    // Periksa peran pengguna saat ini
    $userRole = auth()->user()->role;

    // Hanya izinkan 'admin' dan 'superadmin' untuk menambah pengguna
    if ($userRole == 'admin' || $userRole == 'superadmin') {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,superadmin',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal harus 8 karakter',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role yang dipilih tidak valid',
        ]);

        try {
            // Buat pengguna baru berdasarkan data yang divalidasi
            $user = new User();
            $user->username = $validatedData['username'];
            $user->password = Hash::make($validatedData['password']);
            $user->role = $validatedData['role'];
            $user->save();

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->route('user.index')->with('error', 'Gagal menambahkan user');
        }
    }

    // Jika pengguna bukan 'admin' atau 'superadmin', redirect ke halaman lain
    return redirect()->route('home')->with('error', 'Anda tidak memiliki izin untuk menambah pengguna');
}
    
}
