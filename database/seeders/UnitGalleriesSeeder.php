<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitGalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data yang ingin dimasukkan ke dalam tabel unit_galleries
        $unitGalleries = [
            [
                'unit_type_id' => 1, // Ganti dengan ID tipe unit yang valid
                'caption_image' => 'Interior ruang tamu',
                'sort' => 1,
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_type_id' => 1, // Ganti dengan ID tipe unit yang valid
                'caption_image' => 'Eksterior bangunan',
                'sort' => 2,
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel menggunakan DB::table
        DB::table('unit_galleries')->insert($unitGalleries);
    }
}
