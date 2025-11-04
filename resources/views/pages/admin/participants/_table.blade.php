{{-- Participants Table --}}
<div class="mt-6 bg-white rounded-lg border border-gray-200" x-data="{
    selectedParticipants: [],
    selectAll() {
        if (this.selectedParticipants.length === {{ $participants->count() }}) {
            this.selectedParticipants = [];
        } else {
            this.selectedParticipants = [{{ $participants->pluck('id')->implode(',') }}];
        }
    },
    toggleSelect(id) {
        const index = this.selectedParticipants.indexOf(id);
        if (index === -1) {
            this.selectedParticipants.push(id);
        } else {
            this.selectedParticipants.splice(index, 1);
        }
    },
    bulkDelete() {
        if (this.selectedParticipants.length === 0) {
            alert('Pilih peserta terlebih dahulu');
            return;
        }
        
        if (!confirm(`Apakah Anda yakin ingin menghapus ${this.selectedParticipants.length} peserta?`)) {
            return;
        }
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.participants.bulk-delete') }}';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = JSON.stringify(this.selectedParticipants);
        form.appendChild(idsInput);
        
        document.body.appendChild(form);
        form.submit();
    },
    bulkUpdateStatus(status) {
        if (this.selectedParticipants.length === 0) {
            alert('Pilih peserta terlebih dahulu');
            return;
        }
        
        const statusText = status === 'active' ? 'mengaktifkan' : 'menonaktifkan';
        if (!confirm(`Apakah Anda yakin ingin ${statusText} ${this.selectedParticipants.length} peserta?`)) {
            return;
        }
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.participants.bulk-status') }}';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = JSON.stringify(this.selectedParticipants);
        form.appendChild(idsInput);
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}">
    {{-- Bulk Actions Bar --}}
    <div x-show="selectedParticipants.length > 0" class="bg-blue-50 border-b border-blue-200 p-4">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-blue-900">
                <span x-text="selectedParticipants.length"></span> peserta dipilih
            </span>
            <div class="flex items-center gap-2">
                <button @click="bulkUpdateStatus('active')" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Aktifkan
                </button>
                <button @click="bulkUpdateStatus('inactive')" class="inline-flex items-center px-3 py-1.5 bg-orange-600 text-white text-sm rounded-lg hover:bg-orange-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Non-aktifkan
                </button>
                <button @click="bulkDelete()" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Peserta</h3>
        <p class="text-sm text-gray-600 mt-1">
            Menampilkan {{ $participants->count() }} dari {{ $participants->total() }} peserta
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
                                :checked="selectedParticipants.length === {{ $participants->count() }} && {{ $participants->count() }} > 0"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Nama</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Email</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Telepon</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Role</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Bergabung</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $participant)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox" 
                                    :checked="selectedParticipants.includes({{ $participant->id }})"
                                    @change="toggleSelect({{ $participant->id }})"
                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        {{ strtoupper(substr($participant->first_name, 0, 1) . substr($participant->last_name ?? '', 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900">{{ $participant->first_name }} {{ $participant->last_name }}</p>
                                        <p class="text-sm text-gray-600">{{ $participant->company_name ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-600">{{ $participant->email }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $participant->phone ?? '-' }}</td>
                            <td class="py-4 px-4">
                                @php
                                    $role = $participant->getRoleNames()->first() ?? 'student';
                                    $roleColor = match($role) {
                                        'corporate' => 'bg-blue-100 text-blue-800',
                                        'instructor' => 'bg-purple-100 text-purple-800',
                                        'admin' => 'bg-indigo-100 text-indigo-800',
                                        'participant' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $roleColor }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @php
                                    $isActive = $participant->email_verified_at !== null;
                                    $statusColor = $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    $statusText = $isActive ? 'Active' : 'Inactive';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-gray-600">{{ $participant->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.participants.show', $participant) }}" class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.participants.edit', $participant) }}" class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.participants.destroy', $participant) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada peserta</h3>
                                <p class="mt-1 text-sm text-gray-500">Tidak ada peserta yang sesuai dengan filter yang dipilih.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($participants->hasPages())
            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $participants->firstItem() }}-{{ $participants->lastItem() }} dari {{ $participants->total() }} peserta
                </div>
                <div class="flex items-center gap-2">
                    {{ $participants->withQueryString()->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </div>
</div>
