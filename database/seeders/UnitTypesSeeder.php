<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data yang ingin dimasukkan ke dalam tabel unit_types
        $unitTypes = [
            [
                'unit_title' => 'Apartemen Type A',
                'unit_subtitle' => 'Unit apartemen dengan dua kamar tidur',
                'unit_spec' => 'Luas: 80m2, Kamar tidur: 2, Kamar mandi: 1',
                'is_active' => true,
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_title' => 'Rumah Tipe B',
                'unit_subtitle' => 'Rumah dengan taman dan garasi',
                'unit_spec' => 'Luas tanah: 150m2, Kamar tidur: 3, Kamar mandi: 2',
                'is_active' => true,
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel menggunakan DB::table
        DB::table('unit_types')->insert($unitTypes);
    }
}
