{{-- Instructors Section with Tabs --}}
<section class="py-12" x-data="{ activeTab: 'internal' }">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Tabs Navigation --}}
        <div class="flex justify-center mb-8">
            <div class="inline-flex bg-white rounded-lg shadow p-1">
                <button 
                    @click="activeTab = 'internal'"
                    :class="activeTab === 'internal' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                    class="px-6 py-2 rounded-lg font-medium transition"
                >
                    Pengajar Internal
                </button>
                <button 
                    @click="activeTab = 'vendor'"
                    :class="activeTab === 'vendor' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100'"
                    class="px-6 py-2 rounded-lg font-medium transition"
                >
                    Pengajar Vendor
                </button>
            </div>
        </div>

        {{-- Internal Instructors Tab --}}
        <div x-show="activeTab === 'internal'" class="space-y-8">
            <div class="text-center space-y-4">
                <h2 class="text-2xl font-bold text-gray-900">Tim Pengajar Internal</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Staf pengajar tetap Jasa Tirta Learning Center yang berpengalaman langsung dalam implementasi 
                    standar kualitas air di berbagai industri dan instansi pemerintah.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($internalInstructors as $instructor)
                    @include('pages.landing.instructor._instructor-card', ['instructor' => $instructor, 'isVendor' => false])
                @endforeach
            </div>
        </div>

        {{-- Vendor Instructors Tab --}}
        <div x-show="activeTab === 'vendor'" class="space-y-8" style="display: none;">
            <div class="text-center space-y-4">
                <h2 class="text-2xl font-bold text-gray-900">Pengajar Vendor & Mitra</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Pakar eksternal dari berbagai institusi dan perusahaan terkemuka yang berkontribusi 
                    memberikan perspektif industri dan perkembangan teknologi terkini.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($vendorInstructors as $instructor)
                    @include('pages.landing.instructor._instructor-card', ['instructor' => $instructor, 'isVendor' => true])
                @endforeach
            </div>
        </div>
    </div>
</section>
