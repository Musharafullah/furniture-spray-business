@extends('dashboardlayouts.master')
@section('title')
    <title>Reports</title>
@endsection
@section('content')
    <div class="report py-5">
        <div class="container">
            <form action="{{ route('reports') }}" method="get">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_date">From Date</label>
                                    <input id="from_date" name="from_date" class="form-control" type="date">
                                    @if ($errors->has('from_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('from_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0 mt-lg-0">
                                <div class="form-group">
                                    <label for="to_date">To Date</label>
                                    <input id="to_date" name="to_date" class="form-control" type="date"><br />
                                    @if ($errors->has('to_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('to_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary-rounded" type="submit">Generate Report
                            <span><i class="fa fa-save"></i></span>
                        </button>
                    </div>
                </div>
            </form>


            @if(isset($quotes))
                <div class="card my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5>QUOTES</h5>
                            </div>
                            <div class="col-sm-8">
                                <h5 class="text-dark">{{ $from->format('d M Y') }} - {{ $to->format('d M Y') }}</h5>
                            </div>
                        </div>

                        <div class="row chart-stats mt-5">
                            <div class="col-md-8 col-lg-9 order-md-1 order-2">
                                <div id="daily-data-chart"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-3 order-md-2 order-1">
                                @php
                                    $highest_quote = 0;
                                    $quote_total = 0;
                                    $total_items = 0;
                                @endphp
                                @foreach($quotes as $quote)
                                    @if($quote->deals->sum('total_gross') > $highest_quote)
                                        @php
                                            $highest_quote = $quote->deals->sum('total_gross');
                                        @endphp
                                    @endif
                                    @php
                                        $quote_total += $quote->deals->sum('total_gross');
                                        $total_items++;
                                    @endphp
                                @endforeach
                                @if ($total_items > 0 )
                                    @php
                                        $average_quote = $quote_total/$total_items;
                                    @endphp
                                @else
                                    @php
                                        $average_quote = 0;
                                    @endphp
                                @endif
                                <div class="stat">
                                    <h2>{{ $total_quotes }}</h2>
                                    <h6>Total Quotes</h6>
                                </div>
                                <div class="stat">
                                    <h2>£{{ $highest_quote }}</h2>
                                    <h6>Highest Quote</h6>
                                </div>
                                <div class="stat">
                                    <h2>£{{ $average_quote }}</h2>
                                    <h6>Average Quote</h6>
                                </div>
                                <div class="stat">
                                    <h2>{{ $paid_quotes }}</h2>
                                    <h6>Paid Quote</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered nowrap no-footer w-100" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Phone Number</th>
                            <th>Postal Code</th>
                            <th>Added On</th>
                            <th>Quote Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $quote)
                            <tr>
                                <td>{{ $quote->id }}</td>
                                <td>{{ $quote->client->name }}</td>
                                <td>{{ $quote->client->phone }}</td>
                                <td>{{ $quote->client->postal_code }}</td>
                                <td>{{ date('d-m-Y', strtotime($quote->created_at)) }}</td>
                                <td>
                                    @php
                                        $quote_total = $quote->deals->sum('total_gross')
                                    @endphp
                                    {{ $quote_total }}
                                </td>
                                <td>{{ $quote->status }}</td>
                                <td>
                                    <div>
                                        <a href="" data-toggle="tooltip" title="View Quote">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
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
                        @if(isset($grouped))    
                            @foreach($grouped as $key => $group)
                                @if($loop->last)
                                    ['{{ $key }}', {{ $group->count() }}]
                                @else
                                    ['{{ $key }}', {{ $group->count() }}],
                                @endif
                            @endforeach
                        @endif
                    ]
                }]
            });
        } );
    </script>
@endsection