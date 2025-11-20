@extends('layouts.admin')

@section('title', 'Manajemen Peserta')

@section('content')
{{-- Flash Messages --}}
@if(session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-green-600 hover:text-green-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <button @click="show = false" class="text-red-600 hover:text-red-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

<div class="space-y-6">
    @include('pages.admin.participants._header')
    @include('pages.admin.participants._search-filter')
    @include('pages.admin.participants._statistics')
    @include('pages.admin.participants._table')
</div>
@endsection

@push('scripts')
<script>
    // Alpine.js component for participants management
    document.addEventListener('alpine:init', () => {
        Alpine.data('participantsManager', () => ({
            searchQuery: '',
            roleFilter: 'all',
            statusFilter: 'all',
            currentPage: 1,
            itemsPerPage: 5,
            selectedParticipants: [],
            participants: [],
            
            get filteredParticipants() {
                return this.participants.filter(participant => {
                    const matchesSearch = 
                        participant.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        participant.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        (participant.company && participant.company.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    
                    const matchesRole = this.roleFilter === 'all' || participant.role === this.roleFilter;
                    const matchesStatus = this.statusFilter === 'all' || participant.status === this.statusFilter;
                    
                    return matchesSearch && matchesRole && matchesStatus;
                });
            },
            
            get paginatedParticipants() {
                const startIndex = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredParticipants.slice(startIndex, startIndex + this.itemsPerPage);
            },
            
            get totalPages() {
                return Math.ceil(this.filteredParticipants.length / this.itemsPerPage);
            },
            
            get stats() {
                const total = this.participants.length;
                const active = this.participants.filter(p => p.status === 'Active').length;
                const corporate = this.participants.filter(p => p.role === 'Corporate').length;
                const newParticipants = this.participants.filter(p => {
                    const joinDate = new Date(p.joinDate);
                    const thirtyDaysAgo = new Date();
                    thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
                    return joinDate >= thirtyDaysAgo;
                }).length;
                
                return {
                    total,
                    active,
                    corporate,
                    new: newParticipants
                };
            },
            
            get showBulkActions() {
                return this.selectedParticipants.length > 0;
            },
            
            selectAll() {
                if (this.selectedParticipants.length === this.paginatedParticipants.length) {
                    this.selectedParticipants = [];
                } else {
                    this.selectedParticipants = this.paginatedParticipants.map(p => p.id);
                }
            },
            
            toggleSelect(id) {
                const index = this.selectedParticipants.indexOf(id);
                if (index > -1) {
                    this.selectedParticipants.splice(index, 1);
                } else {
                    this.selectedParticipants.push(id);
                }
            },
            
            isSelected(id) {
                return this.selectedParticipants.includes(id);
            },
            
            getInitials(name) {
                return name.split(' ').map(n => n[0]).join('');
            },
            
            deleteParticipant(id) {
                if (confirm('Apakah Anda yakin ingin menghapus peserta ini?')) {
                    this.participants = this.participants.filter(p => p.id !== id);
                }
            },
            
            bulkDelete() {
                if (confirm(`Hapus ${this.selectedParticipants.length} peserta?`)) {
                    this.participants = this.participants.filter(p => !this.selectedParticipants.includes(p.id));
                    this.selectedParticipants = [];
                }
            },
            
            bulkStatusChange(status) {
                this.participants = this.participants.map(p => 
                    this.selectedParticipants.includes(p.id) ? {...p, status} : p
                );
                this.selectedParticipants = [];
            },
            
            formatDate(dateString) {
                const options = { year: 'numeric', month: 'short', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            },
            
            init() {
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('roleFilter', () => this.currentPage = 1);
                this.$watch('statusFilter', () => this.currentPage = 1);
            }
        }));
    });
</script>
@endpush
