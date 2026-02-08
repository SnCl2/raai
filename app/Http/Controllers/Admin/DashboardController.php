<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('payment_status', 'pending')->count(),
            'active_services' => Service::count(),
            'projects' => Project::count(),
        ];

        $recent_bookings = Booking::with('service')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings'));
    }
}
