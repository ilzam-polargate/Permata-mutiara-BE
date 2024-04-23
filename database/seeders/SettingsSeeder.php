<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'page_title' => 'Welcome to Our Website',
                'page_subtitle' => 'Discover amazing features',
                'page_meta_keyword' => 'website, features, discovery',
                'page_meta_description' => 'Explore the best features of our website',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'About Us',
                'page_subtitle' => 'Learn more about our company',
                'page_meta_keyword' => 'about us, company information',
                'page_meta_description' => 'Discover our company history and mission',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Contact Us',
                'page_subtitle' => 'Get in touch with us',
                'page_meta_keyword' => 'contact us, reach out, inquiry',
                'page_meta_description' => 'Contact us for more information or assistance',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Services',
                'page_subtitle' => 'Explore our services',
                'page_meta_keyword' => 'services, offerings, solutions',
                'page_meta_description' => 'Discover our range of services and solutions',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Terms and Conditions',
                'page_subtitle' => 'Read our terms and conditions',
                'page_meta_keyword' => 'terms and conditions, legal',
                'page_meta_description' => 'View our terms and conditions',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Privacy Policy',
                'page_subtitle' => 'Read our privacy policy',
                'page_meta_keyword' => 'privacy policy, data protection',
                'page_meta_description' => 'View our privacy policy',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'FAQ',
                'page_subtitle' => 'Frequently Asked Questions',
                'page_meta_keyword' => 'FAQ, questions, answers',
                'page_meta_description' => 'Find answers to common questions',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'News',
                'page_subtitle' => 'Latest news and updates',
                'page_meta_keyword' => 'news, updates, announcements',
                'page_meta_description' => 'Read our latest news and updates',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Gallery',
                'page_subtitle' => 'Browse our gallery',
                'page_meta_keyword' => 'gallery, photos, images',
                'page_meta_description' => 'View our photo gallery',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Career',
                'page_subtitle' => 'Join our team',
                'page_meta_keyword' => 'career, job openings, opportunities',
                'page_meta_description' => 'Explore career opportunities with us',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Events',
                'page_subtitle' => 'Upcoming events',
                'page_meta_keyword' => 'events, calendar, schedules',
                'page_meta_description' => 'Check out our upcoming events',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Partnerships',
                'page_subtitle' => 'Explore our partnerships',
                'page_meta_keyword' => 'partnerships, collaborations, alliances',
                'page_meta_description' => 'Learn about our partnerships and collaborations',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_title' => 'Testimonials',
                'page_subtitle' => 'Customer testimonials',
                'page_meta_keyword' => 'testimonials, reviews, feedback',
                'page_meta_description' => 'Read what our customers say about us',
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
