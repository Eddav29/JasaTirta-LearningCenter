<div x-data="messagesPageManager()" class="space-y-4">
    <!-- Search Bar -->
    <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input 
            type="text" 
            x-model="searchQuery"
            placeholder="Cari pesan, nama, email, atau subjek..."
            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
    </div>

    <!-- Filters Row -->
    <div class="flex flex-wrap gap-3">
        <!-- Status Filter -->
        <select x-model="statusFilter" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all">Semua Status</option>
            <option value="New">Baru</option>
            <option value="Read">Dibaca</option>
            <option value="Replied">Dibalas</option>
            <option value="Resolved">Diselesaikan</option>
            <option value="Archived">Diarsipkan</option>
        </select>

        <!-- Priority Filter -->
        <select x-model="priorityFilter" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all">Semua Prioritas</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
            <option value="Urgent">Urgent</option>
        </select>

        <!-- Category Filter -->
        <select x-model="categoryFilter" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all">Semua Kategori</option>
            <option value="General">General</option>
            <option value="Course Inquiry">Course Inquiry</option>
            <option value="Technical Support">Technical Support</option>
            <option value="Billing">Billing</option>
            <option value="Complaint">Complaint</option>
            <option value="Suggestion">Suggestion</option>
        </select>

        <!-- Source Filter -->
        <select x-model="sourceFilter" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all">Semua Sumber</option>
            <option value="Website">Website</option>
            <option value="Email">Email</option>
            <option value="Phone">Phone</option>
            <option value="Social Media">Social Media</option>
            <option value="Walk-in">Walk-in</option>
        </select>

        <!-- Assignee Filter -->
        <select x-model="assigneeFilter" class="px-4 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all">Semua Assignee</option>
            <option value="Admin Training">Admin Training</option>
            <option value="Manager">Manager</option>
            <option value="IT Support">IT Support</option>
            <option value="Finance">Finance</option>
            <option value="Lab Manager">Lab Manager</option>
            <option value="Quality Assurance">Quality Assurance</option>
        </select>
    </div>
</div>
