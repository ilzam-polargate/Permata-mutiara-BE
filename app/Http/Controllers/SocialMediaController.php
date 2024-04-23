<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    // Menampilkan semua data social media
    public function index()
    {
        $socialMedia = SocialMedia::all();
        return response()->json(['socialMedia' => $socialMedia], 200);
    }
    public function indexAktif()
    {
        $socialMedia = SocialMedia::where('is_active', true)->get();
        return response()->json(['socialMedia' => $socialMedia], 200);
    }

    // Menyimpan data social media baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_sosmed' => 'required|string',
            'is_active' => 'boolean',
            'link_sosmed' => 'required|string',
            'sort_sosmed' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $socialMedia = SocialMedia::create($request->all());

        return response()->json(['message' => 'Social media created successfully', 'socialMedia' => $socialMedia], 201);
    }

    // Menampilkan data social media berdasarkan ID
    public function show($id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        return response()->json(['socialMedia' => $socialMedia], 200);
    }

    // Mengupdate data social media berdasarkan ID
    public function update(Request $request, $id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name_sosmed' => 'required|string',
            'is_active' => 'boolean',
            'link_sosmed' => 'required|string',
            'sort_sosmed' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $socialMedia->update($request->all());

        return response()->json(['message' => 'Social media updated successfully', 'socialMedia' => $socialMedia], 200);
    }

    // Menghapus data social media berdasarkan ID
    public function destroy($id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        $socialMedia->delete();

        return response()->json(['message' => 'Social media deleted successfully'], 200);
    }

    public function softDelete($id)
    {
        $socialMedia = SocialMedia::find($id);

        if (!$socialMedia) {
            return response()->json(['message' => 'Social media not found'], 404);
        }

        // Toggle is_active status
        $socialMedia->update(['is_active' => !$socialMedia->is_active]);

        return response()->json(['message' => 'Social media status updated successfully'], 200);
    }
}
