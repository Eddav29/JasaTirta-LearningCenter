@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    @include('pages.admin.dashboard._header')
    @include('pages.admin.dashboard._stats')
    @include('pages.admin.dashboard._activities-and-popular')
    @include('pages.admin.dashboard._upcoming-schedules')
@endsection
