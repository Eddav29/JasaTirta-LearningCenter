{{-- Upcoming Schedules Section --}}
<div class="bg-white rounded-lg border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Jadwal Mendatang</h3>
        <p class="text-sm text-gray-600 mt-1">Pelatihan yang akan dimulai dalam 7 hari ke depan</p>
    </div>
    <div class="p-6">
        @if($upcomingSchedules->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Tanggal & Waktu</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Peserta</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Pengajar</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingSchedules as $schedule)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">{{ $schedule->training->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $schedule->training->category->name }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-sm">
                                        <p class="text-gray-900">{{ $schedule->start_date->format('d M Y') }}</p>
                                        <p class="text-gray-600">{{ $schedule->formatted_time_range }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-sm">
                                        <p class="text-gray-900">{{ $schedule->registered_count }}/{{ $schedule->total_slots }}</p>
                                        {{-- Mini Progress Bar --}}
                                        <div class="w-16 bg-gray-200 rounded-full h-1 mt-1">
                                            <div class="bg-blue-600 h-1 rounded-full" style="width: {{ $schedule->total_slots > 0 ? ($schedule->registered_count / $schedule->total_slots) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="text-sm text-gray-900">{{ $schedule->training->instructor?->name ?? 'TBA' }}</p>
                                </td>
                                <td class="py-4 px-4">
                                    @php
                                        $statusConfig = match($schedule->status) {
                                            'buka_pendaftaran' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Terbuka'],
                                            'penuh' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Penuh'],
                                            'berlangsung' => ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Berlangsung'],
                                            'selesai' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Selesai'],
                                            default => ['class' => 'bg-gray-100 text-gray-800', 'text' => ucfirst($schedule->status)]
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusConfig['class'] }}">
                                        {{ $statusConfig['text'] }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <a href="{{ route('admin.schedules.show', $schedule->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="mt-2 text-sm text-gray-500">Tidak ada jadwal mendatang dalam 7 hari ke depan</p>
            </div>
        @endif
    </div>
</div>
