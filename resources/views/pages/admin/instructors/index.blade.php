@extends('layouts.admin')

@section('title', 'Manajemen Instructor')

@section('content')
<div class="p-6 space-y-6" x-data="instructorsManager()">
    @include('pages.admin.instructors._header')
    
    @include('pages.admin.instructors._search-filter')
    
    @include('pages.admin.instructors._bulk-actions')
    
    @include('pages.admin.instructors._statistics')
    
    @include('pages.admin.instructors._table')
</div>

<script>
function instructorsManager() {
    return {
        // Search and filter states
        searchQuery: '',
        specializationFilter: 'all',
        experienceLevelFilter: 'all',
        statusFilter: 'all',
        
        // Selection states
        selectedInstructors: [],
        
        // Pagination
        currentPage: 1,
        itemsPerPage: 5,
        
        // Instructors data
        instructors: [
            {
                id: 1,
                name: 'Dr. Sarah Wijaya',
                email: 'sarah.wijaya@jtlc.com',
                phone: '+62 811-2233-4455',
                specialization: ['Water Quality Testing', 'Environmental Analysis', 'Laboratory Management'],
                experienceLevel: 'Expert',
                status: 'Active',
                yearsExperience: 12,
                coursesCount: 8,
                studentsCount: 245,
                rating: 4.9,
                joinDate: '2020-03-15',
                certifications: ['ISO 17025 Lead Auditor', 'Water Quality Specialist', 'Environmental Consultant'],
                education: 'PhD Environmental Chemistry - UI',
                bio: 'Experienced environmental scientist with expertise in water quality analysis.',
                hourlyRate: 750000
            },
            {
                id: 2,
                name: 'Muhammad Rizki, S.T.',
                email: 'rizki.muhammad@jtlc.com',
                phone: '+62 812-3344-5566',
                specialization: ['Sampling Techniques', 'Field Testing', 'Quality Control'],
                experienceLevel: 'Senior',
                status: 'Active',
                yearsExperience: 8,
                coursesCount: 6,
                studentsCount: 189,
                rating: 4.7,
                joinDate: '2021-07-20',
                certifications: ['Sampling Technician Level II', 'Quality Control Specialist'],
                education: 'S1 Teknik Lingkungan - ITB',
                bio: 'Field specialist with extensive experience in sampling and testing procedures.',
                hourlyRate: 500000
            },
            {
                id: 3,
                name: 'Dr. Lisa Chen',
                email: 'lisa.chen@jtlc.com',
                phone: '+62 813-4455-6677',
                specialization: ['Microbiology', 'Pathogen Detection', 'Food Safety'],
                experienceLevel: 'Expert',
                status: 'Active',
                yearsExperience: 15,
                coursesCount: 5,
                studentsCount: 156,
                rating: 4.8,
                joinDate: '2019-11-10',
                certifications: ['Microbiologist Certified', 'Food Safety Auditor', 'HACCP Lead Auditor'],
                education: 'PhD Microbiology - NTU Singapore',
                bio: 'Microbiology expert specializing in pathogen detection and food safety.',
                hourlyRate: 850000
            },
            {
                id: 4,
                name: 'Ahmad Fadli, M.Sc.',
                email: 'ahmad.fadli@jtlc.com',
                phone: '+62 814-5566-7788',
                specialization: ['Chemical Analysis', 'Instrumentation', 'Method Development'],
                experienceLevel: 'Senior',
                status: 'On Leave',
                yearsExperience: 10,
                coursesCount: 7,
                studentsCount: 198,
                rating: 4.6,
                joinDate: '2020-09-05',
                certifications: ['Analytical Chemist', 'Instrument Specialist'],
                education: 'M.Sc Chemistry - UGM',
                bio: 'Analytical chemistry specialist with focus on method development.',
                hourlyRate: 600000
            },
            {
                id: 5,
                name: 'Maya Sari, S.Si.',
                email: 'maya.sari@jtlc.com',
                phone: '+62 815-6677-8899',
                specialization: ['Training Development', 'Adult Education', 'Curriculum Design'],
                experienceLevel: 'Junior',
                status: 'Active',
                yearsExperience: 3,
                coursesCount: 4,
                studentsCount: 87,
                rating: 4.4,
                joinDate: '2023-02-14',
                certifications: ['Certified Trainer', 'Adult Education Specialist'],
                education: 'S1 Pendidikan Kimia - UNJ',
                bio: 'Education specialist focused on training development and curriculum design.',
                hourlyRate: 350000
            }
        ],
        
        // Computed properties
        get filteredInstructors() {
            return this.instructors.filter(instructor => {
                const matchesSearch = 
                    instructor.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    instructor.email.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    instructor.specialization.some(spec => spec.toLowerCase().includes(this.searchQuery.toLowerCase()));
                
                const matchesSpecialization = this.specializationFilter === 'all' || 
                    instructor.specialization.some(spec => spec.toLowerCase().includes(this.specializationFilter.toLowerCase()));
                
                const matchesExperienceLevel = this.experienceLevelFilter === 'all' || 
                    instructor.experienceLevel === this.experienceLevelFilter;
                
                const matchesStatus = this.statusFilter === 'all' || instructor.status === this.statusFilter;

                return matchesSearch && matchesSpecialization && matchesExperienceLevel && matchesStatus;
            });
        },
        
        get paginatedInstructors() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredInstructors.slice(startIndex, startIndex + this.itemsPerPage);
        },
        
        get totalPages() {
            return Math.ceil(this.filteredInstructors.length / this.itemsPerPage);
        },
        
        get stats() {
            const total = this.instructors.length;
            const active = this.instructors.filter(i => i.status === 'Active').length;
            const expert = this.instructors.filter(i => i.experienceLevel === 'Expert' || i.experienceLevel === 'Master').length;
            const averageRating = this.instructors.reduce((sum, i) => sum + i.rating, 0) / total;
            
            return {
                total,
                active,
                expert,
                averageRating: averageRating.toFixed(1)
            };
        },
        
        get showBulkActions() {
            return this.selectedInstructors.length > 0;
        },
        
        get allSelected() {
            return this.paginatedInstructors.length > 0 && 
                   this.selectedInstructors.length === this.paginatedInstructors.length;
        },
        
        // Helper functions
        getInitials(name) {
            return name.split(' ').map(n => n[0]).join('');
        },
        
        formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        },
        
        // Selection handlers
        toggleSelectAll() {
            if (this.allSelected) {
                this.selectedInstructors = [];
            } else {
                this.selectedInstructors = this.paginatedInstructors.map(i => i.id);
            }
        },
        
        toggleSelectInstructor(instructorId) {
            const index = this.selectedInstructors.indexOf(instructorId);
            if (index > -1) {
                this.selectedInstructors.splice(index, 1);
            } else {
                this.selectedInstructors.push(instructorId);
            }
        },
        
        isSelected(instructorId) {
            return this.selectedInstructors.includes(instructorId);
        },
        
        // Bulk actions
        bulkDelete() {
            if (confirm(`Apakah Anda yakin ingin menghapus ${this.selectedInstructors.length} instructor?`)) {
                this.instructors = this.instructors.filter(i => !this.selectedInstructors.includes(i.id));
                this.selectedInstructors = [];
            }
        },
        
        bulkStatusChange(newStatus) {
            this.instructors = this.instructors.map(instructor => 
                this.selectedInstructors.includes(instructor.id) 
                    ? { ...instructor, status: newStatus }
                    : instructor
            );
            this.selectedInstructors = [];
        },
        
        // CRUD actions
        deleteInstructor(instructorId) {
            if (confirm('Apakah Anda yakin ingin menghapus instructor ini?')) {
                this.instructors = this.instructors.filter(i => i.id !== instructorId);
            }
        },
        
        // Pagination
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        
        // Watchers
        init() {
            this.$watch('searchQuery', () => this.currentPage = 1);
            this.$watch('specializationFilter', () => this.currentPage = 1);
            this.$watch('experienceLevelFilter', () => this.currentPage = 1);
            this.$watch('statusFilter', () => this.currentPage = 1);
        }
    }
}
</script>
@endsection
