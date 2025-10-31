@extends('layouts.admin')

@section('title', 'Pesan Kontak - Admin')

@section('content')
<div class="space-y-6" x-data="messagesPageManager()">
    @include('pages.admin.messages._header')
    @include('pages.admin.messages._statistics')
    @include('pages.admin.messages._filters')
    @include('pages.admin.messages._bulk-actions')
    @include('pages.admin.messages._list')
</div>

@include('pages.admin.messages._view-dialog')
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('messagesPageManager', () => ({
        // Data
        messages: [],
        
        // Filters
        searchQuery: '',
        statusFilter: 'all',
        priorityFilter: 'all',
        categoryFilter: 'all',
        sourceFilter: 'all',
        assigneeFilter: 'all',
        
        // Pagination
        currentPage: 1,
        itemsPerPage: 5,
        
        // Selection
        selectedMessages: [],
        
        // Dialog states
        viewMessage: null,
        viewDialogOpen: false,
        
        // Computed: Filtered messages
        get filteredMessages() {
            return this.messages.filter(message => {
                const matchesSearch = this.searchQuery === '' || 
                    message.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    message.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    message.subject.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    message.message.toLowerCase().includes(this.searchQuery.toLowerCase());
                
                const matchesStatus = this.statusFilter === 'all' || message.status === this.statusFilter;
                const matchesPriority = this.priorityFilter === 'all' || message.priority === this.priorityFilter;
                const matchesCategory = this.categoryFilter === 'all' || message.category === this.categoryFilter;
                const matchesSource = this.sourceFilter === 'all' || message.source === this.sourceFilter;
                const matchesAssignee = this.assigneeFilter === 'all' || message.assignedTo === this.assigneeFilter;
                
                return matchesSearch && matchesStatus && matchesPriority && matchesCategory && matchesSource && matchesAssignee;
            });
        },
        
        // Computed: Paginated messages
        get paginatedMessages() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredMessages.slice(start, end);
        },
        
        // Computed: Total pages
        get totalPages() {
            return Math.ceil(this.filteredMessages.length / this.itemsPerPage);
        },
        
        // Computed: Statistics
        get stats() {
            const totalMessages = this.messages.length;
            const newCount = this.messages.filter(m => m.status === 'New').length;
            const repliedCount = this.messages.filter(m => m.status === 'Replied').length;
            const resolvedCount = this.messages.filter(m => m.status === 'Resolved').length;
            const messagesWithResponse = this.messages.filter(m => m.responseTime);
            const avgResponseTime = messagesWithResponse.length > 0
                ? messagesWithResponse.reduce((acc, m) => acc + m.responseTime, 0) / messagesWithResponse.length
                : 0;
            
            return {
                totalMessages,
                newCount,
                repliedCount,
                resolvedCount,
                avgResponseTime: Math.round(avgResponseTime * 10) / 10
            };
        },
        
        // Computed: Show bulk actions
        get showBulkActions() {
            return this.selectedMessages.length > 0;
        },
        
        // Methods: Selection
        toggleSelect(messageId) {
            const index = this.selectedMessages.indexOf(messageId);
            if (index === -1) {
                this.selectedMessages.push(messageId);
            } else {
                this.selectedMessages.splice(index, 1);
            }
        },
        
        isSelected(messageId) {
            return this.selectedMessages.includes(messageId);
        },
        
        selectAll() {
            if (this.selectedMessages.length === this.paginatedMessages.length) {
                this.selectedMessages = [];
            } else {
                this.selectedMessages = this.paginatedMessages.map(m => m.id);
            }
        },
        
        // Methods: Actions
        handleViewClick(message) {
            this.viewMessage = message;
            this.viewDialogOpen = true;
            
            // Mark as read if status is new
            if (message.status === 'New') {
                const index = this.messages.findIndex(m => m.id === message.id);
                if (index !== -1) {
                    this.messages[index].status = 'Read';
                }
            }
        },
        
        handleDeleteMessage(messageId) {
            if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                this.messages = this.messages.filter(m => m.id !== messageId);
            }
        },
        
        handleBulkDelete() {
            if (confirm(`Apakah Anda yakin ingin menghapus ${this.selectedMessages.length} pesan yang dipilih?`)) {
                this.messages = this.messages.filter(m => !this.selectedMessages.includes(m.id));
                this.selectedMessages = [];
            }
        },
        
        handleBulkStatusChange(newStatus) {
            this.messages = this.messages.map(message => 
                this.selectedMessages.includes(message.id) 
                    ? { ...message, status: newStatus }
                    : message
            );
            this.selectedMessages = [];
        },
        
        handleBulkAssign(assignee) {
            this.messages = this.messages.map(message => 
                this.selectedMessages.includes(message.id) 
                    ? { ...message, assignedTo: assignee }
                    : message
            );
            this.selectedMessages = [];
        },
        
        // Helpers
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },
        
        getStatusConfig(status) {
            const configs = {
                'New': { color: 'bg-blue-100 text-blue-800', icon: '✉️', label: 'Baru' },
                'Read': { color: 'bg-yellow-100 text-yellow-800', icon: '👁️', label: 'Dibaca' },
                'Replied': { color: 'bg-purple-100 text-purple-800', icon: '↩️', label: 'Dibalas' },
                'Resolved': { color: 'bg-green-100 text-green-800', icon: '✓', label: 'Diselesaikan' },
                'Archived': { color: 'bg-gray-100 text-gray-800', icon: '📦', label: 'Diarsipkan' }
            };
            return configs[status] || configs.New;
        },
        
        getPriorityConfig(priority) {
            const configs = {
                'Low': { color: 'bg-gray-100 text-gray-800' },
                'Medium': { color: 'bg-blue-100 text-blue-800' },
                'High': { color: 'bg-orange-100 text-orange-800' },
                'Urgent': { color: 'bg-red-100 text-red-800' }
            };
            return configs[priority] || configs.Medium;
        },
        
        getSourceIcon(source) {
            const icons = {
                'Website': '🌐',
                'Email': '📧',
                'Phone': '📞',
                'Social Media': '📱',
                'Walk-in': '🚶'
            };
            return icons[source] || '📝';
        },
        
        // Watchers
        init() {
            this.$watch('searchQuery', () => this.currentPage = 1);
            this.$watch('statusFilter', () => this.currentPage = 1);
            this.$watch('priorityFilter', () => this.currentPage = 1);
            this.$watch('categoryFilter', () => this.currentPage = 1);
            this.$watch('sourceFilter', () => this.currentPage = 1);
            this.$watch('assigneeFilter', () => this.currentPage = 1);
        }
    }));
});
</script>
@endpush
