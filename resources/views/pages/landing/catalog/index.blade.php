@extends('layouts.app')

@section('title', 'Katalog Pelatihan - Jasa Tirta Learning Center')

@section('content')
{{-- Hero Section --}}
@include('pages.landing.catalog._hero')

{{-- Search and Filter Section --}}
@include('pages.landing.catalog._filters')

{{-- Training Cards Grid Section --}}
@include('pages.landing.catalog._trainings')

{{-- Pagination Section --}}
@include('pages.landing.catalog._pagination')
@endsection
