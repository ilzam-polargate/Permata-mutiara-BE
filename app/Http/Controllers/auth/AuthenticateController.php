<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('auth.register', $data);
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|string|max:250',
    //         'email' => 'required|email|max:250|unique:users',
    //         'number' => 'required|string|max:15',
    //         'password' => 'required|min:8|confirmed',
    //         'role' => 'required'
    //     ]);

    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->number = $request->number;
    //     $user->password = bcrypt($request->password);
    //     $user->role = $request->role;
    //     $user->save();

    //     $credentials = $request->only('email', 'password');
    //     Auth::attempt($credentials);

    //     $request->session()->regenerate();

    //     return redirect()->route('home');
    // }


    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $data = [
            'title' => 'Login Page',
        ];
        return view('auth.login', $data);
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Periksa role pengguna setelah berhasil login
        $userRole = auth()->user()->role;

        if ($userRole == 'superadmin' || $userRole == 'admin') {
            return redirect()->route('dashboard');
        } else {
            // Jika role tidak sesuai, tambahkan logika redirect yang sesuai
            // Misalnya, arahkan ke halaman lain jika perlu
            return redirect()->route('home'); // Contoh arahkan ke halaman home
        }
    }

    // Jika autentikasi gagal, kembali ke halaman sebelumnya dengan pesan error
    return back()->withErrors(['username' => 'Terdapat inkonsistensi antara alamat email dan kata sandi.'])->onlyInput('email');
}

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
{
    // Ambil data yang diperlukan untuk dashboard
    $data = [
        'title' => 'Dashboard',
        'kamar' => Kamar::get()
    ];

    // Periksa apakah pengguna sudah login
    if (Auth::check()) {
        $userRole = auth()->user()->role;

        // Periksa role pengguna
        if ($userRole == 'superadmin') {
            // Jika role adalah superadmin, tampilkan dashboard admin
            return view('admin.index', $data);
        } elseif ($userRole == 'admin') {
            // Jika role adalah admin, tampilkan dashboard admin
            return view('admin.index', $data);
        } else {
            // Jika role bukan superadmin atau admin, redirect sesuai kebutuhan
            return redirect()->route('dashboard'); // Ganti dengan redirect ke halaman lain jika perlu
        }
    } else {
        // Jika pengguna belum login, arahkan ke halaman login dengan pesan error
        return redirect()->route('login')->withErrors(['username' => 'Please login to access the dashboard.'])->onlyInput('username');
    }
}


    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You have logged out successfully!');;
    }
}
