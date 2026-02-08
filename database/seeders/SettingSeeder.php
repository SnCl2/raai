<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Raai Website'],
            ['key' => 'contact_email', 'value' => 'contact@raaiwebsite.com'],
            ['key' => 'contact_phone', 'value' => '+91 1234567890'],
            ['key' => 'address', 'value' => '123, Creative Street, Design City, India'],
            ['key' => 'facebook_link', 'value' => 'https://facebook.com'],
            ['key' => 'twitter_link', 'value' => 'https://twitter.com'],
            ['key' => 'instagram_link', 'value' => 'https://instagram.com'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
