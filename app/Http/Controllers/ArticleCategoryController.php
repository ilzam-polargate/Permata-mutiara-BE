<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleCategoryController extends Controller
{
    // Menampilkan semua kategori artikel
    public function index()
    {
        $categories = ArticleCategory::all();
        return response()->json(['categories' => $categories], 200);
    }

    // Menampilkan detail kategori artikel berdasarkan ID
    public function show($id)
    {
        $category = ArticleCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['category' => $category], 200);
    }

    // Membuat kategori artikel baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'article_category_name' => 'required|string|unique:article_categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category = ArticleCategory::create([
            'article_category_name' => $request->article_category_name,
        ]);

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }

    // Mengupdate kategori artikel berdasarkan ID
    public function update(Request $request, $id)
    {
        $category = ArticleCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'article_category_name' => 'required|string|unique:article_categories,article_category_name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $category->article_category_name = $request->article_category_name;
        $category->save();

        return response()->json(['message' => 'Category updated successfully', 'category' => $category], 200);
    }

    // Menghapus kategori artikel berdasarkan ID
    public function destroy($id)
    {
        $category = ArticleCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
