<?php

namespace App\Http\Controllers;

use App\Models\ImageBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ImageBannerController extends Controller
{
    // Menampilkan semua image banner
    public function index()
    {
        $imageBanners = ImageBanner::all();
        return response()->json(['imageBanners' => $imageBanners], 200);
    }

    // Menampilkan detail image banner berdasarkan ID
    public function show($id)
    {
        $imageBanner = ImageBanner::findOrFail($id);
        return response()->json(['imageBanner' => $imageBanner], 200);
    }

    // Membuat image banner baru
    public function store(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'image_banner' => 'required|file', // Memastikan input image_banner adalah file
            'headline' => 'required|string',
            'subheadline' => 'required|string',
            'text_button' => 'required|string',
        ]);

        // Jika validasi gagal, kirim response error 400
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menyimpan file ke storage dan mendapatkan path file
        $imagePath = $request->file('image_banner')->store('public/images');

        // Membuat record image banner baru di database
        $imageBanner = ImageBanner::create([
            'image_banner' => $imagePath, // Simpan path file ke dalam kolom image_banner
            'headline' => $request->headline,
            'subheadline' => $request->subheadline,
            'text_button' => $request->text_button,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        // Mengembalikan response sukses dengan data image banner yang baru dibuat
        return response()->json(['message' => 'Image banner created successfully', 'imageBanner' => $imageBanner], 201);
    }

    // Mengupdate image banner berdasarkan ID
    public function update(Request $request, $id)
{
    $imageBanner = ImageBanner::findOrFail($id);

    // Validasi input teks yang wajib diisi (headline, subheadline, text_button)
    $validator = Validator::make($request->all(), [
        'headline' => 'required|string',
        'subheadline' => 'required|string',
        'text_button' => 'required|string',
    ]);

    // Jika validasi input teks gagal, kirim respons error 400
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Mendapatkan user yang sedang login
    $user = Auth::user();

    // Update kolom-kolom yang diperbolehkan
    $imageBanner->headline = $request->headline; // Mengambil nilai langsung dari form-data
    $imageBanner->subheadline = $request->subheadline; // Mengambil nilai langsung dari form-data
    $imageBanner->text_button = $request->text_button; // Mengambil nilai langsung dari form-data
    $imageBanner->updated_by = $user->id;

    // Cek apakah ada file gambar yang diunggah
    if ($request->hasFile('image_banner')) {
        // Validasi file gambar
        $fileValidator = Validator::make($request->all(), [
            'image_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Batasan tipe dan ukuran gambar
        ]);

        // Jika validasi file gagal, kirim respons error 400
        if ($fileValidator->fails()) {
            return response()->json(['errors' => $fileValidator->errors()], 400);
        }

        // Hapus file gambar lama jika ada
        if ($imageBanner->image_banner) {
            Storage::delete($imageBanner->image_banner);
        }

        // Simpan file gambar baru ke storage
        $imagePath = $request->file('image_banner')->store('public/images');

        // Update kolom image_banner dengan path baru
        $imageBanner->image_banner = $imagePath;
    }

    // Simpan perubahan pada model ImageBanner
    $imageBanner->save();

    // Kirim respons sukses
    return response()->json(['message' => 'Image banner updated successfully', 'imageBanner' => $imageBanner], 200);
}

    // Menghapus image banner berdasarkan ID
    public function destroy($id)
    {
        $imageBanner = ImageBanner::findOrFail($id);
        $imageBanner->delete();
        return response()->json(['message' => 'Image banner deleted successfully'], 200);
    }
}
