<div class="dashboard">
    <div class="card top-card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="stat">
                            <h2>{{ $datadetail['total_quotes'] }}</h2>
                            <h6>Total No Quotes</h6>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat">
                            <h2>{{ $datadetail['total_customers'] }}</h2>
                            <h6>Total Customers</h6>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat">
                            <h2>{{ $datadetail['total_products'] }}</h2>
                            <h6>Total Products</h6>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat border-0">
                            <h2>
                                @php
                                    $gross_total = 0;
                                @endphp
                                @foreach ($datadetail['all_quotes'] as $quote)
                                    @php
                                        $gross_total += $quote->deals->sum('total_gross');
                                    @endphp
                                @endforeach
                                £{{ $gross_total }}
                            </h2>
                            <h6>Gross Total</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-4">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h5>QUOTES</h5>
                    </div>
                    <div class="col-sm-8">
                        <h5 class="text-dark">{{ $datadetail['from']->format('d M Y') }} -
                            {{ $datadetail['to']->format('d M Y') }}</h5>
                    </div>
                </div>

                <div class="row chart-stats mt-5">
                    <div class="col-md-8 col-lg-9 order-md-1 order-2">
                        <div id="daily-data-chart"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 order-md-2 order-1">
                        @php
                            $quote_total = 0;
                            $total_items = 0;
                            $highest_quote = 0;
                        @endphp
                        @foreach ($datadetail['grouped_quotes'] as $quote)
                            @if ($quote->deals->sum('total_gross') > $highest_quote)
                                @php
                                    $highest_quote = $quote->deals->sum('total_gross');
                                @endphp
                            @endif
                            @php
                                $quote_total += $quote->deals->sum('total_gross');
                                $total_items++;
                            @endphp
                        @endforeach
                        @if ($total_items > 0)
                            @php
                                $average_quote = $quote_total / $total_items;
                            @endphp
                        @else
                            @php
                                $average_quote = 0;
                            @endphp
                        @endif

                        <div class="stat">
                            <h2>{{ $total_items }}</h2>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h5 class="heading">QUOTE DETAILS</h5>

                <div class="quote-details">
                    <table class="table nowrap no-footer w-100" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Phone Number</th>
                                <th>Postal Code</th>
                                <th>Added On</th>
                                <th>Quote Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($datadetail['all_quotes'])
                                @foreach ($datadetail['all_quotes'] as $key => $quote)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $quote->client->name }}</td>
                                        <td>{{ $quote->client->phone }}</td>
                                        <td>{{ $quote->client->postal_code }}</td>
                                        <td>{{ date('d-m-Y', strtotime($quote->created_at)) }}</td>
                                        <td>
                                            @php
                                                $quote_total = $quote->deals->sum('total_gross');
                                            @endphp
                                            {{ $quote_total }}
                                        </td>
                                        <td>
                                            <div>
                                                <a href="" data-toggle="tooltip" title="View Quote">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="" data-toggle="tooltip" title="Send & Download Quote">
                                                    <i class="fa fa-location-arrow"></i>
                                                </a>

                                                <a href="" data-toggle="tooltip" title="Duplicate Quote">
                                                    <i class="fa fa-copy"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
