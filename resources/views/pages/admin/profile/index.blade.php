@extends('layouts.admin')

@section('title', 'Profil Saya - Admin')

@section('content')
<div class="space-y-6" x-data="profileManager()">
    @include('pages.admin.profile._header')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            @include('pages.admin.profile._profile-card')
        </div>
        <div class="lg:col-span-2 space-y-6">
            @include('pages.admin.profile._personal-info')
            @include('pages.admin.profile._security')
            @include('pages.admin.profile._preferences')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('profileManager', () => ({
        // User data
        user: {
            name: 'Admin User',
            email: 'admin@jasatirta.com',
            phone: '+62 812-3456-7890',
            role: 'Super Admin',
            avatar: 'https://ui-avatars.com/api/?name=Admin+User&background=4F46E5&color=fff&size=200',
            joinDate: '2024-01-15',
            department: 'IT & Operations',
            location: 'Jakarta, Indonesia',
            bio: 'Mengelola sistem pembelajaran dan koordinasi pelatihan di Jasa Tirta Learning Center.'
        },
        
        // Edit states
        editingPersonalInfo: false,
        editingPassword: false,
        
        // Form data
        personalInfoForm: {
            name: '',
            email: '',
            phone: '',
            department: '',
            location: '',
            bio: ''
        },
        
        passwordForm: {
            currentPassword: '',
            newPassword: '',
            confirmPassword: ''
        },
        
        // Preferences
        preferences: {
            emailNotifications: true,
            pushNotifications: false,
            weeklyReport: true,
            marketingEmails: false,
            language: 'id',
            timezone: 'Asia/Jakarta',
            dateFormat: 'DD/MM/YYYY'
        },
        
        // Stats
        stats: {
            totalTrainings: 24,
            activeParticipants: 156,
            completedCourses: 18,
            averageRating: 4.8
        },
        
        // Methods
        init() {
            this.resetPersonalInfoForm();
        },
        
        resetPersonalInfoForm() {
            this.personalInfoForm = {
                name: this.user.name,
                email: this.user.email,
                phone: this.user.phone,
                department: this.user.department,
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
            this.user.department = this.personalInfoForm.department;
            this.user.location = this.personalInfoForm.location;
            this.user.bio = this.personalInfoForm.bio;
            
            this.editingPersonalInfo = false;
            
            // Show success message
            alert('Informasi profil berhasil diperbarui!');
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
                alert('Password baru dan konfirmasi password tidak cocok!');
                return;
            }
            
            if (this.passwordForm.newPassword.length < 8) {
                alert('Password minimal 8 karakter!');
                return;
            }
            
            // Save password (in real app, send to API)
            this.editingPassword = false;
            this.passwordForm = {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            };
            
            alert('Password berhasil diubah!');
        },
        
        savePreferences() {
            alert('Preferensi berhasil disimpan!');
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
        }
    }));
});
</script>
@endpush
