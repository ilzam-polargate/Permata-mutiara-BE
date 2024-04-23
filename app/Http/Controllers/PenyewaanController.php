<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'id_kamar' => 'required',
            'id_user' => 'required',
            'tanggal_masuk' => 'required',
            'jangka_sewa' => 'required',
            'status' => 'required',
        ]);

        $penyewaan = new Penyewaan();
        $penyewaan->id_kamar = $request->id_kamar;
        $penyewaan->id_user = $request->id_user;
        $penyewaan->tanggal_masuk = $request->tanggal_masuk;
        $penyewaan->jangka_sewa = $request->jangka_sewa;
        $penyewaan->status = $request->status;
        $penyewaan->save();

        Kamar::where('id', $request->id_kamar)->update(['status' => 'terisi']);

        return redirect()->route('profile')->with(['success' => 'Berhasil melakukan pemesanan, periksa menu data sewa kamar']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        Penyewaan::where('id', $id)->update(['status' => $request->status]);
        return redirect()->route('sewa.berlangsung')->with(['success' => 'Berhasil mengkonfirmasi pesanan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $data = Penyewaan::where('id', $id)->firstOrFail();
        $data->delete();
        Kamar::where('id', $data->id_kamar)->update(['status' => 'tersedia']);
        if (auth()->user()->role == 'admin') {
            return redirect()->back()->with(['success' => 'Berhasil menghapus pemesanan']);
        } else {
            return redirect()->route('profile')->with(['success' => 'Berhasil membatalkan pemesanan']);
        }
    }

    // penyewaan
    public function pesanan_baru()
    {
        return view('admin.penyewaan.pesanan_baru', [
            'sewa' => Penyewaan::where('status', 'Belum Dikonfirmasi')->get()
        ]);
    }

    public function sewa_berlangsung()
    {
        $today = Carbon::now();
        return view('admin.penyewaan.sewa_berlangsung', [
            'sewa' => Penyewaan::where('status', 'Sewa Berhasil Dikonfirmasi')
                ->get()
                ->filter(function ($item) use ($today) {
                    return Carbon::parse($item->tanggal_masuk)->addMonths($item->jangka_sewa)->isFuture();
                })
        ]);
    }

    public function riwayat_transaksi()
    {
        $sewa = Penyewaan::where('status', 'Sewa Berhasil Dikonfirmasi')->get();
        $today = Carbon::now();
        return view('admin.penyewaan.riwayat_transaksi', [
            'sewa' => $sewa->filter(function ($item) use ($today) {
                return Carbon::parse($item->tanggal_masuk)->addMonths($item->jangka_sewa)->lte($today);
            })
        ]);
    }

    public function tambah_jangka_sewa(Request $request, string $id)
    {
        Penyewaan::where('id', $id)->update(['jangka_sewa' => $request->jangka_sewa]);
        return redirect()->back()->with(['success' => 'Berhasil menambah jangka sewa']);
    }
    // penyewaan
}
