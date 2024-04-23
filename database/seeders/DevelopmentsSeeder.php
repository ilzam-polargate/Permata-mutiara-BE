<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data yang ingin dimasukkan ke dalam tabel developments
        $developments = [
            [
                'dev_name' => 'Perumahan Indah',
                'dev_description' => 'Perumahan dengan fasilitas lengkap dan nyaman.',
                'dev_category' => 'residential',
                'is_active' => true,
                'is_subsidi' => false,
                'is_sold' => false,
                'created_date' => now(),
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_date' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dev_name' => 'Pusat Bisnis Sentral',
                'dev_description' => 'Gedung perkantoran modern dengan fasilitas terbaik.',
                'dev_category' => 'commercial',
                'is_active' => true,
                'is_subsidi' => false,
                'is_sold' => false,
                'created_date' => now(),
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_date' => null,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel menggunakan DB::table
        DB::table('developments')->insert($developments);
    }
}
