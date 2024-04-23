<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutCompany;
use App\Models\User; // Jika menggunakan user sebagai foreign key
use Illuminate\Support\Facades\DB; // Untuk penggunaan DB::raw()

class AboutCompanySeeder extends Seeder
{
    public function run()
    {
        // Cek jika tabel about_companies sudah ada data, lalu tambahkan hanya jika kosong
        if (AboutCompany::count() === 0) {
            // Buat seeder data untuk about_companies
            $aboutCompanyData = [
                [
                    'caption_image' => 'Caption Image 1',
                    'headline' => 'Headline 1',
                    'description' => 'Description 1',
                    'masterplan' => 'Masterplan 1',
                    'total_hectare' => 100,
                    'total_housebuild' => 50,
                    'created_by' => 1, // ID user yang membuat (sesuaikan)
                    'updated_by' => 1, // ID user yang mengupdate (sesuaikan)
                ]
            ];

            // Looping data dan tambahkan ke database
            foreach ($aboutCompanyData as $data) {
                AboutCompany::create($data);
            }
        }
    }
}
