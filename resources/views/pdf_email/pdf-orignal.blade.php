{{--{{ dd($title->client->name) }}--}}
{{--{{ dd($title) }}--}}
        <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Page Title</title>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: black;
            text-align: center;
        }
        .bottom-btn {
            position: fixed;
            left: 0;
            bottom: 30;
            width: 50%;
            color: black;
            text-align: center;
        }
        .bottom {
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
<span class="pull-right">Quote:MCG-0000{{ $quotes->id }}<br/>
    {{'Date: ' .\Illuminate\Support\Carbon::now()->format('d-m-Y') }} </span>
<img src="{{ asset('assets/images/glass-uk-logo.png') }}" class="img-responsive" alt="Glass UK" width="200px"
     height="200px"/><br/>
<span>Glass Splashbacks UK,<br/> 86-90 Paul Street, <br/>London<br/> </span>
<hr />
<h2> <b>{{ $quotes->client->name }}</b></h2>
<h5>
    @if(!empty($quotes->client->address) )
        {{ $quotes->client->address }}
    @else
        {{ $quotes->client->postal_code }}
    @endif
</h5>

<h2 align="center"><b>Quote</b></h2>
@php
    $discount = $quotes->deals->sum('trade_discount');
@endphp

<table class="table table-bordered">
    <thead>
    <tr>
        <td><b>Item </b></td>
        <td>Code</td>
        @if($discount > 0)
            <td>Product</td>
        @else
            <td colspan="2">Product</td>
        @endif
        <td>Width(mm)</td>
        <td>Height(mm)</td>
        <td>SQM(m)</td>
        <td>Quantity</td>
        @if($discount > 0)
            <td>Discount (%)</td>
        @else
        @endif
        <td>Net Price</td>
    </tr>
    @foreach($quotes->deals as $quote)
        <tr>
            <td >{{$loop->iteration }}</td>
            <td><h6>{{ $quote->product->code }}</h6></td>
            @if($discount > 0)
                <td><h6>{{ $quote->product->product_name }}</h6></td>
            @else
                <td colspan="2"><h6>{{ $quote->product->product_name }}</h6></td>
            @endif
            <td>@if($quote->product->type == 'non_glass')
                    0
                @else
                    <h6>{{ $quote->width }}</h6>
                @endif
            </td>
            <td>
                @if($quote->product->type == 'non_glass')
                    0
                @else
                    <h6>{{ $quote->height }}</h6>
                @endif
            </td>
            <td>
                @if($quote->product->type == 'non_glass')
                    0
                @else
                    <h6>{{ $quote->sqm }}</h6>
                @endif
            </td>
            <td><h6>{{ $quote->quantity }}</h6></td>
            @if($discount > 0)
                <td><h6>{{ $quote->trade_discount }}</h6></td>
            @else
            @endif
            <td><h6>{{ $quote->net_price }}</h6></td>
        <tr>
            <td></td>
            <td colspan="7"><h6>
                    @if($quote->cutout > 0 )
                        @php
                            $coutout = $quote->cutout /25;
                        @endphp
                        Cut Out X {{$coutout}},
                    @endif
                    @if($quote->notch > 0 )
                        @php
                            $notch = $quote->notch /20;
                        @endphp
                        Notch X {{$notch}} ,
                    @endif
                    @if($quote->hole > 0 )
                        @php
                            $hole = $quote->hole /5;
                        @endphp
                        Hole X {{$hole}} ,
                    @endif
                    @if($quote->back_select == 85)

                        Painted
                    @endif
                    @if($quote->back_select == 150)
                        Printed
                    @endif
                    @if($quote->cnc == 75 )
                        , CNC: Yes
                    @endif
                    @if($quote->sandblasted == 45 )
                        , Sandblasted: Yes
                    @endif
                    @if($quote->ritec == 25 )
                        , Ritec: Yes
                    @endif
                </h6>
            <td>
        </tr>
        </tr>
    @endforeach
    <tr>
        @php
            $gross_total = round($quotes->deals->sum('total_gross'), 2);
            $delivery_charges = $quotes->delivery_charges;
            $grand_total = $gross_total + $delivery_charges;
            $sqm = $quotes->deals->sum('sqm');
            $distance = $quotes->delivery_distance;
        @endphp
        <td colspan="5">
            <b>Comment :</b>{{ $quotes->comment }}
        </td>
        <td colspan="3"><h5>Total Net <br />
                Total Vat <br/>
                <b>Gross Total</b> <br/>
                Grand Total (Collected) <br />
                Grand Total (Delivered) <br />
                Grand Total (Survey & Fit)

            </h5></td>
        <td><h5 class="text-right">£{{ round($quotes->deals->sum('net_price'), 2) }}<br />
                £{{ round($quotes->deals->sum('vat'), 2) }}<br />
                <b>£{{ $gross_total }}</b><br />
                <!--collection calculation -->
                £{{ $quotes->collected }} <br />

                <!--delivery calculation -->
                @if($quotes->delivered == 'N/A')
                    N/A <br />
                @else
                    £{{ $quotes->delivered }} <br />
                @endif
            <!--survey calculation-->
                @if($quotes->survey == 'N/A')
                    N/A
                @else
                    £{{ $quotes->survey + $gross_total}}
                @endif
            </h5>
        </td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<!-- Footer -->
<footer class="page-footer font-small blue footer bottom">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        ALL GOODS SUPPLIED REMAIN PROPERTY OF GSUK UNTIL PAID FOR IN FULL.<br>
        ALL ORDERS ARE ACCEPTED STRICTLY ON GSUK’S TERMS AND CONDITIONS.
<br />
        <span>GlassSplashbacksUK | Registered address: 86-90 Paul Street, EC2A 4NE, London | 020 3086 9434 | sales@glasssplashbacksuk.com</span>

    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>