@extends('layouts.admin')

@section('title', 'Manajemen Notifikasi')

@section('content')
<div class="space-y-6">
    @include('pages.admin.notifications._header')
    @include('pages.admin.notifications._statistics')
    @include('pages.admin.notifications._filters')
    @include('pages.admin.notifications._bulk-actions')
    @include('pages.admin.notifications._list')
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notificationsPageManager', () => ({
            // State
            searchQuery: '',
            typeFilter: 'all',
            statusFilter: 'all',
            priorityFilter: 'all',
            channelFilter: 'all',
            currentPage: 1,
            itemsPerPage: 5,
            selectedNotifications: [],
            notifications: [],

            // Computed: Filtered notifications
            get filteredNotifications() {
                return this.notifications.filter(notification => {
                    const matchesSearch = this.searchQuery === '' ||
                        notification.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        notification.message.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        notification.createdBy.toLowerCase().includes(this.searchQuery.toLowerCase());
                    
                    const matchesType = this.typeFilter === 'all' || notification.type === this.typeFilter;
                    const matchesStatus = this.statusFilter === 'all' || notification.status === this.statusFilter;
                    const matchesPriority = this.priorityFilter === 'all' || notification.priority === this.priorityFilter;
                    const matchesChannel = this.channelFilter === 'all' || notification.channel === this.channelFilter;
                    
                    return matchesSearch && matchesType && matchesStatus && matchesPriority && matchesChannel;
                });
            },

            // Computed: Paginated notifications
            get paginatedNotifications() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return this.filteredNotifications.slice(start, end);
            },

            // Computed: Total pages
            get totalPages() {
                return Math.ceil(this.filteredNotifications.length / this.itemsPerPage);
            },

            // Computed: Statistics
            get stats() {
                const totalNotifications = this.notifications.length;
                const sentCount = this.notifications.filter(n => n.status === 'Sent').length;
                const scheduledCount = this.notifications.filter(n => n.status === 'Scheduled').length;
                const totalDelivered = this.notifications.reduce((sum, n) => sum + n.deliveredCount, 0);
                const totalRead = this.notifications.reduce((sum, n) => sum + n.readCount, 0);
                const averageReadRate = totalDelivered > 0 ? ((totalRead / totalDelivered) * 100).toFixed(1) : '0';
                
                return {
                    totalNotifications,
                    sentCount,
                    scheduledCount,
                    averageReadRate
                };
            },

            // Computed: Show bulk actions
            get showBulkActions() {
                return this.selectedNotifications.length > 0;
            },

            // Methods
            toggleSelect(id) {
                const index = this.selectedNotifications.indexOf(id);
                if (index > -1) {
                    this.selectedNotifications.splice(index, 1);
                } else {
                    this.selectedNotifications.push(id);
                }
            },

            isSelected(id) {
                return this.selectedNotifications.includes(id);
            },

            selectAll() {
                if (this.selectedNotifications.length === this.paginatedNotifications.length) {
                    this.selectedNotifications = [];
                } else {
                    this.selectedNotifications = this.paginatedNotifications.map(n => n.id);
                }
            },

            deleteNotification(id) {
                if (confirm('Apakah Anda yakin ingin menghapus notifikasi ini?')) {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }
            },

            bulkDelete() {
                if (confirm(`Apakah Anda yakin ingin menghapus ${this.selectedNotifications.length} notifikasi?`)) {
                    this.notifications = this.notifications.filter(n => !this.selectedNotifications.includes(n.id));
                    this.selectedNotifications = [];
                }
            },

            bulkStatusChange(status) {
                this.notifications = this.notifications.map(n => 
                    this.selectedNotifications.includes(n.id) ? { ...n, status } : n
                );
                this.selectedNotifications = [];
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            },

            calculateDeliveryRate(delivered, target) {
                return target > 0 ? ((delivered / target) * 100).toFixed(1) : '0';
            },

            calculateReadRate(read, delivered) {
                return delivered > 0 ? ((read / delivered) * 100).toFixed(1) : '0';
            },

            getChannelIcon(channel) {
                const icons = {
                    'Email': '📧',
                    'SMS': '📱',
                    'In-App': '🔔',
                    'Push': '💬',
                    'All Channels': '📡'
                };
                return icons[channel] || '🔔';
            },

            // Watchers
            init() {
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('typeFilter', () => this.currentPage = 1);
                this.$watch('statusFilter', () => this.currentPage = 1);
                this.$watch('priorityFilter', () => this.currentPage = 1);
                this.$watch('channelFilter', () => this.currentPage = 1);
            }
        }));
    });
</script>
@endpush
