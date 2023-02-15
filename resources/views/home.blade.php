@extends('dashboardlayouts.master')

@php
    if ($slug == null) {
        $title = 'dashboard';
    } else {
        $title = $slug;
    }
    
@endphp
@section('title')
    <title>{{ $title }}</title>
@endsection

@section('content')
    @php
        if ($slug == null) {
            $comp = 'pages.' . 'dashboard';
        } else {
            $comp = 'pages.' . $slug;
        }
        
    @endphp
    <x-dynamic-component :component="$comp" :datadetail="$data" />
@endsection
