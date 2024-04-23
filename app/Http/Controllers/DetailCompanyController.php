<?php

namespace App\Http\Controllers;

use App\Models\DetailCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DetailCompanyController extends Controller
{
    public function index()
    {
        $detailCompany = DetailCompany::first(); // Mengambil detail perusahaan pertama
        return response()->json(['detailCompany' => $detailCompany], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo_header' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'co_address' => 'required|string',
            'co_email' => 'required|email',
            'co_telp' => 'required|string',
            'co_whatsapp' => 'nullable|string',
            'co_website' => 'nullable|url',
            'co_google_map' => 'nullable|string',
            'co_linkyoutube' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['updated_by'] = Auth::id();

        $detailCompany = DetailCompany::first(); // Mengambil detail perusahaan pertama

        // Upload logo_header if exists
        if ($request->hasFile('logo_header')) {
            Storage::delete($detailCompany->logo_header); // Menghapus logo_header yang lama
            $data['logo_header'] = $request->file('logo_header')->store('public/company_logos');
        }

        // Upload logo_footer if exists
        if ($request->hasFile('logo_footer')) {
            Storage::delete($detailCompany->logo_footer); // Menghapus logo_footer yang lama
            $data['logo_footer'] = $request->file('logo_footer')->store('public/company_logos');
        }

        $detailCompany->update($data);

        return response()->json(['message' => 'Detail company updated successfully', 'detailCompany' => $detailCompany], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo_header' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'logo_footer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'co_address' => 'required|string',
            'co_email' => 'required|email',
            'co_telp' => 'required|string',
            'co_whatsapp' => 'nullable|string',
            'co_website' => 'nullable|url',
            'co_google_map' => 'nullable|string',
            'co_linkyoutube' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Upload logo_header
        $data['logo_header'] = $request->file('logo_header')->store('public/company_logos');

        // Upload logo_footer
        $data['logo_footer'] = $request->file('logo_footer')->store('public/company_logos');

        $detailCompany = DetailCompany::create($data);

        return response()->json(['message' => 'Detail company created successfully', 'detailCompany' => $detailCompany], 201);
    }
}
