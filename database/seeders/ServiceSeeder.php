<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Custom Logo Design',
                'description' => "Get a unique, custom-designed logo that perfectly represents your brand identity.\n\n" .
                    "**Process:**\n" .
                    "1. **Consultation:** Provide your suggestions, ideas, and any reference images.\n" .
                    "2. **Design:** We create initial concepts based on your input.\n" .
                    "3. **Approval:** Review the designs. Final approval is required before delivery.\n" .
                    "4. **Delivery:** Receive your high-quality logo files.\n\n" .
                    "**Pricing:**\n" .
                    "₹800 - ₹3,500 depending on complexity and requirements.",
                'price' => 800.00,
                'features' => json_encode([
                    'Unique Custom Design',
                    'User Input Driven',
                    'Approval Process',
                    'High-Quality Deliverables'
                ]),
                // 'image' => null, // Placeholder or null
            ],
            [
                'title' => 'Logo Redesign',
                'description' => "Refresh your existing logo to give it a modern and professional look.\n\n" .
                    "**Ideal For:**\n" .
                    "Businesses looking to update their current logo with new elements or a fresh style while maintaining core brand recognition.\n\n" .
                    "**Pricing:**\n" .
                    "₹500 - ₹5,000 depending on the scope of changes.",
                'price' => 500.00,
                'features' => json_encode([
                    'Modernize Existing Logo',
                    'Add New Elements',
                    'Professional Touch',
                    'Brand Consistency'
                ]),
                // 'image' => null,
            ],
            [
                'title' => 'Brand Identity Services',
                'description' => "Complete brand identity solutions for new businesses. Establish a strong, cohesive market presence from day one.\n\n" .
                    "**Pricing:**\n" .
                    "₹900 - ₹10,000.\n" .
                    "*Note: Pricing scales with business size and scope (e.g., larger corporations or extensive branding needs will have higher tier pricing).*",
                'price' => 900.00,
                'features' => json_encode([
                    'Complete Brand Strategy',
                    'Logo Design',
                    'Color Palette & Typography',
                    'Scalable for Big Businesses'
                ]),
                // 'image' => null,
            ],
        ];

        foreach ($services as $service) {
            $slug = Str::slug($service['title']);
            
            // Check if service with this slug already exists to prevent duplicates
            $exists = DB::table('services')->where('slug', $slug)->exists();
            
            if (!$exists) {
                DB::table('services')->insert(array_merge($service, [
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}
