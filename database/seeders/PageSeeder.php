<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContohModel; // Gantilah ContohModel dengan model yang sesuai

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PageSetting::create([
            'logo' => 'KOS SANDY',
            'header' => 'SELAMAT DATANG DI KOS SANDY',
            'sub_header' => 'Kami memberikan layanan sewa kos dengan harga terjangkau dan kualitas terbaik',
            'img_header' => '',
            'about' => 'Tentang Kami',
            'sub_about' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, eligendi. Vitae, quasi tempora dolorem veniam ipsum quia deserunt at voluptas libero sint dignissimos assumenda, commodi repellat aspernatur quae magni natus enim perferendis sunt. Corporis ut ad delectus explicabo quod inventore? Doloribus, in veritatis? Corporis illo ipsum, commodi nesciunt, ea laborum, facere repudiandae est consequuntur fuga sed! Excepturi officia ratione sit obcaecati? Earum iusto, corrupti voluptas quis, adipisci blanditiis impedit facilis consequuntur recusandae officiis natus tempore eos mollitia nesciunt saepe molestiae, aliquam facere eius ipsa laudantium nihil? Deserunt vitae, saepe explicabo repellendus quae est minus, corporis quos incidunt voluptates itaque amet.',
            'layanan_1' => 'Harga Terjangkau',
            'layanan_2' => 'Fasilitas Terbaik',
            'layanan_3' => 'Tempat Bersih',
            'kamar' => 'Kamar',
            'sub_kamar' => 'Silahkan pilih kamar sesuai kebutuhan anda dan periksa ketersediaan kamar',
            'kontak' => 'Contact',
            'sub_kontak' => 'Hubungi kami dengan kontak berikut',
            'twitter' => 'https://twitter.com/',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://www.instagram.com/',
        ]);
    }
}
