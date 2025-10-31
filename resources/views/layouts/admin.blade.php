<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Admin Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-50" x-data="{ sidebarOpen: true, profileOpen: false }">
    <div class="min-h-screen">
        @include('layouts.admin._sidebar')
        @include('layouts.admin._navbar')
        
        {{-- Main Content --}}
        <div class="transition-all duration-300" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">
            <div class="pt-20 px-4 sm:px-6 lg:px-8 py-8">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('notificationsManager', () => ({
                notifications: [
                    {
                        id: 1,
                        type: 'training',
                        title: 'Pelatihan Baru Ditambahkan',
                        message: 'Pelatihan "Teknik Sampling Air" telah ditambahkan ke sistem',
                        time: '5 menit yang lalu',
                        read: false
                    },
                    {
                        id: 2,
                        type: 'enrollment',
                        title: 'Pendaftaran Baru',
                        message: 'Ahmad Hidayat mendaftar pelatihan Analisis Laboratorium',
                        time: '15 menit yang lalu',
                        read: false
                    },
                    {
                        id: 3,
                        type: 'schedule',
                        title: 'Jadwal Pelatihan Berubah',
                        message: 'Jadwal pelatihan Mikrobiologi Air dipindahkan ke tanggal 15 November',
                        time: '1 jam yang lalu',
                        read: false
                    },
                    {
                        id: 4,
                        type: 'message',
                        title: 'Pesan Baru dari Peserta',
                        message: 'Anda memiliki pesan baru dari Sari Wahyuni',
                        time: '2 jam yang lalu',
                        read: true
                    },
                    {
                        id: 5,
                        type: 'certificate',
                        title: 'Sertifikat Telah Diterbitkan',
                        message: 'Sertifikat untuk Budi Santoso telah berhasil diterbitkan',
                        time: '3 jam yang lalu',
                        read: true
                    }
                ],

                get unreadCount() {
                    return this.notifications.filter(n => !n.read).length;
                },

                markAsRead(id) {
                    const notification = this.notifications.find(n => n.id === id);
                    if (notification) {
                        notification.read = true;
                    }
                },

                markAllAsRead() {
                    this.notifications.forEach(n => n.read = true);
                },

                deleteNotification(id) {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                },

                getNotificationIcon(type) {
                    const icons = {
                        training: '📚',
                        enrollment: '👤',
                        schedule: '📅',
                        message: '💬',
                        certificate: '🎓',
                        payment: '💰',
                        system: '⚙️'
                    };
                    return icons[type] || '🔔';
                }
            }));
        });
    </script>

    @stack('scripts')
</body>
</html>
