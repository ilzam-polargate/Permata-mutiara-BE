<?php

namespace App\Http\Controllers;

use App\Models\Development;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DevelopmentController extends Controller
{
    // Menampilkan semua data development
    public function index()
    {
        $developments = Development::all();
        return response()->json(['developments' => $developments], 200);
    }

    // Menampilkan detail development berdasarkan ID
    public function show($id)
    {
        $development = Development::findOrFail($id);
        return response()->json(['development' => $development], 200);
    }

    // Membuat data development baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'dev_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'dev_name' => 'required|string',
        'dev_description' => 'required|string',
        'dev_category' => 'required|in:residential,commercial',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $data = $request->all();

    // Set default values
    $data['is_active'] = true;
    $data['is_subsidi'] = false;
    $data['is_sold'] = false;

    // Upload gambar development
    $imagePath = $request->file('dev_image')->store('public/development_images');
    $data['dev_image'] = $imagePath;

    // Mendapatkan ID user yang sedang autentikasi (yang menambahkan data)
    $data['created_by'] = Auth::id();

    $development = Development::create($data);

    return response()->json(['message' => 'Data development created successfully', 'development' => $development], 201);
}


    // Mengupdate data development berdasarkan ID
    public function update(Request $request, $id)
{
    $development = Development::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'dev_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'dev_name' => 'required|string',
        'dev_description' => 'required|string',
        'dev_category' => 'required|in:residential,commercial',
        'is_active' => 'boolean',
        'is_subsidi' => 'boolean',
        'is_sold' => 'boolean',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $data = $request->all();

    // Set default values
    $data['is_active'] = true;
    $data['is_subsidi'] = false;
    $data['is_sold'] = false;

    // Upload gambar baru jika ada
    if ($request->hasFile('dev_image')) {
        // Hapus gambar lama
        Storage::delete($development->dev_image);
        $imagePath = $request->file('dev_image')->store('public/development_images');
        $data['dev_image'] = $imagePath;
    }
    
    $data['updated_by'] = Auth::id();
    $development->update($data);

    return response()->json(['message' => 'Data development updated successfully', 'development' => $development], 200);
}


    // Menghapus data development berdasarkan ID    
    public function destroy($id)
    {
        $development = Development::findOrFail($id);

        // Hapus gambar terkait
        Storage::delete($development->dev_image);

        $development->delete();

        return response()->json(['message' => 'Data development deleted successfully'], 200);
    }
}
