<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    public function run()
    {
        // Cek jika tabel social_media sudah ada data, lalu tambahkan hanya jika kosong
        if (SocialMedia::count() === 0) {
            // Buat seeder data untuk social_media
            $socialMediaData = [
                [
                    'name_sosmed' => 'Facebook',
                    'is_active' => true,
                    'link_sosmed' => 'https://www.facebook.com/example',
                    'sort_sosmed' => 1,
                ],
                [
                    'name_sosmed' => 'Twitter',
                    'is_active' => true,
                    'link_sosmed' => 'https://twitter.com/example',
                    'sort_sosmed' => 2,
                ],
                [
                    'name_sosmed' => 'Instagram',
                    'is_active' => true,
                    'link_sosmed' => 'https://www.instagram.com/example',
                    'sort_sosmed' => 3,
                ],
                [
                    'name_sosmed' => 'LinkedIn',
                    'is_active' => true,
                    'link_sosmed' => 'https://www.linkedin.com/example',
                    'sort_sosmed' => 4,
                ],
                [
                    'name_sosmed' => 'Youtube',
                    'is_active' => true,
                    'link_sosmed' => 'https://www.Youtube.com/example',
                    'sort_sosmed' => 5,
                ],
                [
                    'name_sosmed' => 'Tiktok',
                    'is_active' => true,
                    'link_sosmed' => 'https://www.Tiktok.com/example',
                    'sort_sosmed' => 6,
                ],
            ];

            // Looping data dan tambahkan ke database
            foreach ($socialMediaData as $data) {
                SocialMedia::create($data);
            }
        }
    }
}
