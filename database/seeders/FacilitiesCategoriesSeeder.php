<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data yang ingin dimasukkan ke dalam tabel facilities_categories
        $facilitiesCategories = [
            [
                'cat_title' => 'Kolam Renang',
                'cat_subtitle' => 'Fasilitas rekreasi untuk semua penghuni',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_title' => 'Taman Bermain Anak',
                'cat_subtitle' => 'Taman bermain yang aman dan nyaman',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_title' => 'Pendidikan',
                'cat_subtitle' => 'Tempat pendidikan yang menyenangkan',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_title' => 'Wisata Kuliner',
                'cat_subtitle' => 'Tempat kuliner yang menarik dan beragam',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Masukkan data ke dalam tabel menggunakan DB::table
        DB::table('facilities_categories')->insert($facilitiesCategories);
    }
}
