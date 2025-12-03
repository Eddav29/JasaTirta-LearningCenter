<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JTLC - Jasa Tirta Learning Center</title>

    {{-- logo --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased">
    <x-loader />
    
    <div id="app">
        <x-header />
        
        @yield('content')
        
        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>
