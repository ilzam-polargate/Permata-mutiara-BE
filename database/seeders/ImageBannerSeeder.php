<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImageBanner;
use App\Models\User; // Jika menggunakan user sebagai foreign key

class ImageBannerSeeder extends Seeder
{
    public function run()
    {
        // Cek jika tabel image_banners sudah ada data, lalu tambahkan hanya jika kosong
        if (ImageBanner::count() === 0) {
            // Buat seeder data untuk image_banners
            $imageBannerData = [
                [
                    'headline' => 'Headline 1',
                    'subheadline' => 'Subheadline 1',
                    'text_button' => 'Button Text 1',
                    'created_by' => 1, // ID user yang membuat (sesuaikan)
                    'updated_by' => 1, // ID user yang mengupdate (sesuaikan)
                ]
            ];

            // Looping data dan tambahkan ke database
            foreach ($imageBannerData as $data) {
                ImageBanner::create($data);
            }
        }
    }
}
