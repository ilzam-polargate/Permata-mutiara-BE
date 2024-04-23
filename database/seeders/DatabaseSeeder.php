<?php

namespace Database\Seeders;

use App\Models\AboutCompany;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Panggil seeder AdminSeeder untuk memasukkan pengguna admin dan pengguna biasa
        $this->call(AdminSeeder::class);

        // Panggil factory User untuk membuat 10 pengguna acak
        User::factory(10)->create();

        // Membuat pengguna uji dengan nama 'Test User' dan email 'test@example.com'
        User::factory()->create([
            'username' => 'username',
        ]);
        
        $this->call(PageSeeder::class);
        $this->call(AboutCompanySeeder::class);
        $this->call(CareersSeeder::class);
        $this->call(DetailCompanySeeder::class);
        $this->call(ArticleCategorySeeder::class);
        $this->call(DevelopmentsSeeder::class);
        $this->call(FacilitiesCategoriesSeeder::class);
        $this->call(ImageBannerSeeder::class);
        $this->call(NewsEventsSeeder::class);
        $this->call(SettingsSeeder::class); 
        $this->call(SocialMediaSeeder::class);
        $this->call(UnitTypesSeeder::class);
        $this->call(UnitGalleriesSeeder::class);
    }
}
