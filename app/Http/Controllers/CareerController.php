<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    // Menampilkan semua data karier
    public function index()
    {
        $careers = Career::all();
        return response()->json(['careers' => $careers], 200);
    }

    // Menampilkan detail karier berdasarkan ID
    public function show($id)
    {
        $career = Career::findOrFail($id);
        return response()->json(['career' => $career], 200);
    }

    // Membuat karier baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'career_title' => 'required|string',
            'career_description' => 'required|string',
            'career_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Batasan ukuran dan tipe file gambar
            'career_last_apply' => 'nullable|date',
            'career_date' => 'nullable|date',
            'created_by' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->only([
            'career_title',
            'career_description',
            'career_last_apply',
            'career_date',
            'created_by',
        ]);

        // Upload gambar karier jika ada
        if ($request->hasFile('career_image')) {
            $imagePath = $request->file('career_image')->store('public/career_images');
            $data['career_image'] = $imagePath;
        }

        $career = Career::create($data);

        return response()->json(['message' => 'Career created successfully', 'career' => $career], 201);
    }

    // Mengupdate karier berdasarkan ID
    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'career_title' => 'required|string',
            'career_description' => 'required|string',
            'career_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Batasan ukuran dan tipe file gambar
            'career_last_apply' => 'nullable|date',
            'career_date' => 'nullable|date',
            'updated_by' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->only([
            'career_title',
            'career_description',
            'career_last_apply',
            'career_date',
            'updated_by',
        ]);

        // Upload gambar karier jika ada
        if ($request->hasFile('career_image')) {
            // Hapus gambar lama jika ada
            if ($career->career_image) {
                Storage::delete($career->career_image);
            }
            $imagePath = $request->file('career_image')->store('public/career_images');
            $data['career_image'] = $imagePath;
        }

        $career->update($data);

        return response()->json(['message' => 'Career updated successfully', 'career' => $career], 200);
    }

    // Menghapus karier berdasarkan ID
    public function destroy($id)
    {
        $career = Career::findOrFail($id);

        // Hapus gambar karier jika ada
        if ($career->career_image) {
            Storage::delete($career->career_image);
        }

        $career->delete();

        return response()->json(['message' => 'Career deleted successfully'], 200);
    }
}
