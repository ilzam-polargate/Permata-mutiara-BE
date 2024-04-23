<?php

namespace App\Http\Controllers;

use App\Models\NewsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NewsEventController extends Controller
{
    // Menampilkan semua news event
    public function index()
    {
        $newsEvents = NewsEvent::all();
        return response()->json(['newsEvents' => $newsEvents], 200);
    }

    // Menampilkan detail news event berdasarkan ID
    public function show($id)
    {
        $newsEvent = NewsEvent::findOrFail($id);
        return response()->json(['newsEvent' => $newsEvent], 200);
    }

    // Membuat news event baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'article_category_id' => 'required|exists:article_categories,id',
        'article_title' => 'required|string',
        'article_description' => 'required|string',
        'article_date' => 'nullable|date',
        'article_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File gambar dengan batasan ukuran dan tipe tertentu
        'article_caption' => 'nullable|string',
        'meta_keyword' => 'nullable|string',
        'meta_description' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $data = $request->only([
        'article_category_id',
        'article_title',
        'article_description',
        'article_date',
        'article_caption',
        'meta_keyword',
        'meta_description',
    ]);

    // Upload gambar jika ada
    if ($request->hasFile('article_image')) {
        $imagePath = $request->file('article_image')->store('public/article_images');
        $data['article_image'] = $imagePath;
    }

    $newsEvent = NewsEvent::create($data);

    return response()->json(['message' => 'News event created successfully', 'newsEvent' => $newsEvent], 201);
}


    // Mengupdate news event berdasarkan ID
    public function update(Request $request, $id)
{
    $newsEvent = NewsEvent::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'article_category_id' => 'required|exists:article_categories,id',
        'article_title' => 'required|string',
        'article_description' => 'required|string',
        'article_date' => 'nullable|date',
        'article_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File gambar dengan batasan ukuran dan tipe tertentu
        'article_caption' => 'nullable|string',
        'meta_keyword' => 'nullable|string',
        'meta_description' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    $data = $request->only([
        'article_category_id',
        'article_title',
        'article_description',
        'article_date',
        'article_caption',
        'meta_keyword',
        'meta_description',
    ]);

    // Upload gambar jika ada
    if ($request->hasFile('article_image')) {
        // Hapus gambar lama jika ada
        if ($newsEvent->article_image) {
            Storage::delete($newsEvent->article_image);
        }
        $imagePath = $request->file('article_image')->store('public/article_images');
        $data['article_image'] = $imagePath;
    }

    $newsEvent->update($data);

    return response()->json(['message' => 'News event updated successfully', 'newsEvent' => $newsEvent], 200);
}


    // Menghapus news event berdasarkan ID
    public function destroy($id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($newsEvent->article_image) {
            Storage::delete($newsEvent->article_image);
        }

        $newsEvent->delete();

        return response()->json(['message' => 'News event deleted successfully'], 200);
    }
}
