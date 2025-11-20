@extends('layouts.user')

@section('title', 'Profil Saya - User')

@section('content')
<div class="space-y-6" x-data="userProfileManager()">
    @include('pages.user.profile._header')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            @include('pages.user.profile._profile-card')
        </div>
        <div class="lg:col-span-2 space-y-6">
            @include('pages.user.profile._personal-info')
            @include('pages.user.profile._security')
            @include('pages.user.profile._learning-preferences')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('userProfileManager', () => ({
        // User data
        user: {
            name: '{{ auth()->user()->name ?? "User Name" }}',
            email: '{{ auth()->user()->email ?? "user@example.com" }}',
            phone: '+62 812-3456-7890',
            avatar: 'https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? "User Name") }}&background=4F46E5&color=fff&size=200',
            joinDate: '{{ auth()->user()->created_at ? auth()->user()->created_at->format("Y-m-d") : "2024-01-15" }}',
            location: 'Jakarta, Indonesia',
            bio: 'Peserta aktif di Jasa Tirta Learning Center yang antusias untuk terus belajar dan berkembang.',
            studentId: 'STD{{ str_pad(auth()->user()->id ?? 1, 6, "0", STR_PAD_LEFT) }}'
        },
        
        // Edit states
        editingPersonalInfo: false,
        editingPassword: false,
        
        // Form data
        personalInfoForm: {
            name: '',
            email: '',
            phone: '',
            location: '',
            bio: ''
        },
        
        passwordForm: {
            currentPassword: '',
            newPassword: '',
            confirmPassword: ''
        },
        
        // Learning Preferences
        preferences: {
            emailNotifications: true,
            courseReminders: true,
            weeklyProgress: false,
            marketingEmails: false,
            preferredLearningTime: 'morning',
            difficultyLevel: 'intermediate',
            language: 'id'
        },
        
        // Learning Stats
        stats: {
            coursesEnrolled: 12,
            coursesCompleted: 8,
            certificatesEarned: 6,
            totalLearningHours: 48
        },
        
        // Recent Activity
        recentCourses: [
            {
                title: 'Manajemen Kualitas Air',
                progress: 75,
                lastAccessed: '2 hari yang lalu',
                status: 'in-progress'
            },
            {
                title: 'Pengolahan Air Limbah',
                progress: 100,
                lastAccessed: '1 minggu yang lalu',
                status: 'completed'
            },
            {
                title: 'Sistem Distribusi Air',
                progress: 45,
                lastAccessed: '3 hari yang lalu',
                status: 'in-progress'
            }
        ],
        
        // Methods
        init() {
            this.resetPersonalInfoForm();
        },
        
        resetPersonalInfoForm() {
            this.personalInfoForm = {
                name: this.user.name,
                email: this.user.email,
                phone: this.user.phone,
                location: this.user.location,
                bio: this.user.bio
            };
        },
        
        editPersonalInfo() {
            this.editingPersonalInfo = true;
        },
        
        cancelEditPersonalInfo() {
            this.editingPersonalInfo = false;
            this.resetPersonalInfoForm();
        },
        
        savePersonalInfo() {
            // Update user data
            this.user.name = this.personalInfoForm.name;
            this.user.email = this.personalInfoForm.email;
            this.user.phone = this.personalInfoForm.phone;
            this.user.location = this.personalInfoForm.location;
            this.user.bio = this.personalInfoForm.bio;
            
            this.editingPersonalInfo = false;
            
            // Show success message
            this.showNotification('Informasi profil berhasil diperbarui!', 'success');
        },
        
        editPassword() {
            this.editingPassword = true;
        },
        
        cancelEditPassword() {
            this.editingPassword = false;
            this.passwordForm = {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            };
        },
        
        savePassword() {
            // Validate passwords
            if (this.passwordForm.newPassword !== this.passwordForm.confirmPassword) {
                this.showNotification('Password baru dan konfirmasi password tidak cocok!', 'error');
                return;
            }
            
            if (this.passwordForm.newPassword.length < 8) {
                this.showNotification('Password minimal 8 karakter!', 'error');
                return;
            }
            
            // Save password (in real app, send to API)
            this.editingPassword = false;
            this.passwordForm = {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            };
            
            this.showNotification('Password berhasil diubah!', 'success');
        },
        
        savePreferences() {
            this.showNotification('Preferensi pembelajaran berhasil disimpan!', 'success');
        },
        
        uploadAvatar() {
            // Trigger file input
            document.getElementById('avatar-upload').click();
        },
        
        handleAvatarUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.user.avatar = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        
        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        
        showNotification(message, type = 'info') {
            // Simple alert for now - can be enhanced with proper notification system
            alert(message);
        },
        
        getProgressColor(progress) {
            if (progress >= 80) return 'bg-green-500';
            if (progress >= 60) return 'bg-blue-500';
            if (progress >= 40) return 'bg-yellow-500';
            return 'bg-red-500';
        },
        
        getStatusBadge(status) {
            switch(status) {
                case 'completed':
                    return 'bg-green-100 text-green-800';
                case 'in-progress':
                    return 'bg-blue-100 text-blue-800';
                case 'not-started':
                    return 'bg-gray-100 text-gray-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        },
        
        getStatusText(status) {
            switch(status) {
                case 'completed':
                    return 'Selesai';
                case 'in-progress':
                    return 'Berlangsung';
                case 'not-started':
                    return 'Belum Dimulai';
                default:
                    return 'Unknown';
            }
        }
    }));
});
</script>
@endpush