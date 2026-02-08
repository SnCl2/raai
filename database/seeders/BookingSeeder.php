<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have services to link to
        $serviceIds = Service::pluck('id')->toArray();
        
        if (empty($serviceIds)) {
            return; // Or create a default service
        }

        $bookings = [
            [
                'service_id' => $serviceIds[array_rand($serviceIds)],
                'client_name' => 'Alice Johnson',
                'business_name' => 'Alice Bakery',
                'email' => 'alice@example.com',
                'phone' => '1234567890',
                'details' => 'I need a logo for my new bakery shop.',
                'amount' => 800.00,
                'payment_status' => 'pending',
                'payment_id' => null,
            ],
            [
                'service_id' => $serviceIds[array_rand($serviceIds)],
                'client_name' => 'Bob Williams',
                'business_name' => 'BW Consulting',
                'email' => 'bob@example.com',
                'phone' => '0987654321',
                'details' => 'Redesigning our corporate identity.',
                'amount' => 1500.00,
                'payment_status' => 'completed',
                'payment_id' => 'PAY_123456789',
            ],
            [
                'service_id' => $serviceIds[array_rand($serviceIds)],
                'client_name' => 'Charlie Davis',
                'business_name' => null,
                'email' => 'charlie@example.com',
                'phone' => '5551234567',
                'details' => 'Looking for a simple logo for my personal blog.',
                'amount' => 500.00,
                'payment_status' => 'pending',
                'payment_id' => null,
            ],
        ];

        foreach ($bookings as $booking) {
            DB::table('bookings')->insert(array_merge($booking, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
