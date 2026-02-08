<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'John Doe',
                'designation' => 'CEO, TechStart',
                'message' => 'Amazing work! The rebranding completely transformed our business image.',
                'rating' => 5,
                'image' => 'testimonials/client-1.jpg',
            ],
            [
                'client_name' => 'Jane Smith',
                'designation' => 'Marketing Manager',
                'message' => 'Professional, creative, and timely. Highly recommended for any design needs.',
                'rating' => 5,
                'image' => 'testimonials/client-2.jpg',
            ],
            [
                'client_name' => 'Michael Brown',
                'designation' => 'Founder, EcoLife',
                'message' => 'Great attention to detail and excellent communication throughout the project.',
                'rating' => 4,
                'image' => 'testimonials/client-3.jpg',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            DB::table('testimonials')->insert(array_merge($testimonial, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
