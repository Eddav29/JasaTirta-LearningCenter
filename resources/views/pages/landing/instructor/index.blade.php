@extends('layouts.app')

@section('title', 'Tim Pengajar - Jasa Tirta Learning Center')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    @include('pages.landing.instructor._hero')

    {{-- Tabs & Instructors Section --}}
    @include('pages.landing.instructor._instructors')

    {{-- CTA Section --}}
    @include('pages.landing.instructor._cta')
</div>
@endsection
