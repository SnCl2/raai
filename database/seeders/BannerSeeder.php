<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'headline' => 'Elevate Your Brand',
                'subheadline' => 'Professional design services for your business.',
                'image' => 'banners/sample-1.jpg',
                'cta_text' => 'Get Started',
                'cta_link' => '/services',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'headline' => 'Creative Solutions',
                'subheadline' => 'We bring your ideas to life.',
                'image' => 'banners/sample-2.jpg',
                'cta_text' => 'View Portfolio',
                'cta_link' => '/projects',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'headline' => 'Expert Team',
                'subheadline' => 'Dedicated professionals ready to help.',
                'image' => 'banners/sample-3.jpg',
                'cta_text' => 'Contact Us',
                'cta_link' => '/contact',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        DB::table('banners')->insert($banners);
    }
}
