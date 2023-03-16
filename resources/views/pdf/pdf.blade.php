<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Quote</title>

    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #fff;
            font-size: 14px;
            height: 100%;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 50px;
            border-bottom: 1px solid #ccc;
        }

        .left-element,
        .right-element {
            display: inline-block;
        }

        .right-element {
            float: right;
        }

        .table {
            width: 100%;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            border-spacing: 0 !important;
        }

        .table tr td {
            padding: 12px;
            vertical-align: text-top;
        }

        tbody tr td {
            border-top: 1px solid #ccc;
        }

        tfoot tr td {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        ol {
            list-style-position: inside;
            padding: 0;
        }

        ol li {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .points {
            margin-left: 10px;
            margin-top: 5px;
            line-height: 1.6;
        }

        .footer {
            border-top: 1px solid #ccc;
            width: 100%;
            color: black;
            text-align: center;
            font-size: 11.5px;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .footer-copyright {
            font-size: 11.5px;
            padding-top: 15px;
        }

        .btn-info {
            border-radius: 4px;
            color: #fff;
            background-color: #5bc0de;
            border: 1px solid #5bc0de;
            font-size: 14px;
            padding: 10px;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <main>
        <div class="header">
            <div class="left-element">
                <img src="assets/images/logo.jpg" alt="MCG UK" width="150px" height="60px" />
            </div>
            <div class="right-element">
                <span>
                    Quote: ROKA-00000{{ $quotes->id }}<br />
                    {{'Date: ' .\Illuminate\Support\Carbon::now()->format('d-m-Y') }}<br />
                    Created By: {{ $quotes->user->name }}
                </span>
            </div>
        </div>

        <div class="quote">
            <h4><b>{{ $quotes->client->name }}</b></h4>
            <span>
                {{ $quotes->client->address }} <br>
                {{ $quotes->client->postal_code }}<br />
                {{ $quotes->client->email }}
            </span>
            <h2 align="center"><b>Quote</b></h2>

            @php
                $discount = $quotes->deals->sum('trade_discount');
            @endphp

            <table class="table">
                <thead>
                    <tr>
                        <td><b>Item </b></td>
                        @if ($discount > 0 && $quotes->net_price_status == 1)
                            <td>Product</td>
                        @elseif($discount > 0 || $quotes->net_price_status == 1)
                            <td colspan="2">Product</td>
                        @else
                            <td colspan="3">Product</td>
                        @endif
                        <td>Width(mm)</td>
                        <td>Height(mm)</td>
                        <td>SQM</td>
                        <td>Qty</td>
                        @if ($discount > 0)
                            <td>
                                @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                                    Trade Discount
                                @endif
                            </td>
                        @endif
                        @if ($quotes->net_price_status == 1)
                            <td>
                                @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                                    Net Price
                                @endif
                            </td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $vat = 0;
                        $net_price = 0;
                        $gross_total = 0;
                    @endphp
                    @foreach ($quotes->deals as $quote)
                        <tr>
                            @php
                                $vat += $quote->vat;
                                $net_price += $quote->net_price;
                                $gross_total += $quote->total_gross;
                            @endphp
                            <td>{{ $loop->iteration }}</td>

                            @if ($discount > 0 && $quotes->net_price_status == 1)
                                <td>{{ $quote->product->product_name }}</td>
                            @elseif($discount > 0 || $quotes->net_price_status == 1)
                                <td colspan="2">{{ $quote->product->product_name }}</td>
                            @else
                                <td colspan="3">{{ $quote->product->product_name }}</td>
                            @endif

                            <td>{{ $quote->width }}</td>
                            <td>{{ $quote->height }}</td>
                            <td>{{ $quote->sqm }}</td>
                            <td>{{ $quote->quantity }}</td>
                            @if ($discount > 0)
                                <td>
                                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                                        {{ $quote->trade_discount }}
                                    @endif
                                </td>
                            @endif
                            @if ($quotes->net_price_status == 1)
                                <td>
                                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                                        {{ number_format($quote->net_price, 2) }}
                                    @endif
                                </td>
                            @endif
                        </tr>

                        <tr>
                            <td style="border: 0px;"></td>
                            <td colspan="8" style="border: 0px;">
                                @if($quote->product->type == 'basic' || $quote->product->type == 'standard')
                                @elseif ($quote->matt_finish_option == 1)
                                    Single Side |
                                @elseif($quote->matt_finish_option == 2)
                                    Double Side |
                                @endif
                                @if ($quote->spraying_edges > 0)
                                    Sprayed Edges |
                                @endif
                                @if ($quote->metallic_paint > 0)
                                    Metallic |
                                @endif
                                @if ($quote->gloss_percentage_option == 1)
                                    80% Gloss |
                                @elseif($quote->gloss_percentage_option == 2)
                                    100% Gloss |
                                @elseif($quote->gloss_percentage_option == 3)
                                    100% Gloss Acrylic Lacquer |
                                @endif
                                @if ($quote->wood_stain > 0)
                                    Wood stain |
                                @endif
                                @if ($quote->gloss_100_acrylic_lacquer > 0)
                                    100% Gloss / Wet Look Clear Acrylic Lacquer |
                                @endif
                                @if ($quote->polyester > 0)
                                    Polyester / Full Grain |
                                @endif
                                @if ($quote->burnished_finish > 0)
                                    Burnished Finish |
                                @endif
                                @if ($quote->barrier_coat > 0)
                                    Barrier Coat |
                                @endif
                                @if ($quote->edgebanding > 0)
                                    Edge banding |
                                @endif
                                @if ($quote->micro_bevel > 0)
                                    Micro bevel |
                                @endif
                                @if ($quote->routed_handle_spraying > 0)
                                    Routed / J Handle |
                                @endif
                                @if ($quote->beaded_door > 0)
                                    Beaded Door |
                                @endif
                            </td>
                        </tr>
                        @if( $quote->note )
                            <tr>
                                <td style="border: 0px;"></td>
                                <td colspan="8" style="border: 0px;"><b>Note:</b> {{ $quote->note }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <b>Comment : {{ $quotes->comment }}</b>
                        </td>
                        <td colspan="3">
                            <span>
                                @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                                    @if ($quotes->total_net_status == 1)
                                        <nobr>Total Net</nobr><br>
                                    @endif
                                    @if ($quotes->total_vat_status == 1)
                                        <nobr>Total Vat</nobr><br>
                                    @endif
                                    @if ($quotes->gross_total_status == 1)
                                        <nobr><b>Gross Total</b></nobr><br>
                                    @endif
                                @endif

                                @if ($quotes->hide_collect == 1)
                                    <br>
                                    Grand Total (Collected)<br />
                                @endif
                                @if ($quotes->hide_delivered == 1)
                                    Grand Total (Delivered)<br />
                                @endif
                            </span>
                        </td>
                        <td>
                            <span>
                                @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                                    @if ($quotes->total_net_status == 1)
                                        £{{ number_format($net_price, 2) }}<br>
                                    @endif
                                    @if ($quotes->total_vat_status == 1)
                                        £{{ number_format($vat, 2) }}<br>
                                    @endif
                                    @if ($quotes->gross_total_status == 1)
                                        <b>£{{ number_format($gross_total, 2) }}</b><br>
                                    @endif
                                @endif

                                @if ($quotes->hide_collect == 1)
                                    <br>£{{ number_format($gross_total, 2) }}<br />
                                @endif
                                @if ($quotes->hide_delivered == 1)
                                    £{{ number_format($quotes->delivered + $gross_total, 2) }}<br />
                                @endif
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="terms-and-conditions">
            <h4 align="center"><strong>STANDARD TERMS & CONDITIONS OF QUOTATION</strong></h4>
            <ol>
                <li><strong>All prices are inclusive of VAT at the applicable rate.</strong></li>
                <li>All quotations are valid for 30 days from date of issue.</li>
                <li>
                    Full payment on pro forma invoice is normally required on order, however, we do provide 30 day
                    monthly terms which is
                    subject to approval of a submitted account application, unless otherwise stated.
                </li>
                <li>
                    All glass will be loose loaded and tail board with delivery during normal working hours, Monday to
                    Friday 8am- 5pm,
                    excluding weekends and public holidays unless otherwise stated.
                </li>
                <li>
                    Any templates will be free issue to ourselves and must be full size rigid hardboard and clearly
                    marked (paper is not acceptable
                    as templates). We retain templates for a period of 14 days before disposal or return and all
                    manufacturing from templates will be
                    within manufacturer tolerances.
                </li>
                <li>
                    We subscribe to and adhere to that all our glass products are sold subject to GGF visual quality
                    standards and standard glass
                    manufacturing and processing tolerances.
                </li>
                <li>
                    Due to the nature and scope of matching decorated colour products such as paint, films, fabric and
                    some glass materials etc
                    we cannot be held responsible for not providing an exact colour match even if samples have been
                    provided. Unless otherwise stated all our quotations
                    are based on standard float glass. On closer inspection slight blemishes, imperfections and surface
                    scratches can appear due to the processing, heating,
                    cooling of toughened glass. This is unavoidable but also minimal. Imperfections that are not clearly
                    visible in a 500mm square at a distance of 3mtrs
                    and in a natural light environment with all downlighters switched off are deemed acceptable.
                </li>
                <li>
                    We provide lead times and delivery/collection dates in good faith and are based on all the relevant
                    information we have at the
                    time. In most cases of technical and specialist works these can vary greatly and we will keep you
                    informed of the progress of
                    your works but cannot be held responsible for delays outside our control and will not accept or
                    agree to any contra charging or
                    provide any other compensation for your subsequent losses, unless otherwise stated. Any delivery
                    date is otherwise, purely
                    indicative. Printed glass and toughened mirrors can take up to 3 weeks to be manufacured.
                </li>
                <li>
                    We do not accept withholding of payments for any reason including retention payments, discounts and
                    any kind of
                    performance bond etc, unless otherwise stated. All our products are subject to a full 12 month
                    manufacturer defect warranty.
                </li>
                <li>
                    We value quality and customer service, therefore, in the event that you are unhappy with any of our
                    products due to defects
                    we will gladly replace the item, provided, you inform us in writing no later than 24h from delivery
                    date and the faulty product
                    can be returned to our works for inspection as soon as possible, otherwise, any remake will be
                    chargeable.
                </li>
                <li>
                    We can provide some samples free of charge, however, other samples may be chargeable. Visit our
                    website for more details.
                </li>
                <li>
                    We reserve the right to amend any price if final sizes and/or quantities differ from quotation.
                </li>
                <li>
                    Technical Limitations;<br>
                    <div class="points">
                        1) Minimum area charge for float annealed 0.25m2, Low Iron 0.25m2, Toughened and IGU glass is
                        0.30m2.<br>
                        2) Minimum glass size for toughening is 275mm x 100mm.<br>
                        3) Maximum glass size for toughening is 3600mm x 2000mm.<br>
                        4) Minimum area charge for toughened laminated is 0.3m2.<br>
                        5) All circles are priced on application.<br>
                        6) Holes and or cut outs on toughened glass must be within manufacturing tolerances and we
                        reserve the right to refuse any
                        order that does not comply with our specifications. All internal cut outs will have a radius
                        minimum of the thickness of the glass.<br>
                    </div>
                </li>
            </ol>

        </div>

        <!--<button class="btn-info">Send Quote</button>-->
         <a href="{{ url('view-send-pdf', $quotes->id) }}" data-toggle="tooltip"
                                            title="Send & Download Quote" class="btn-info">Send Quote</a>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-copyright">
            ALL GOODS SUPPLIED REMAIN PROPERTY OF ROKA SPRAYING UNTIL PAID FOR IN FULL.<br>  
            ALL ORDERS ARE ACCEPTED STRICTLY ON ROKA TERMS AND CONDITIONS.<br>  
            <span>Roka Spraying | 020 3004 4824| info@furniturepaintspraying.co.uk</span>
        </div>
    </footer>
    <!-- Footer -->

</body>

</html>
