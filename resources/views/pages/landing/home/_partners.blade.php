{{-- Partners Section --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-12">
            <div class="inline-block border border-blue-600/30 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                Mitra Terpercaya
            </div>
            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900">
                Telah Berpartner dengan Perusahaan Terkemuka
            </h3>
            <p class="text-gray-600">Kepercayaan dari berbagai sektor industri di Indonesia</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-8 opacity-70 hover:opacity-100 transition-opacity">
            @php
            $partners = ['PT Jasa Marga', 'Kementerian LHK', 'Pertamina', 'PLN', 'BUMN Lainnya'];
            @endphp

            @foreach($partners as $partner)
            <div class="bg-white/80 backdrop-blur-sm rounded-xl px-6 py-3 text-sm font-semibold shadow-lg hover:shadow-xl transition-all duration-300 border border-blue-600/10 hover:border-blue-600/30">
                {{ $partner }}
            </div>
            @endforeach
        </div>
    </div>
</section>
