<?php

namespace Database\Seeders;
use App\Models\Career;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $careers = [
            [
                'career_title' => 'Software Engineer',
                'career_description' => 'We are looking for a skilled Software Engineer to join our development team.',
                'career_last_apply' => '2024-05-15 23:59:59',
                'career_date' => '2024-04-20 00:00:00',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'created_date' => now(),
                'updated_by' => null,
                'updated_date' => null,
            ],
            [
                'career_title' => 'Marketing Manager',
                'career_description' => 'We are hiring an experienced Marketing Manager to lead our marketing team.',
                'career_last_apply' => '2024-05-10 23:59:59',
                'career_date' => '2024-04-18 00:00:00',
                'created_by' => 1, // Ganti dengan ID pengguna yang sesuai
                'created_date' => now(),
                'updated_by' => null,
                'updated_date' => null,
            ],
            // Tambahkan data karir lainnya sesuai kebutuhan
        ];

        // Masukkan data karir ke dalam tabel menggunakan DB::table
        foreach ($careers as $data) {
            Career::create($data);
        }
    }
}
