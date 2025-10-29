@extends('layouts.app')

@section('title', 'Hubungi Kami - Jasa Tirta Learning Center')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    @include('pages.landing.contact._hero')

    {{-- Why Choose Us Section --}}
    @include('pages.landing.contact._why-choose-us')

    {{-- Main Contact Section (Form + Info) --}}
    @include('pages.landing.contact._contact-form')

    {{-- FAQ Section --}}
    @include('pages.landing.contact._faq')
</div>
@endsection
