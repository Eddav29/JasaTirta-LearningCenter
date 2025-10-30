@extends('layouts.admin')

@section('title', 'Manajemen Peserta')

@section('content')
<div class="space-y-6">
    @include('pages.admin.participants._header')
    @include('pages.admin.participants._search-filter')
    @include('pages.admin.participants._bulk-actions')
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
