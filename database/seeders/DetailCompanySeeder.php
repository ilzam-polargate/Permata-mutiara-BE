<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailCompany;

class DetailCompanySeeder extends Seeder
{
    public function run()
    {
        // Cek jika tabel detail_company sudah ada data, lalu tambahkan hanya jika kosong
        if (DetailCompany::count() === 0) {
            // Buat seeder data untuk detail_company
            $companyData = [
                [
                    'co_address' => 'Jalan Contoh No. 123',
                    'co_email' => 'info@example.com',
                    'co_telp' => '081234567890',
                    'co_whatsapp' => '081234567890',
                    'co_website' => 'https://www.example.com',
                    'co_google_map' => 'https://www.google.com/maps?q=example',
                    'co_linkyoutube' => 'https://www.youtube.com/example',
                    'created_by' => 1, // ID pengguna yang membuat data (sesuaikan jika perlu)
                    'updated_by' => 1, // ID pengguna yang memperbarui data (sesuaikan jika perlu)
                ],
                // Tambahkan data lain jika perlu
            ];

            // Looping data dan tambahkan ke database
            foreach ($companyData as $data) {
                DetailCompany::create($data);
            }
        }
    }
}
