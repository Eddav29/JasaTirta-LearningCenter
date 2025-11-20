<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false, desktopSidebarOpen: true, profileOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'JasaTirta Learning Center') }} - User Dashboard</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        {{-- Sidebar --}}
        @include('layouts.user._sidebar')

        {{-- Navbar --}}
        @include('layouts.user._navbar')

        {{-- Mobile Overlay --}}
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-600 bg-opacity-75 backdrop-blur-sm z-30 lg:hidden"
            style="display: none;"
        ></div>

        {{-- Main Content --}}
        <div 
            class="transition-all duration-300"
            :class="desktopSidebarOpen ? 'lg:ml-64' : 'lg:ml-20'"
        >
            <div class="pt-24 px-4 sm:px-6 lg:px-8 py-8">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
