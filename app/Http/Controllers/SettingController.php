<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    // Menampilkan semua setting
    public function index()
    {
        $settings = Setting::all();
        return response()->json(['settings' => $settings], 200);
        return view('admin.page.setting', [
            'page' => Setting::where('id', '1')->first()
        ]);
    }

    // Menampilkan detail setting berdasarkan ID
    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        return response()->json(['setting' => $setting], 200);
    }

    // Membuat setting baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_title' => 'required|string',
            'page_subtitle' => 'nullable|string',
            'page_meta_keyword' => 'nullable|string',
            'page_meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $setting = Setting::create($request->all());

        return response()->json(['message' => 'Setting created successfully', 'setting' => $setting], 201);
    }

    // Mengupdate setting berdasarkan ID
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'page_title' => 'required|string',
            'page_subtitle' => 'nullable|string',
            'page_meta_keyword' => 'nullable|string',
            'page_meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $setting->update($request->all());

        return response()->json(['message' => 'Setting updated successfully', 'setting' => $setting], 200);
    }

    // Menghapus setting berdasarkan ID
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return response()->json(['message' => 'Setting deleted successfully'], 200);
    }
}
