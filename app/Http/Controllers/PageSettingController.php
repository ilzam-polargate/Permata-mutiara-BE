<?php

namespace App\Http\Controllers;

use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSettingController extends Controller
{
    public function index()
    {
        return view('admin.page.index', [
            'page' => PageSetting::where('id', '1')->first()
        ]);
    }

    public function update(Request $request)
    {
        if (auth()->user()->role == 'admin') {
            $rules = [
                'logo' => 'required',
                'header' => 'required',
                'sub_header' => 'required',
                'img_header' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'about' => 'required',
                'sub_about' => 'required',
                'layanan_1' => 'required',
                'layanan_2' => 'required',
                'layanan_3' => 'required',
                'kamar' => 'required',
                'sub_kamar' => 'required',
                'kontak' => 'required',
                'sub_kontak' => 'required',
                'twitter' => 'required',
                'facebook' => 'required',
                'instagram' => 'required',
            ];

            // Hanya memeriksa gambar jika ada file yang diunggah
            if ($request->hasFile('img_header')) {
                $rules['img_header'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            }

            $data = $this->validate($request, $rules);

            $previousData = PageSetting::find(1);

            if ($previousData) {
                // Hanya hapus gambar jika ada perubahan pada gambar
                if ($request->hasFile('img_header')) {
                    Storage::delete('public/header/' . $previousData->img_header);
                } else {
                    unset($data['img_header']); // Hapus kunci img_header dari data agar tidak diupdate
                }
            }

            if ($request->hasFile('img_header')) {
                $imgHeaderImage = $request->file('img_header');
                $imgHeaderFileName = time() . '.' . $imgHeaderImage->getClientOriginalExtension();
                $imgHeaderImage->storeAs('public/header', $imgHeaderFileName);
                $data['img_header'] = $imgHeaderFileName;
            }

            PageSetting::where('id', 1)->update($data);

            return redirect()->back()->with(['success' => 'Berhasil merubah pengaturan halaman']);
        }

        return redirect()->route('home');
    }
}
