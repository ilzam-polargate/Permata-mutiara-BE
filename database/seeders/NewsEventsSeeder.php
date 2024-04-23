<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsEvents = [
            [
                'article_category_id' => 1,
                'article_title' => 'Grand Opening Ceremony',
                'article_description' => 'Join us for the grand opening ceremony of our new location!',
                'article_date' => '2024-04-30 10:00:00',
                'article_caption' => 'Grand Opening',
                'meta_keyword' => 'opening ceremony, event, grand opening',
                'meta_description' => 'Join us for the grand opening ceremony of our new location!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article_category_id' => 2,
                'article_title' => 'Latest Product Launch',
                'article_description' => 'Discover our latest product launch and special offers.',
                'article_date' => '2024-05-15 14:00:00',
                'article_caption' => 'Product Launch',
                'meta_keyword' => 'product launch, new products, special offers',
                'meta_description' => 'Discover our latest product launch and special offers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data berita/acara ke dalam tabel menggunakan DB::table
        DB::table('news_events')->insert($newsEvents);
    }
}
