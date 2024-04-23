<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data kategori artikel yang ingin dimasukkan
        $categories = [
            [
                'article_category_name' => 'Media',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'article_category_name' => 'News',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Masukkan data kategori artikel ke dalam tabel menggunakan DB::table
        foreach ( $categories as $data) {
            ArticleCategory::create($data);
        }
    }
}
