<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $services = Service::all();
        $testimonials = Testimonial::latest()->get();
        $projects = Project::latest()->get();
        
        // Settings are global usually, but we can pass them or use a helper/provider.
        // For now, let's just pass specific ones if needed, or rely on View Composer if we had one.
        // Or just access Setting model in view directly (not best practice but simple).
        // Let's pass $settings array.
        $settings = Setting::all()->pluck('value', 'key');

        return view('welcome', compact('banners', 'services', 'testimonials', 'projects', 'settings'));
    }

    public function service($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $settings = Setting::all()->pluck('value', 'key');
        return view('service', compact('service', 'settings'));
    }
}
