@extends('layouts.user')

@section('content')
<div class="space-y-6">
    {{-- Header Section --}}
    @include('pages.user.courses._header')

    {{-- Statistics Section --}}
    @include('pages.user.courses._statistics')

    {{-- Course List with Tabs Section --}}
    @include('pages.user.courses._list')
</div>
@endsection
