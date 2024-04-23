<?php

namespace App\Http\Controllers;

use App\Models\FacilitiesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FacilitiesCategoryController extends Controller
{
    // Menampilkan semua kategori fasilitas
    public function index()
    {
        $categories = FacilitiesCategory::all();
        return response()->json(['categories' => $categories], 200);
    }

    // Menampilkan detail kategori fasilitas berdasarkan ID
    public function show($id)
    {
        $category = FacilitiesCategory::findOrFail($id);
        return response()->json(['category' => $category], 200);
    }

    // Membuat kategori fasilitas baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_title' => 'required|string',
            'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cat_subtitle' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('cat_image')) {
            $imagePath = $request->file('cat_image')->store('public/facility_images');
            $data['cat_image'] = $imagePath;
        }

        $category = FacilitiesCategory::create($data);

        return response()->json(['message' => 'Facilities category created successfully', 'category' => $category], 201);
    }

    // Mengupdate kategori fasilitas berdasarkan ID
    public function update(Request $request, $id)
    {
        $category = FacilitiesCategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'cat_title' => 'required|string',
            'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cat_subtitle' => 'nullable|string',
            'updated_by' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('cat_image')) {
            // Hapus gambar lama jika ada
            if ($category->cat_image) {
                Storage::delete($category->cat_image);
            }
            $imagePath = $request->file('cat_image')->store('public/facility_images');
            $data['cat_image'] = $imagePath;
        }

        $category->update($data);

        return response()->json(['message' => 'Facilities category updated successfully', 'category' => $category], 200);
    }

    // Menghapus kategori fasilitas berdasarkan ID
    public function destroy($id)
    {
        $category = FacilitiesCategory::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($category->cat_image) {
            Storage::delete($category->cat_image);
        }

        $category->delete();

        return response()->json(['message' => 'Facilities category deleted successfully'], 200);
    }
}
