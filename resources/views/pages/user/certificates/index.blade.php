@extends('layouts.user')

@section('title', 'Sertifikat Saya - User')

@section('content')
<div class="space-y-6" x-data="certificateManager()">
    @include('pages.user.certificates._header')
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        {{-- Statistics Sidebar --}}
        <div class="lg:col-span-1">
            @include('pages.user.certificates._statistics')
        </div>
        
        {{-- Main Content --}}
        <div class="lg:col-span-3 space-y-6">
            @include('pages.user.certificates._filters')
            @include('pages.user.certificates._certificate-grid')
        </div>
    </div>
    
    {{-- Certificate Detail Modal --}}
    @include('pages.user.certificates._certificate-modal')
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('certificateManager', () => ({
        // Filter states
        activeFilter: 'all',
        searchQuery: '',
        sortBy: 'latest',
        
        // Modal states
        showCertificateModal: false,
        selectedCertificate: null,
        isLoading: false,
        
        // Statistics
        stats: {
            totalCertificates: 8,
            completedCourses: 12,
            averageScore: 87.5,
            totalCredits: 96
        },
        
        // Certificate data
        certificates: [
            {
                id: 1,
                title: 'Manajemen Kualitas Air',
                course: 'Sistem Pengolahan Air Minum',
                issueDate: '2024-10-15',
                expiryDate: '2026-10-15',
                score: 92,
                grade: 'A',
                credits: 12,
                instructor: 'Dr. Ahmad Sudirman',
                certificateNumber: 'JTLC-2024-001',
                status: 'active',
                type: 'course',
                downloadUrl: '/certificates/download/1',
                verificationCode: 'JTLC240001',
                thumbnail: 'https://via.placeholder.com/400x300/2563eb/ffffff?text=Certificate'
            },
            {
                id: 2,
                title: 'Pengolahan Air Limbah',
                course: 'Teknologi Pengolahan Limbah',
                issueDate: '2024-09-20',
                expiryDate: '2026-09-20',
                score: 88,
                grade: 'B+',
                credits: 15,
                instructor: 'Prof. Siti Nurhaliza',
                certificateNumber: 'JTLC-2024-002',
                status: 'active',
                type: 'course',
                downloadUrl: '/certificates/download/2',
                verificationCode: 'JTLC240002',
                thumbnail: 'https://via.placeholder.com/400x300/059669/ffffff?text=Certificate'
            },
            {
                id: 3,
                title: 'Sertifikat Kompetensi Water Treatment',
                course: 'Program Sertifikasi Profesional',
                issueDate: '2024-08-10',
                expiryDate: '2027-08-10',
                score: 95,
                grade: 'A+',
                credits: 24,
                instructor: 'Tim Instruktur JTLC',
                certificateNumber: 'JTLC-PROF-001',
                status: 'active',
                type: 'professional',
                downloadUrl: '/certificates/download/3',
                verificationCode: 'JTLCPROF001',
                thumbnail: 'https://via.placeholder.com/400x300/dc2626/ffffff?text=Professional'
            },
            {
                id: 4,
                title: 'Sistem Distribusi Air',
                course: 'Infrastruktur Air Bersih',
                issueDate: '2024-07-05',
                expiryDate: '2026-07-05',
                score: 85,
                grade: 'B+',
                credits: 10,
                instructor: 'Ir. Bambang Prasetyo',
                certificateNumber: 'JTLC-2024-003',
                status: 'active',
                type: 'course',
                downloadUrl: '/certificates/download/4',
                verificationCode: 'JTLC240003',
                thumbnail: 'https://via.placeholder.com/400x300/7c3aed/ffffff?text=Certificate'
            },
            {
                id: 5,
                title: 'Analisis Kualitas Air',
                course: 'Laboratorium dan Testing',
                issueDate: '2024-06-15',
                expiryDate: '2025-06-15',
                score: 90,
                grade: 'A-',
                credits: 8,
                instructor: 'Dr. Maya Sari',
                certificateNumber: 'JTLC-2024-004',
                status: 'expiring',
                type: 'course',
                downloadUrl: '/certificates/download/5',
                verificationCode: 'JTLC240004',
                thumbnail: 'https://via.placeholder.com/400x300/ea580c/ffffff?text=Certificate'
            },
            {
                id: 6,
                title: 'Dasar-dasar Hidrologi',
                course: 'Sumber Daya Air',
                issueDate: '2023-12-20',
                expiryDate: '2025-12-20',
                score: 78,
                grade: 'B',
                credits: 6,
                instructor: 'Prof. Agus Wahyudi',
                certificateNumber: 'JTLC-2023-015',
                status: 'expired',
                type: 'course',
                downloadUrl: '/certificates/download/6',
                verificationCode: 'JTLC230015',
                thumbnail: 'https://via.placeholder.com/400x300/6b7280/ffffff?text=Expired'
            }
        ],
        
        // Computed properties
        get filteredCertificates() {
            let filtered = this.certificates;
            
            // Filter by status
            if (this.activeFilter !== 'all') {
                filtered = filtered.filter(cert => cert.status === this.activeFilter);
            }
            
            // Filter by search
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                filtered = filtered.filter(cert => 
                    cert.title.toLowerCase().includes(query) ||
                    cert.course.toLowerCase().includes(query) ||
                    cert.instructor.toLowerCase().includes(query)
                );
            }
            
            // Sort certificates
            filtered.sort((a, b) => {
                switch (this.sortBy) {
                    case 'latest':
                        return new Date(b.issueDate) - new Date(a.issueDate);
                    case 'oldest':
                        return new Date(a.issueDate) - new Date(b.issueDate);
                    case 'title':
                        return a.title.localeCompare(b.title);
                    case 'score':
                        return b.score - a.score;
                    default:
                        return 0;
                }
            });
            
            return filtered;
        },
        
        get certificatesByStatus() {
            return {
                active: this.certificates.filter(c => c.status === 'active').length,
                expiring: this.certificates.filter(c => c.status === 'expiring').length,
                expired: this.certificates.filter(c => c.status === 'expired').length
            };
        },
        
        // Methods
        setFilter(filter) {
            this.activeFilter = filter;
        },
        
        setSortBy(sort) {
            this.sortBy = sort;
        },
        
        viewCertificate(certificate) {
            this.selectedCertificate = certificate;
            this.showCertificateModal = true;
        },
        
        closeCertificateModal() {
            this.showCertificateModal = false;
            this.selectedCertificate = null;
        },
        
        downloadCertificate(certificate) {
            this.isLoading = true;
            // Simulate download delay
            setTimeout(() => {
                // In real implementation, this would trigger actual download
                window.open(certificate.downloadUrl, '_blank');
                this.isLoading = false;
                this.showNotification('Sertifikat berhasil diunduh!', 'success');
            }, 1000);
        },
        
        shareCertificate(certificate) {
            const url = `${window.location.origin}/certificates/verify/${certificate.verificationCode}`;
            navigator.clipboard.writeText(url).then(() => {
                this.showNotification('Link sertifikat berhasil disalin!', 'success');
            }).catch(() => {
                this.showNotification('Gagal menyalin link sertifikat.', 'error');
            });
        },
        
        verifyCertificate(certificate) {
            const url = `${window.location.origin}/certificates/verify/${certificate.verificationCode}`;
            window.open(url, '_blank');
        },
        
        formatDate(dateString) {
            return new Date(dateString).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        
        getStatusColor(status) {
            switch (status) {
                case 'active':
                    return 'bg-green-100 text-green-800 border-green-200';
                case 'expiring':
                    return 'bg-yellow-100 text-yellow-800 border-yellow-200';
                case 'expired':
                    return 'bg-red-100 text-red-800 border-red-200';
                default:
                    return 'bg-gray-100 text-gray-800 border-gray-200';
            }
        },
        
        getStatusText(status) {
            switch (status) {
                case 'active':
                    return 'Aktif';
                case 'expiring':
                    return 'Akan Berakhir';
                case 'expired':
                    return 'Berakhir';
                default:
                    return 'Unknown';
            }
        },
        
        getGradeColor(grade) {
            if (grade.startsWith('A')) return 'text-green-600';
            if (grade.startsWith('B')) return 'text-blue-600';
            if (grade.startsWith('C')) return 'text-yellow-600';
            return 'text-red-600';
        },
        
        getTypeIcon(type) {
            return type === 'professional' ? 
                'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z' :
                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253';
        },
        
        isNearExpiry(expiryDate) {
            const expiry = new Date(expiryDate);
            const today = new Date();
            const diffTime = expiry - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays <= 90 && diffDays > 0;
        },
        
        showNotification(message, type = 'info') {
            // Simple alert for now - can be enhanced with proper notification system
            alert(message);
        }
    }));
});
</script>
@endpush