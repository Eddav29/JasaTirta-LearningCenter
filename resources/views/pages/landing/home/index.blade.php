@extends('layouts.app')

@section('title', 'Jasa Tirta Learning Center - Pelatihan Sampling Air Profesional')

@section('content')
<div class="min-h-screen">
    {{-- Hero Section --}}
    @include('pages.landing.home._hero')

    {{-- Statistics Section --}}
    @include('pages.landing.home._statistics')

    {{-- Problem & Solution Section --}}
    @include('pages.landing.home._problem-solution')

    {{-- Why Choose Us Section --}}
    @include('pages.landing.home._features')

    {{-- Training Process Section --}}
    @include('pages.landing.home._training-process')

    {{-- Popular Trainings Section --}}
    @include('pages.landing.home._popular-trainings')

    {{-- FAQ Section --}}
    @include('pages.landing.home._faq')

    {{-- Partners Section --}}
    @include('pages.landing.home._partners')

    {{-- Final CTA Section --}}
    @include('pages.landing.home._cta')
</div>
@endsection
