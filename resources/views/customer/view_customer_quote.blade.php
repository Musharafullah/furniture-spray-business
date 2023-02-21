@extends('dashboardlayouts.master')
@section('title')
    <title>Customer quote</title>
@endsection

@section('content')
    <div class="customer py-5">
        <div class="container">
            <table class="table table-bordered nowrap no-footer w-100" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Phone Number</th>
                        <th>Postal Code</th>
                        <th>Added On</th>
                        <th>Total Quote</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($quotes)
                        @foreach ($quotes as $quote)
                            <tr>
                                <td>MCG-0000{{ $quote->id }}</td>
                                <td>{{ $quote->user->name }}</td>
                                <td>{{ $quote->user->phone }}</td>
                                <td>{{ $quote->user->postal_code }}</td>
                                <td>{{ date('d-m-Y', strtotime($quote->created_at)) }}</td>
                                <td>
                                    @php
                                        $quote_total = $quote->deals->sum('total_gross');
                                    @endphp
                                    {{ $quote_total }}
                                </td>
                                <td>
                                    <div>
                                        <a href="" data-toggle="tooltip" title="View Quote"><i class="fa fa-eye"></i></a>
                                        <a href="" data-toggle="tooltip" title="Send & Download Quote"><i
                                                class="fa fa-location-arrow"></i></a>
                                        <a href="" data-toggle="tooltip" title="Duplicate Quote"><i
                                                class="fa fa-copy"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
