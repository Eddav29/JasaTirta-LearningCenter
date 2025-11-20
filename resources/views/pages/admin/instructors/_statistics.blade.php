{{-- Statistics Cards --}}
@php
    $statsConfig = [
        ['key' => 'total', 'title' => 'Total Instructor', 'bgColor' => 'bg-blue-100', 'iconColor' => 'text-blue-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9-5m9 5l9-5M12 20l-9-5m9 5l9-5"/>'],
        ['key' => 'internal', 'title' => 'Internal', 'bgColor' => 'bg-green-100', 'iconColor' => 'text-green-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'],
        ['key' => 'vendor', 'title' => 'Vendor', 'bgColor' => 'bg-purple-100', 'iconColor' => 'text-purple-600', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>'],
        ['key' => 'totalTrainings', 'title' => 'Total Pelatihan', 'bgColor' => 'bg-yellow-100', 'iconColor' => 'text-yellow-600', 'icon' => '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>'],
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($statsConfig as $stat)
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="{{ $stat['bgColor'] }} p-3 rounded-full">
                    <svg class="w-6 h-6 {{ $stat['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $stat['icon'] !!}
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                    <p class="text-2xl font-bold text-gray-900">
                        @switch($stat['key'])
                            @case('total')
                                {{ number_format($stats['total']) }}
                                @break
                            @case('internal')
                                {{ number_format($stats['internal']) }}
                                @break
                            @case('vendor')
                                {{ number_format($stats['vendor']) }}
                                @break
                            @case('totalTrainings')
                                {{ number_format($stats['totalTrainings']) }}
                                @break
                        @endswitch
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

