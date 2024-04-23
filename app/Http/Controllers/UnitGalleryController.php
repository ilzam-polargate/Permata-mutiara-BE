<?php

namespace App\Http\Controllers;

use App\Models\UnitGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UnitGalleryController extends Controller
{
    public function index()
    {
        $galleries = UnitGallery::all();
        return response()->json(['galleries' => $galleries], 200);
    }

    public function show($id)
    {
        $gallery = UnitGallery::findOrFail($id);
        return response()->json(['gallery' => $gallery], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_type_id' => 'required|exists:unit_types,id',
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'caption_image' => 'nullable|string',
            'sort' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Set default value for sort if not provided
        $data['sort'] = isset($data['sort']) ? $data['sort'] : 0;

        if ($request->hasFile('gallery_image')) {
            $imagePath = $request->file('gallery_image')->store('public/unit_galleries');
            $data['gallery_image'] = $imagePath;
        }

        $gallery = UnitGallery::create($data);

        return response()->json(['message' => 'Gallery created successfully', 'gallery' => $gallery], 201);
    }

    public function update(Request $request, $id)
    {
        $gallery = UnitGallery::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'unit_type_id' => 'exists:unit_types,id',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'caption_image' => 'nullable|string',
            'sort' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->only(['unit_type_id', 'caption_image', 'sort']);
        $data['updated_by'] = Auth::id();

        // Set default value for sort if not provided
        if (!isset($data['sort'])) {
            $data['sort'] = 0;
        }

        if ($request->hasFile('gallery_image')) {
            // Delete existing gallery image
            if ($gallery->gallery_image) {
                Storage::delete($gallery->gallery_image);
            }
            $imagePath = $request->file('gallery_image')->store('public/unit_galleries');
            $data['gallery_image'] = $imagePath;
        }

        $gallery->update($data);

        return response()->json(['message' => 'Gallery updated successfully', 'gallery' => $gallery], 200);
    }

    public function destroy($id)
    {
        $gallery = UnitGallery::findOrFail($id);

        // Delete associated gallery image
        if ($gallery->gallery_image) {
            Storage::delete($gallery->gallery_image);
        }

        $gallery->delete();

        return response()->json(['message' => 'Gallery deleted successfully'], 200);
    }
}
