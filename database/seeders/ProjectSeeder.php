<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'TechStart Rebrand',
                'category' => 'Branding',
                'image' => 'projects/project-1.jpg',
                'description' => 'Complete rebranding for a tech startup including logo, stationery, and brand guidelines.',
            ],
            [
                'title' => 'EcoLife Website',
                'category' => 'Web Design',
                'image' => 'projects/project-2.jpg',
                'description' => 'Responsive website design for an eco-friendly product line.',
            ],
            [
                'title' => 'Coffee House Identity',
                'category' => 'Identity',
                'image' => 'projects/project-3.jpg',
                'description' => 'Visual identity design for a new chain of coffee houses.',
            ],
            [
                'title' => 'App UI/UX Design',
                'category' => 'UI/UX',
                'image' => 'projects/project-4.jpg',
                'description' => 'User interface and experience design for a mobile fitness application.',
            ],
        ];

        foreach ($projects as $project) {
            $slug = Str::slug($project['title']);
            DB::table('projects')->insert(array_merge($project, [
                'slug' => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
