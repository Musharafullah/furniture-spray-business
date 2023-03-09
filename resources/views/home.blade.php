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
    {{-- update profile --}}
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            Highcharts.chart('daily-data-chart', {
                chart: {
                    type: 'column',
                },
                title: false,
                xAxis: {
                    type: 'category',
                    labels: {
                        staggerLines: 2,
                        rotation: -45,
                        style: {
                            fontSize: '11px',
                            fontFamily: 'Poppins-Regular, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: false
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Quote in day: <b>{point.y:.1f}</b>'
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Population',
                    data: [
                        @if (isset($data['grouped']))
                            @foreach ($data['grouped'] as $key => $group)
                                @if ($loop->last)
                                    ['{{ $key }}', {{ $group->count() }}]
                                @else
                                    ['{{ $key }}', {{ $group->count() }}],
                                @endif
                            @endforeach
                        @endif
                    ]
                }]
            });
        });
    </script>
@endsection
