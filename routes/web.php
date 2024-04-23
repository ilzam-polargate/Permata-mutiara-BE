<?php

use App\Models\User;
use App\Models\Kamar;
use App\Models\Penyewaan;
use App\Models\GambarKamar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\GambarKamarController;
use App\Http\Controllers\PageSettingController;
use App\Http\Controllers\auth\AuthenticateController;
use App\Models\PageSetting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// user site
Route::get('/', function () {
    return view('admin.index', [
        'kamar' => Kamar::get(),
        'admin' => User::where('role', 'admin')->first(),
        'page' => PageSetting::where('id', '1')->first()
    ]);
})->name('home');

Route::get('/profile', function () {
    return view('user.profile.index', [
        'penyewaan' => Penyewaan::where('id_user', auth()->user()->id)->get(),
        'admin' => User::where('role', 'admin')->first(),
        'page' => PageSetting::where('id', '1')->first()
    ]);
})->name('profile')->middleware('auth');

Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile')->middleware('auth');
// user site

// admin site
Route::resource('/kamar', KamarController::class)->middleware('auth');
Route::resource('/gambarKamar', GambarKamarController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware('auth');
Route::resource('/penyewaan', PenyewaanController::class)->middleware('auth');
Route::get('/pesanan-baru', [PenyewaanController::class, 'pesanan_baru'])->name('pesanan.baru')->middleware('auth');
Route::get('/sewa-berlangsung', [PenyewaanController::class, 'sewa_berlangsung'])->name('sewa.berlangsung')->middleware('auth');
Route::get('/riwayat-transaksi', [PenyewaanController::class, 'riwayat_transaksi'])->name('riwayat.transaksi')->middleware('auth');
Route::put('/tambah_jangka_sewa/{id}', [PenyewaanController::class, 'tambah_jangka_sewa'])->name('tambah_jangka_sewa')->middleware('auth');
Route::put('/password_admin', [UserController::class, 'passwordAdmin'])->name('password_admin')->middleware('auth');

Route::get('/page_setting_index', [PageSettingController::class, 'index'])->name('page.index')->middleware('auth');
Route::put('/page_setting_update', [PageSettingController::class, 'update'])->name('page.update')->middleware('auth');

Route::get('/gambar/{id}', function ($id) {
    if (auth()->user()->role == 'admin') {
        $item = Kamar::findOrFail($id);
        return view('admin.kamar.gambar', [
            'item' => $item,
            'gambar' => GambarKamar::where('id_kamar', $item->id)->get(),
        ]);
    }
    return redirect()->route('home');
})->name('gambar');
// admin site

// authentication
Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

//addUser
Route::post('/addUser', [UserController::class, 'addUser'])->name('addUser');