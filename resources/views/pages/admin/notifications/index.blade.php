@extends('layouts.admin')

@section('title', 'Manajemen Notifikasi')

@section('content')
<div class="space-y-6" x-data="notificationsPageManager()">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola notifikasi sistem</p>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Notifikasi</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="notifications.length"></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Belum Dibaca</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $unreadCount }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Training Baru</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="trainingCount"></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Jadwal Baru</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="scheduleCount"></p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Notifications List --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Notifikasi</h2>
                <button 
                    @click="markAllAsRead()"
                    class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                >
                    Tandai Semua Dibaca
                </button>
            </div>

            {{-- Notifications --}}
            <div class="space-y-3">
                @forelse($notifications as $notification)
                <div class="flex items-start gap-4 p-4 rounded-lg border {{ $notification->read_at ? 'border-gray-200 bg-white' : 'border-blue-200 bg-blue-50/50' }} hover:shadow-sm transition-shadow">
                    <div class="text-2xl mt-1">
                        @if(($notification->data['type'] ?? '') === 'new_training')
                            📚
                        @elseif(($notification->data['type'] ?? '') === 'new_schedule')
                            📅
                        @else
                            🔔
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold {{ $notification->read_at ? 'text-gray-700' : 'text-gray-900' }}">
                                    {{ $notification->data['title'] ?? 'Notifikasi' }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $notification->data['message'] ?? '' }}
                                </p>
                                <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                    @if(!$notification->read_at)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full font-medium">Baru</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if(!$notification->read_at)
                                <button 
                                    onclick="markAsRead('{{ $notification->id }}')"
                                    class="text-xs text-blue-600 hover:text-blue-700 px-3 py-1.5 hover:bg-blue-50 rounded transition-colors"
                                >
                                    Tandai Dibaca
                                </button>
                                @endif
                                <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit"
                                        onclick="return confirm('Hapus notifikasi ini?')"
                                        class="text-xs text-red-600 hover:text-red-700 px-3 py-1.5 hover:bg-red-50 rounded transition-colors"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-gray-500">Tidak ada notifikasi</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notificationsPageManager', () => ({
            notifications: @json($notifications->items()),
            trainingCount: 0,
            scheduleCount: 0,

            init() {
                this.calculateCounts();
            },

            calculateCounts() {
                this.trainingCount = this.notifications.filter(n => n.data?.type === 'new_training').length;
                this.scheduleCount = this.notifications.filter(n => n.data?.type === 'new_schedule').length;
            },

            async markAllAsRead() {
                try {
                    const response = await fetch('{{ route("admin.notifications.readAll") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    if (response.ok) {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error marking all as read:', error);
                }
            }
        }));
    });

    async function markAsRead(id) {
        try {
            const response = await fetch(`/admin/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            if (response.ok) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Error marking as read:', error);
        }
    }
</script>
@endpush
