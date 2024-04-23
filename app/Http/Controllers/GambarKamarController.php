<?php

namespace App\Http\Controllers;

use App\Models\GambarKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarKamarController extends Controller
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
        if (auth()->user()->role == 'admin') {
            $this->validate($request, [
                'id_kamar' => 'required',
                'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ]);

            $image = $request->file('gambar');
            $image->storeAs('public/gambarKamar', $image->hashName());

            GambarKamar::create([
                'id_kamar' => $request->id_kamar,
                'gambar' => $image->hashName(),
            ]);

            return redirect()->back()->with(['success' => 'Berhasil menambah gambar kamar']);
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GambarKamar $gambarKamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role == 'admin') {
            $gambar = GambarKamar::findOrFail($id);
            $path = 'public/gambarKamar/' . $gambar->gambar;
            Storage::delete($path);
            $gambar->delete();
            return redirect()->back()->with(['success' => 'Berhasil menghapus gambar kamar']);
        }
        return redirect()->route('home');
    }
}
