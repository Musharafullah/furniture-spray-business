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
        body{
            font-family: "Verdana";
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 20px;
            width: 100%;
            color: black;
            text-align: center;
        }
        .bottom-btn {
            position: relative;
            bottom: 60px;

        }
        .name {
            position: fixed;
            bottom: 60px;

        }

        .bottom {
            border-top: 1px solid #ccc;
        }
          .small-btn {
            width: 35px;
            height: 13px;
            padding-top: -3px;
        }
        .book_survey {
            width: 62px;
            height: 13px;
            padding-top: -3px;
        }
    body,td,th {
	font-family: Verdana;
}
    </style>
</head>
<body>
<p><span class="pull-right">Quote:MCG-0000{{ $quotes->id }}<br/>
  {{'Date: ' .\Illuminate\Support\Carbon::now()->format('d-m-Y') }}<br />
  Created By: {{ $quotes->admin->name }}
  </span>
  <img src="{{ asset('assets/images/glass-uk-logo.png') }}" class="img-responsive" alt="MCG" width="200px"
     height="200px"/><br/>
     <br><br>
 </span>

<hr />
<h4> <b>{{ $quotes->client->name }}</b></h4>
<span>
    {{ $quotes->client->address }}<br />
    {{ $quotes->client->postal_code }}<br />
    {{ $quotes->client->email }}
</span>
<h2 align="center"><b>Quote</b> </h2>
@php
    $discount = $quotes->deals->sum('trade_discount');
@endphp

<table class="table" style="font-family: 'Verdana';">
    <thead>
    <tr>
        <td><b>Item </b></td>
        {{--<td>Code</td>--}}
        @if($discount > 0)
            <td width="120" colspan="2">Product</td>
        @else
            <td colspan="3" width="120">Product</td>
        @endif
        <td>Width(mm)</td>
        <td>Height(mm)</td>
        <td>SQM</td>
        <td>Qty</td>
        @if($discount > 0)
            <td>
               @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                Price
                @endif
            </td>
            <td>
               @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                Discount (%)
                @endif

            </td>
        @else
        @endif

        @if($discount > 0)
        <td>
             @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                    Amount Net
                @endif

        </td>
            @else
            <td colspan="2">
                @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                Net Price
                @endif
            </td>
            @endif
    </tr>
    @foreach($quotes->deals as $quote)
       <tr>
            <td >{{$loop->iteration }}</td>
            {{--<td>{{ $quote->product->code }}</td>--}}
            @if($discount > 0)
                <td width="120" colspan="2">{{ $quote->product->product_name }}</td>
            @else
                <td colspan="3" width="120">{{ $quote->product->product_name }}</td>
            @endif
            <td>@if($quote->product->type == 'non_glass')

                @else
                    {{ $quote->width }}
                @endif
            </td>
            <td>
                @if($quote->product->type == 'non_glass')

                @else
                    {{ $quote->height }}
                @endif
            </td>
            <td>
                @if($quote->product->type == 'non_glass')

                @else
                    {{ $quote->sqm }}
                @endif
            </td>
            <td>{{ $quote->quantity }}</td>
           @if($discount > 0)
                <td>
                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                        {{--{{ $quote->net_price }}--}}
                    @php
                    
                     if($quote->product->type == "non_glass"){
                           $pro_price = $quote->product->sale_net_sqm;
                           $extra = 0;
                    }else{
                        $pro_price = $quote->product->sale_net_sqm * $quote->sqm;
                        //dd($pro_price);
                        $extra = $quote->cutout + $quote->notch + $quote->hole + ($quote->back_select * $quote->sqm) + ($quote->finish * $quote->sqm) + $quote->cnc + ($quote->sandblasted * $quote->sqm) + ($quote->ritec * $quote->sqm);
                        }
                    //dd($extra);
                    
                       // $pro_price = $quote->product->sale_net_sqm * $quote->sqm;
                        //dd($pro_price);
                        //$extra = $quote->cutout + $quote->notch + $quote->hole + ($quote->back_select * $quote->sqm) + ($quote->finish * $quote->sqm) + $quote->cnc + ($quote->sandblasted * $quote->sqm) + ($quote->ritec * $quote->sqm);
                    //dd($extra);
                    @endphp
                        {{ round($pro_price, 2) + $extra}}
                    @endif
                </td>
                <td>
                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                        {{ $quote->trade_discount }}
                    @endif
                </td>
            @else
            @endif
            @php

                $disc = ($quote->net_price * $quote->trade_discount) /100 ;
                $net_price = $quote->net_price - $disc ;
            @endphp
            @if($discount > 0)
                <td>
                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        {{--{{ round($net_price, 2) }}--}}
                        {{--{{ round($quote->product->sale_net_sqm, 2) }}--}}
                        @if($quote->product->type == "non_glass")
                            {{$net_price}}
                        @else
                            {{ round($quote->net_price, 2) }}
                        @endif
                        
                        <!--{{ round($quote->net_price, 2) }}-->
                    @endif

                </td>
            @else
                <td colspan="2">
                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                        {{ round($net_price, 2) }}
                    @endif
                </td>

        @endif
        <tr>
            <td style="border: 0px;"></td>
            <td colspan="9" style="border: 0px;">

                @php
                    $pro = App\Models\Product::find($quote->product_id);
                @endphp
                    @if($quote->cutout > 0 )
                        @php
                                $coutout = $quote->cutout /$pro->cut_out;
                        @endphp
                        Cut Out X {{$coutout}} |
                    @endif
                    @if($quote->notch > 0 )
                        @php
                                $notch = $quote->notch /$pro->notch;
                        @endphp
                        Notch X {{$notch}} |
                    @endif
                    @if($quote->hole > 0 )
                        @php
                                $hole = $quote->hole /$pro->hole;
                        @endphp
                        Hole X {{$hole}} |
                    @endif
                @if($quote->rake > 0 )
                    @php
                        $rake = $quote->rake /$pro->rake;
                    @endphp
                    Rake X {{$rake}} |
                @endif
                @if($quote->radius_corners > 0 )
                    @php
                        $radius_corners = $quote->radius_corners /$pro->radius_corners;
                    @endphp
                    Radius Corners X {{$radius_corners}} |
                @endif
                    @if($quote->back_select == $pro->painted && $pro->painted >0)

                        Painted |
                    @endif
                        @if($quote->finish == $pro->sparkle_finish && $pro->sparkle_finish >0)

                             Sparkle Finish |
                        @endif
                        @if($quote->finish == $pro->metallic_finish && $pro->metallic_finish >0)

                             Metallic Finish |
                        @endif
                    @if($quote->back_select == $pro->printed && $pro->printed>0)
                        Printed
                    @endif
                @if($quote->cnc > 0 )
                    CNC |
                @endif
                @if($quote->sandblasted > 0 )
                    Sandblasted |
                @endif
                @if($quote->ritec > 0 )
                    Ritec |
                @endif
                @if($quote->bevel_edges > 0 )
                    Bevel Edges
                @endif
            </td>
        </tr>
        
         @if($quote->note)
        <tr>
            <td style="border: 0px;"></td>
            <td colspan="9" style="border: 0px;">

                    <b>Note:</b>{{ $quote->note }}
            </td>
        </tr>
        @endif
        
         @if($quote->image_status == 1)
            <tr>
                <td style="border: 0px;"></td>
                <td colspan="9" style="border: 0px;">
                    <img src="{{ asset('assets/product_images/'.$quote->product->product_image) }}" height="100" style="margin-top:10px;">
                </td>
            </tr>
            @endif
        </tr>
    @endforeach
    <tr>
        @php
            $gross_total = round($quotes->deals->sum('total_gross'), 2);
            $delivery_charges = $quotes->delivery_charges;
            $grand_total = $gross_total + $delivery_charges;
            $sqm = $quotes->deals->sum('sqm');
            $distance = $quotes->delivery_distance;
            
             // calculation for net discount
            $net = $gross_total/1.2;
            $discount_vat = $gross_total - $net;
        @endphp
        <td colspan="5">
            <b>Comment :</b>{{ $quotes->comment }}
        </td>
        <td colspan="4"><h5>
             @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->total_net_status == 1)
                            Total Net <br/>
                        @endif
                        @endif
             @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->total_vat_status == 1)
                            Total Vat <br/>
                        @endif
                         @endif
            @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->gross_total_status == 1)
                            <b>Gross Total</b> <br/>
                        @endif
                            @endif
                @if($quotes->hide_collect == 1)
                Grand Total (Collected) <br />
                @endif
                @if($quotes->hide_delivered == 1)
                Grand Total (Delivered) <br />
                @endif
                @if($quotes->hide_survey == 1)
                Grand Total (Survey & Fit) 
                @endif
            </h5>
            </td>
        <td><h5 class="text-right">
           @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->total_net_status == 1)
                            £{{ round($net,2) }}<br/>
                        @endif
                        @endif
            @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->total_vat_status == 1)
                            £{{ round($discount_vat,2) }}<br/>
                        @endif
                        @endif
            @if($quotes->hidden_price == 'Option_1(display_all_price_fields)' || $quotes->hidden_price == 'Option_2(hide_net_price_column_and_discount_column)')
                        @if($quotes->gross_total_status == 1)
                            <b>£{{ $gross_total }}</b><br/>
                        @endif
                            @endif
                <!--collection calculation -->
                @if($quotes->hide_collect == 1)
                £{{ $quotes->collected }}<br />
                @endif

                @if($quotes->hide_delivered == 1)
                <!--delivery calculation -->
                @if($quotes->delivered == 'N/A')
                    N/A<br />
                @else
                    £{{ $quotes->delivered + $gross_total}}<br />
                @endif
                @endif
            <!--survey calculation-->

                @if($quotes->hide_survey == 1)
                @if($quotes->survey == 'N/A')
                    N/A<br />
                @else
                   £{{ $quotes->survey + $gross_total}}<br />
                @endif
                @endif
            </h5>
        </td>
        All prices are inclusive of VAT
    </tr>
    <!--<tr><td colspan="10"><h5>*Discount is aplicable on glass only</h5></td></tr>-->
    </thead>
    <tbody>

    </tbody>
</table>
<hr />

    <h4 class="text-center"><strong>STANDARD TERMS & CONDITIONS OF QUOTATION</strong></h4>
    <p>1. <strong>All prices are inclusive of VAT at the applicable rate </strong></p>
    <p>2. All quotations are valid for 30 days from date of issue.</p>
    <p>3. Full payment on pro forma invoice is normally required on order, however, we do provide 30 day monthly
        terms which is subject to approval of a submitted account application, unless otherwise stated.</p>
    <p>4. All glass will be loose loaded and tail board with delivery during normal working hours, Monday to
        Friday 8am- 5pm, excluding weekends and public holidays unless otherwise stated.</p>
    <p>5. Any templates will be free issue to ourselves and must be full size rigid hardboard and clearly marked
        (paper is not acceptable as templates). We retain templates for a period of 14 days before disposal or return
        and all manufacturing from templates will be within manufacturer tolerances.</p>
    <p>6. We subscribe to and adhere to that all our glass products are sold subject to GGF visual quality standards
        and standard glass manufacturing and processing tolerances.</p>
    <p>7. Due to the nature and scope of matching decorated colour products such as paint, films, fabric and some glass
        materials etc we cannot be held responsible for not providing an exact colour match even if samples have been provided.
        Unless otherwise stated all our quotations are based on standard float glass. On closer inspection slight blemishes, imperfections and surface scratches can appear due to the processing, heating, cooling of toughened        glass. This is unavoidable but also minimal. Imperfections that are not clearly visible in a 500mm square at a distance of 3mtrs        and in a natural light environment with all downlighters switched off are deemed acceptable.</p>
    <p>8. We provide lead times and delivery/collection dates in good faith and are based on all the relevant information we have
        at the time. In most cases of technical and specialist works these can vary greatly and we will keep you informed of the
        progress of your works but cannot be held responsible for delays outside our control and will not accept or agree to
        any contra charging or provide any other compensation for your subsequent losses, unless otherwise stated. Any delivery date
        is otherwise, purely indicative. Printed glass and toughened mirrors can take up to 3 weeks to be manufacured. </p>
    <p>9. We do not accept withholding of payments for any reason including retention payments, discounts and any kind of performance bond etc,
        unless otherwise stated. All our products are subject to a full 12 month manufacturer defect warranty.</p>
    <p>10.We value quality and customer service, therefore, in the event that you are unhappy with any of
        our products due to defects we will gladly replace the item, provided, you inform us in writing no later
        than 24h from delivery date and the faulty product can be returned to our works for inspection as soon as possible,
        otherwise, any remake will be chargeable.</p>
    <p>11.We can provide some samples free of charge, however, other samples may be chargeable. Visit our website for more details.</p>
    <p>12.We reserve the right to amend any price if final sizes and/or quantities differ from quotation.</p>
    <p>
        13.Technical Limitations;<br />

    <p>1) Minimum area charge for float annealed 0.25m2, Low Iron 0.25m2, Toughened and IGU glass
        is 0.30m2.</p>
    <p>2) Minimum glass size for toughening is 275mm x 100mm.</p>
    <p>3) Maximum glass size for toughening is 3600mm x 2000mm.</p>
    <p>4) Minimum area charge for toughened laminated is 0.3m2.</p>
    <p>5) All circles are priced on application.</p>
    <p>6) Holes and or cut outs on toughened glass must be within manufacturing tolerances and we reserve the right to
        refuse any order that does not comply with our specifications. All internal cut outs will have a radius minimum
        of the thickness of the glass.</p>

    </ul>
    </p>
<p><a role="button" href="{{ route('send.pdf', $quotes) }}" class="btn btn-info bottom-btn">Send Quote</a></p>


<!-- Footer -->
<footer class="page-footer font-small blue footer bottom">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="font-size:12px">
        ALL GOODS SUPPLIED REMAIN PROPERTY OF MCG UNTIL PAID FOR IN FULL.<br>
        ALL ORDERS ARE ACCEPTED STRICTLY ON MCG’S TERMS AND CONDITIONS.
<br />
        <span >MCG | 020 8099 9455 | info@mcg.glass</span>

    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
</body>
</html>