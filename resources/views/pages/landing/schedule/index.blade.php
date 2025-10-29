@extends('layouts.app')

@section('title', 'Jadwal Pelatihan - Jasa Tirta Learning Center')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    @include('pages.landing.schedule._hero')

    {{-- Filters Section --}}
    @include('pages.landing.schedule._filters')

    {{-- Schedule Table Section --}}
    @include('pages.landing.schedule._table')

    {{-- Info Section --}}
    @include('pages.landing.schedule._info')
</div>
@endsection
