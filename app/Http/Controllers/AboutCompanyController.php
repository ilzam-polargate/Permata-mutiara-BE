<?php

namespace App\Http\Controllers;

use App\Models\AboutCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AboutCompanyController extends Controller
{
    // Menampilkan semua data perusahaan
    public function index()
    {
        $aboutCompanies = AboutCompany::all();
        return response()->json(['aboutCompanies' => $aboutCompanies], 200);
    }

    // Menampilkan detail data perusahaan berdasarkan ID
    public function show($id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);
        return response()->json(['aboutCompany' => $aboutCompany], 200);
    }

    // Membuat data perusahaan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_primary' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Hanya menerima file gambar dengan batasan ukuran dan tipe tertentu
            'caption_image' => 'nullable|string',
            'headline' => 'required|string',
            'description' => 'required|string',
            'masterplan' => 'nullable|string',
            'total_hectare' => 'integer',
            'total_housebuild' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('image_primary')) {
            $imagePath = $request->file('image_primary')->store('public/about_company_images');
            $data['image_primary'] = $imagePath;
        }

        $aboutCompany = AboutCompany::create($data);

        return response()->json(['message' => 'Data perusahaan created successfully', 'aboutCompany' => $aboutCompany], 201);
    }

    // Mengupdate data perusahaan berdasarkan ID
    public function update(Request $request, $id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_primary' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Hanya menerima file gambar dengan batasan ukuran dan tipe tertentu
            'caption_image' => 'nullable|string',
            'headline' => 'required|string',
            'description' => 'required|string',
            'masterplan' => 'nullable|string',
            'total_hectare' => 'integer',
            'total_housebuild' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('image_primary')) {
            // Hapus gambar lama jika ada
            if ($aboutCompany->image_primary) {
                Storage::delete($aboutCompany->image_primary);
            }
            $imagePath = $request->file('image_primary')->store('public/about_company_images');
            $data['image_primary'] = $imagePath;
        }

        $aboutCompany->update($data);

        return response()->json(['message' => 'Data perusahaan updated successfully', 'aboutCompany' => $aboutCompany], 200);
    }

    // Menghapus data perusahaan berdasarkan ID
    public function destroy($id)
    {
        $aboutCompany = AboutCompany::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($aboutCompany->image_primary) {
            Storage::delete($aboutCompany->image_primary);
        }

        $aboutCompany->delete();

        return response()->json(['message' => 'Data perusahaan deleted successfully'], 200);
    }
}
