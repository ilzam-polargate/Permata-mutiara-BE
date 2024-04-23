<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            return view('admin.kamar.index', [
                'kamar' => Kamar::get()
            ]);
        }
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
        if (auth()->user()->role == 'admin') {
            $data = $this->validate($request, [
                'nomor' => 'required',
                'harga' => 'required',
                'fasilitas' => 'required',
                'lokasi' => 'required',
                'status' => 'required',
                'keterangan' => 'required'
            ]);

            $data['fasilitas'] = implode(', ', $data['fasilitas']);

            Kamar::create($data);

            return redirect()->back()->with(['success' => 'Berhasil menambah Kamar']);
        }
        return redirect()->route('home');
    }


    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role == 'admin') {
            $data = $this->validate($request, [
                'nomor' => 'required',
                'harga' => 'required',
                'fasilitas' => 'required',
                'lokasi' => 'required',
                'status' => 'required',
                'keterangan' => 'required'
            ]);

            $data['fasilitas'] = implode(', ', $data['fasilitas']);

            Kamar::where('id', $id)->update($data);

            return redirect()->route('kamar.index')->with(['success' => 'Berhasil merubah data Kamar']);
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role == 'admin') {
            $kamar = Kamar::where('id', $id)->firstOrFail();
            $kamar->delete();
            return redirect()->route('kamar.index')->with(['success' => 'Berhasil menghapus Kamar']);
        }
        return redirect()->route('home');
    }
}
