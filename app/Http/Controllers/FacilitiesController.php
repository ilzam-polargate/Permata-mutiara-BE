<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FacilitiesController extends Controller
{
    // Menampilkan semua fasilitas
    public function index()
    {
        $facilities = Facilities::all();
        return response()->json(['facilities' => $facilities], 200);
    }

    // Menampilkan detail fasilitas berdasarkan ID
    public function show($id)
    {
        $facilities = Facilities::findOrFail($id);
        return response()->json(['facilities' => $facilities], 200);
    }

    // Membuat fasilitas baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facilities_category_id' => 'required|exists:facilities_categories,id',
            'facilities_name' => 'required|string',
            'facilities_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File gambar dengan batasan ukuran dan tipe tertentu
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('facilities_image')) {
            $imagePath = $request->file('facilities_image')->store('public/facilities_images');
            $data['facilities_image'] = $imagePath;
        }

        $facilities = Facilities::create($data);

        return response()->json(['message' => 'Facility created successfully', 'facilities' => $facilities], 201);
    }

    // Mengupdate fasilitas berdasarkan ID
    public function update(Request $request, $id)
    {
        $facilities = Facilities::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'facilities_category_id' => 'required|exists:facilities_categories,id',
            'facilities_name' => 'required|string',
            'facilities_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File gambar dengan batasan ukuran dan tipe tertentu
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('facilities_image')) {
            // Hapus gambar lama jika ada
            if ($facilities->facilities_image) {
                Storage::delete($facilities->facilities_image);
            }
            $imagePath = $request->file('facilities_image')->store('public/facilities_images');
            $data['facilities_image'] = $imagePath;
        }

        $facilities->update($data);

        return response()->json(['message' => 'Facility updated successfully', 'facilities' => $facilities], 200);
    }

    // Menghapus fasilitas berdasarkan ID
    public function destroy($id)
    {
        $facilities = Facilities::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($facilities->facilities_image) {
            Storage::delete($facilities->facilities_image);
        }

        $facilities->delete();

        return response()->json(['message' => 'Facility deleted successfully'], 200);
    }
}
