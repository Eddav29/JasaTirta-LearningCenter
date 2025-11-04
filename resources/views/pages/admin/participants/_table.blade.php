{{-- Participants Table --}}
@php
    $participants = [
        [
            'id' => 1,
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad.hidayat@email.com',
            'role' => 'Student',
            'status' => 'Active',
            'registeredCourses' => 3,
            'joinDate' => '2024-01-15',
            'phone' => '+62 812-3456-7890',
            'company' => 'PT Tirta Mandiri'
        ],
        [
            'id' => 2,
            'name' => 'Sari Wahyuni',
            'email' => 'sari.wahyuni@company.com',
            'role' => 'Corporate',
            'status' => 'Active',
            'registeredCourses' => 5,
            'joinDate' => '2024-02-10',
            'phone' => '+62 813-4567-8901',
            'company' => 'CV Lingkungan Sejahtera'
        ],
        [
            'id' => 3,
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com',
            'role' => 'Student',
            'status' => 'Inactive',
            'registeredCourses' => 1,
            'joinDate' => '2024-03-05',
            'phone' => '+62 814-5678-9012',
            'company' => null
        ],
        [
            'id' => 4,
            'name' => 'Maya Putri',
            'email' => 'maya.putri@corporate.com',
            'role' => 'Corporate',
            'status' => 'Active',
            'registeredCourses' => 2,
            'joinDate' => '2024-01-20',
            'phone' => '+62 815-1234-5678',
            'company' => 'PT Bersih Lestari'
        ],
        [
            'id' => 5,
            'name' => 'Dewi Lestari',
            'email' => 'dewi.lestari@email.com',
            'role' => 'Student',
            'status' => 'Pending',
            'registeredCourses' => 0,
            'joinDate' => '2024-03-28',
            'phone' => '+62 816-9876-5432',
            'company' => null
        ]
    ];

    function getStatusColor($status) {
        return match($status) {
            'Active' => 'bg-green-100 text-green-800',
            'Inactive' => 'bg-red-100 text-red-800',
            'Suspended' => 'bg-orange-100 text-orange-800',
            'Pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function getRoleColor($role) {
        return match($role) {
            'Corporate' => 'bg-blue-100 text-blue-800',
            'Instructor' => 'bg-purple-100 text-purple-800',
            'Admin' => 'bg-indigo-100 text-indigo-800',
            'Student' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

<div class="mt-6 bg-white rounded-lg border border-gray-200" x-data="participantsManager()" x-init="participants = {{ json_encode($participants) }}">
    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Peserta</h3>
        <p class="text-sm text-gray-600 mt-1">
            <span x-text="`Menampilkan ${filteredParticipants.length} dari ${participants.length} peserta`"></span>
        </p>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-900 w-12">
                            <input 
                                type="checkbox" 
                                @change="selectAll()"
                                :checked="selectedParticipants.length === paginatedParticipants.length && paginatedParticipants.length > 0"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Nama</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Email</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Role</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Bergabung</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="participant in paginatedParticipants" :key="participant.id">
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox" 
                                    :checked="isSelected(participant.id)"
                                    @change="toggleSelect(participant.id)"
                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        <span x-text="getInitials(participant.name)"></span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900" x-text="participant.name"></p>
                                        <p class="text-sm text-gray-600" x-text="participant.company || '-'"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-600" x-text="participant.email"></td>
                            <td class="py-4 px-4">
                                @foreach($participants as $participant)
                                <template x-if="participant.id === {{ $participant['id'] }}">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ getRoleColor($participant['role']) }}" x-text="participant.role"></span>
                                </template>
                                @endforeach
                            </td>
                            <td class="py-4 px-4">
                                @foreach($participants as $participant)
                                <template x-if="participant.id === {{ $participant['id'] }}">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ getStatusColor($participant['status']) }}" x-text="participant.status"></span>
                                </template>
                                @endforeach
                            </td>
                            <td class="py-4 px-4 text-gray-600">
                                <span x-text="participant.registeredCourses"></span> pelatihan
                            </td>
                            <td class="py-4 px-4 text-gray-600" x-text="formatDate(participant.joinDate)"></td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <button class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button 
                                        @click="deleteParticipant(participant.id)"
                                        class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors"
                                        title="Hapus"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            
            {{-- Empty State --}}
            <div x-show="filteredParticipants.length === 0" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada peserta</h3>
                <p class="mt-1 text-sm text-gray-500">Tidak ada peserta yang sesuai dengan filter yang dipilih.</p>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200" x-show="filteredParticipants.length > 0">
            <div class="text-sm text-gray-600">
                Menampilkan <span x-text="(currentPage - 1) * itemsPerPage + 1"></span>-<span x-text="Math.min(currentPage * itemsPerPage, filteredParticipants.length)"></span> dari <span x-text="filteredParticipants.length"></span> peserta
            </div>
            <div class="flex items-center gap-2">
                <button
                    @click="currentPage > 1 && currentPage--"
                    :disabled="currentPage === 1"
                    :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </button>
                <span class="text-sm text-gray-600">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>
                <button
                    @click="currentPage < totalPages && currentPage++"
                    :disabled="currentPage >= totalPages"
                    :class="currentPage >= totalPages ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-lg transition-colors"
                >
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
