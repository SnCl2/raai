<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Raai Admin') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: '#6366f1', // Indigo 500
                        secondary: '#ec4899', // Pink 500
                        dark: '#0f172a', // Slate 900
                        glass: 'rgba(255, 255, 255, 0.05)',
                    }
                }
            }
        }
    </script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-link {
            @apply flex items-center px-6 py-3 text-gray-400 hover:bg-white/5 hover:text-white transition-colors border-l-4 border-transparent;
        }
        .sidebar-link.active {
            @apply bg-white/5 text-white border-primary;
        }
    </style>
</head>
<body class="antialiased h-screen flex overflow-hidden">

    <!-- Mobile sidebar backdrop -->
    <div x-data="{ open: false }" class="md:hidden">
        <div x-show="open" @click="open = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"></div>
        <!-- Mobile Sidebar would go here, omitting for brevity/simplicity, using desktop sidebar for now -->
    </div>

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 bg-dark/80 backdrop-blur-xl border-r border-white/10 w-64 transform transition-transform duration-300 ease-in-out z-30 md:translate-x-0 md:static md:inset-0 flex flex-col" :class="{'translate-x-0': open, '-translate-x-full': !open}">
        
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-8 border-b border-white/10">
            <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary tracking-wide">
                Raai Admin
            </h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-6 px-4 space-y-2 overflow-y-auto custom-scrollbar">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-home w-6 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Dashboard</span>
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Management
            </div>

            <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.services.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-cubes w-6 transition-colors duration-200 {{ request()->routeIs('admin.services.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Services</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.bookings.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-calendar-check w-6 transition-colors duration-200 {{ request()->routeIs('admin.bookings.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Bookings</span>
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Content
            </div>

            <a href="{{ route('admin.banners.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.banners.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-images w-6 transition-colors duration-200 {{ request()->routeIs('admin.banners.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Banners</span>
            </a>

            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.testimonials.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-star w-6 transition-colors duration-200 {{ request()->routeIs('admin.testimonials.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Testimonials</span>
            </a>

            <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.projects.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-briefcase w-6 transition-colors duration-200 {{ request()->routeIs('admin.projects.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Portfolio</span>
            </a>

            <div class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                System
            </div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.settings.*') ? 'bg-primary/10 text-white shadow-lg shadow-primary/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-cog w-6 transition-colors duration-200 {{ request()->routeIs('admin.settings.*') ? 'text-primary' : 'text-gray-500 group-hover:text-white' }}"></i>
                <span>Settings</span>
            </a>
        </nav>

        <!-- User Profile / Logout -->
        <div class="p-4 border-t border-white/10 bg-black/20">
            <div class="flex items-center mb-4 px-2">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-white/10 rounded-lg shadow-sm text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header (Mobile only menu button + User profile?) -->
        <header class="h-16 glass border-b border-white/10 flex items-center justify-between px-6 md:px-8">
            <div class="md:hidden">
                <button class="text-gray-400 hover:text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <div class="ml-auto flex items-center space-x-4">
                <span class="text-sm text-gray-400">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-primary to-secondary"></div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            {{ $slot }}
        </main>
    </div>

</body>
</html>
