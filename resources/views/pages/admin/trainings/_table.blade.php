{{-- Trainings Table --}}
@php
    function getStatusColor($isActive) {
        return $isActive
            ? 'bg-green-100 text-green-800'
            : 'bg-red-100 text-red-800';
    }

    function getStatusText($isActive) {
        return $isActive ? 'Active' : 'Inactive';
    }

    function getLevelColor($level) {
        return match($level) {
            'Expert' => 'bg-purple-100 text-purple-800',
            'Advanced' => 'bg-blue-100 text-blue-800',
            'Intermediate' => 'bg-indigo-100 text-indigo-800',
            'Beginner' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    function formatCurrency($amount) {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
@endphp

<div class="mt-6 bg-white rounded-lg border border-gray-200" x-data="{
    selectedTrainings: [],
    selectAll() {
        if (this.selectedTrainings.length === {{ $trainings->count() }}) {
            this.selectedTrainings = [];
        } else {
            this.selectedTrainings = [{{ $trainings->pluck('id')->join(',') }}];
        }
    },
    toggleSelect(id) {
        const index = this.selectedTrainings.indexOf(id);
        if (index > -1) {
            this.selectedTrainings.splice(index, 1);
        } else {
            this.selectedTrainings.push(id);
        }
    },
    isSelected(id) {
        return this.selectedTrainings.includes(id);
    },
    get allSelected() {
        return this.selectedTrainings.length === {{ $trainings->count() }} && {{ $trainings->count() }} > 0;
    },
    bulkDelete() {
        if (this.selectedTrainings.length === 0) {
            alert('Pilih pelatihan yang ingin dihapus');
            return;
        }
        if (confirm(`Hapus ${this.selectedTrainings.length} pelatihan?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.trainings.bulk-delete') }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            const idsInput = document.createElement('input');
            idsInput.type = 'hidden';
            idsInput.name = 'ids';
            idsInput.value = JSON.stringify(this.selectedTrainings);
            form.appendChild(idsInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    },
    bulkUpdateStatus(status) {
        if (this.selectedTrainings.length === 0) {
            alert('Pilih pelatihan yang ingin diubah statusnya');
            return;
        }
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('admin.trainings.bulk-status') }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        const idsInput = document.createElement('input');
        idsInput.type = 'hidden';
        idsInput.name = 'ids';
        idsInput.value = JSON.stringify(this.selectedTrainings);
        form.appendChild(idsInput);
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'is_active';
        statusInput.value = status;
        form.appendChild(statusInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}">
    {{-- Bulk Actions Bar --}}
    <div x-show="selectedTrainings.length > 0" x-transition class="bg-blue-50 border-b border-blue-200 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-blue-900" x-text="`${selectedTrainings.length} pelatihan dipilih`"></span>
                <div class="flex items-center gap-2">
                    <button @click="bulkUpdateStatus(1)" class="inline-flex items-center px-3 py-1.5 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Aktifkan
                    </button>
                    <button @click="bulkUpdateStatus(0)" class="inline-flex items-center px-3 py-1.5 text-sm bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Non-aktifkan
                    </button>
                    <button @click="bulkDelete()" class="inline-flex items-center px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
            <button @click="selectedTrainings = []" class="px-3 py-1.5 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
                Batal
            </button>
        </div>
    </div>

    <div class="p-6 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-900">Daftar Pelatihan</h3>
        <p class="text-sm text-gray-600 mt-1">
            Menampilkan {{ $trainings->count() }} dari {{ $trainings->total() }} pelatihan
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
                                :checked="allSelected"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                            />
                        </th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Gambar</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Pelatihan</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Kategori</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Level</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Status</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Instructor</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Kapasitas</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Harga</th>
                        <th class="text-left py-3 px-4 font-medium text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trainings as $training)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <input 
                                    type="checkbox" 
                                    :checked="isSelected({{ $training->id }})"
                                    @change="toggleSelect({{ $training->id }})"
                                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                />
                            </td>
                            <td class="py-4 px-4">
                                @if($training->image)
                                    <img src="{{ Storage::url($training->image) }}" alt="{{ $training->title }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $training->title }}</p>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($training->description, 80) }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs text-gray-500">{{ $training->duration }} jam</span>
                                        @if($training->certification_note)
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-3 h-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                                <span class="text-xs text-orange-600">Bersertifikat</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $training->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getLevelColor($training->training_type) }}">
                                    {{ $training->training_type }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ getStatusColor($training->is_active) }}">
                                    {{ getStatusText($training->is_active) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm font-medium">{{ $training->instructor->name ?? 'No Instructor' }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-medium">{{ $training->schedules->sum('enrolled_count') ?? 0 }}/{{ $training->capacity }}</p>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                        @php
                                            $enrolledCount = $training->schedules->sum('enrolled_count') ?? 0;
                                            $percentage = $training->capacity > 0 ? ($enrolledCount / $training->capacity) * 100 : 0;
                                        @endphp
                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm font-medium">{{ formatCurrency($training->price) }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.trainings.show', $training) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.trainings.edit', $training) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.trainings.destroy', $training) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pelatihan</h3>
                                <p class="mt-1 text-sm text-gray-500">Tidak ada pelatihan yang sesuai dengan filter yang dipilih.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Laravel Pagination --}}
        @if($trainings->hasPages())
            <div class="flex items-center justify-between px-6 py-4 border-t border-gray-200 mt-4">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $trainings->firstItem() ?? 0 }}-{{ $trainings->lastItem() ?? 0 }} dari {{ $trainings->total() }} pelatihan
                </div>
                <div class="flex items-center gap-2">
                    {{-- Previous Page Link --}}
                    @if ($trainings->onFirstPage())
                        <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-400 cursor-not-allowed">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </span>
                    @else
                        <a href="{{ $trainings->previousPageUrl() }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Previous
                        </a>
                    @endif

                    <span class="text-sm text-gray-600">
                        Halaman {{ $trainings->currentPage() }} dari {{ $trainings->lastPage() }}
                    </span>

                    {{-- Next Page Link --}}
                    @if ($trainings->hasMorePages())
                        <a href="{{ $trainings->nextPageUrl() }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors">
                            Next
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @else
                        <span class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-400 cursor-not-allowed">
                            Next
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
