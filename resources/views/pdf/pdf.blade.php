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
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 10px;
            padding-right: 10px;
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
                        $netPrice = 0;
                        $gross_total = 0;
                        $total_sqm = 0;
                        $total_items = 0;
                    @endphp
                    @foreach ($quotes->deals as $quote)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            @if ($discount > 0 && $quotes->net_price_status == 1)
                                <td>
                                    @if($quote->product_id!=null)
                                        {{ $quote->product->product_name }}
                                    @elseif($quote->guest_id!=null)
                                        {{ $quote->guest->title }}
                                    @endif
                                </td>
                            @elseif($discount > 0 || $quotes->net_price_status == 1)
                                <td colspan="2">
                                    @if($quote->product_id!=null)
                                        {{ $quote->product->product_name }}
                                    @elseif($quote->guest_id!=null)
                                        {{ $quote->guest->title }}
                                    @endif
                                </td>
                            @else
                                <td colspan="3">
                                    @if($quote->product_id!=null)
                                        {{ $quote->product->product_name }}
                                    @elseif($quote->guest_id!=null)
                                        {{ $quote->guest->title }}
                                    @endif
                                </td>
                            @endif

                            <td>
                                @if($quote->guest_id!=null)
                                    -
                                @else
                                    {{ $quote->width }}
                                @endif
                            </td>
                            <td>
                                @if($quote->guest_id!=null)
                                    -
                                @else
                                    {{ $quote->height }}
                                @endif
                            </td>
                            <td>
                                @if($quote->guest_id!=null)
                                    -
                                @else
                                    {{ number_format($quote->sqm, 2) }}
                                @endif
                            </td>
                            <td>{{ $quote->quantity }}</td>
                            @if ($discount > 0)
                                <td>
                                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')
                                        @if($quote->trade_discount != null)
                                            {{ $quote->trade_discount }}%
                                        @endif
                                    @endif
                                </td>
                            @endif
                            @if ($quotes->net_price_status == 1)
                                <td>
                                    @if($quotes->hidden_price == 'Option_1(display_all_price_fields)')

                                        @php
                                            if ($quote->product) {
                                                $disc = ($quote->net_price * $quote->trade_discount) / 100;
                                                $net_price1 = $quote->net_price - $disc;
                                                $netPrice = round($net_price1, 2);
                                            } else {
                                                $netPrice = round($quote->net_price, 2);
                                            }
                                        @endphp
                                        {{ number_format($netPrice, 2) }}
                                    @endif
                                </td>
                            @endif
                        </tr>

                        @if($quote->image_status == 1)
                        <tr>
                            <td style="border: 0px;"></td>
                            <td colspan="8" style="border: 0px;">
                                @if($quote->product->product_image_path) 
                                    @php
                                        $image = "product_image/product/". $quote->product->product_image_path;
                                    @endphp
                                    <img src="{{ $image }}" height="100px" width="100px" style="margin-top:10px;">
                                @else
                                    <img src="product_image/product/no_img.jpg" height="100px" width="100px" style="margin-top:10px;">
                                @endif
                            </td>
                        </tr>
                        @endif

                        <tr>
                            <td style="border: 0px;"></td>
                            <td colspan="8" style="border: 0px;">
                            @if($quote->product_id!=null)
                                @if($quote->product->type == 'basic' || $quote->product->type == 'standard')
                                @elseif ($quote->matt_finish_option == 1)
                                    Single Sided |
                                @elseif($quote->matt_finish_option == 2)
                                    Double Sided |
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
                            @elseif($quote->guest_id!=null)
                                <b>Description:</b> {{ $quote->guest->description }}
                            @endif
                            </td>
                        </tr>
                        @if( $quote->note )
                            <tr>
                                <td style="border: 0px;"></td>
                                <td colspan="8" style="border: 0px;"><b>Note:</b> {{ $quote->note }}</td>
                            </tr>
                        @endif

                        @php                                
                            if ($quote->product) {
                                $pro_disc = ($quote->net_price * $quote->trade_discount) / 100;
                                $pro_net_price = $quote->net_price - $pro_disc;
                                $pro_vat1 = ($pro_net_price * 20) / 100;
                                $pro_vat = round($pro_vat1, 2);
                            } else {
                                $pro_vat = round($quote->vat, 2);
                            }
                            $vat += $pro_vat;
                            $net_price += $netPrice;
                            $gross_total += $quote->total_gross;

                            $total_sqm = $total_sqm + ($quote->sqm * $quote->quantity);
                            $total_items = $total_items + $quote->quantity;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <b>Comment : {{ $quotes->comment }}</b></br>
                            <b>Internal Comment : {{ $quotes->internal_comment }}</b>
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

                                <br>Total items<br />
                                @if ($quotes->total_sqm_status == 1)
                                    Total Sqm<br />
                                @endif
                                @if ($quotes->hide_collect == 1)
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

                                <br>{{ $total_items }}<br />
                                @if ($quotes->total_sqm_status == 1)
                                    {{ number_format($total_sqm, 2) }}<br />
                                @endif
                                @if ($quotes->hide_collect == 1)
                                    £{{ number_format($gross_total, 2) }}<br />
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
                <li>All prices are  inclusive of <strong>VAT</strong> at the applicable rate where stated</li>
                <li>All quotations are valid  for <strong>30 days</strong> from date of issue.</li>
              <li>Payments - <strong>Full  payment</strong> is required prior to collection, without exception. Collection will  be denied if payment has not been received. We do not accept withholding of  payments for any reason including retention payments, discounts and any kind of  performance bond etc, unless otherwise stated.</li>
              <li>Deposit - Order values  over £500 will require a <strong>50% deposit</strong>. Order values below £500 will  require payment in full prior to commencing any works.</li>
              <li>Estimates - All estimates  are<u> </u>based on the information provided. If your project requires further  preparation work or entails far more work than expected, we will advise you  upon receipt of your work or during the course of works. We cannot guarantee  any estimates based upon descriptions or photos. We reserve the right to amend  any price if final sizes and/or quantities differ from the original quotation. </li>
              <li>Defects - Whilst every  item is checked during the packing process to ensure that it meets the highest  of standards, it is <strong>your</strong> <strong>responsibility</strong> to check that you are  fully satisfied prior to collection of your goods. We do not guarantee to  accept responsibility for damages reported after collection or delivery. Any  issues <strong>must</strong> be reported within <strong>24 hours</strong> of collection. In the  unlikely event that a fault is discovered which we have agreed to correct, it  is your responsibility to transport / return the items to us. We will not  contribute to any associated costs of delivery or transportation.<u></u></li>
              <li>Faults on Delivery – If  you have arranged for us to deliver your order, it is <strong>your responsibility</strong> to attend beforehand, and check you are satisfied with all items. We <strong>will  not</strong> be held responsible or be expected to bear the costs for collecting or  re-delivering any missing items or items deemed to be faulty. Any damage in  transit is not our responsibility and will have to be taken up with the courier  carrying out the delivery. Any faults must be reported within 24 hours of  receipt. <u></u></li>
              <li>Courier Collections - If  you are organising collection via courier, it is <strong>your responsibility</strong> to  attend beforehand and check you are satisfied with all items. We <strong>will not </strong>be  responsible for collecting or re-delivering any missing items or items deemed  to be faulty.<u></u></li>
              <li>Packaging and Protection  - All items are packed in a 1mm foam wrap. Items may be carefully grouped  together to economise on packaging. If you require further protection such as  edge or corner protectors, we must be informed as this will incur an additional  charge.<u></u></li>
              <li>Mirror / Glass – It is <strong>your  responsibility </strong>to check all doors containing mirror or glass prior to  sending them to us. We will not take responsibility for any scratched glass.  Our internal SOP&rsquo;s include masking all glass and mirror items prior to  preparation and therefore we cannot cause any scratching to mirrors or glass. Please  note that we cannot guarantee a very high quality finish where doors are glazed  prior to spraying. We advise removal of all  glazing prior to sending for spray. If you  choose to pre-glaze, we cannot take responsibility for any primer or paint  penetrating between the glass and framework.</li>
              <li>Ironmongery – All  ironmongery such as handles, locks or hinges must be removed prior to  delivering items to us for spraying. We will require all items to be removed  prior to spraying. This will incur a minimum charge of £40.00. Please note that  we will not take responsibility for any missing ironmongery or any damages  which may happen in processing or removal. If ironmongery cannot be removed, we  shall paint without removing it. We will not be held responsible for any  damages which take place to the ironmongery whilst spraying or preparing for  spray.</li>
              <li>Paint Colour Matches –  Whilst our paint suppliers have digitally scanned many original Designer paint colour  samples, we cannot guarantee a 100% representation of the original colour.  Please note that a 10% sheen, matt finish, is the best true representation of  any matched colour. As sheen levels are increased, the colour will look one  shade lighter for every 10% increment in sheen level. </li>
              <li>Scanned Colour Matches –  Whilst any sample you provide will be digitally scanned, we cannot guarantee a  100% representation of the original colour. Light colours may be matched and  adjusted &lsquo;by eye&rsquo; and these may differ more in representation as compared to  the original paint colour. </li>
              <li>Quality Standard – We  guarantee our paint finishes for 12 months from original application onto raw  MDF. Any re-painted or restored items are not covered by our guarantee. We will  prepare and spray all items to a very high standard with an expected inspection  distance of 2 metres, under indirect natural lighting. Any potential faults  visible under any shorter viewing distance is not covered under our quality assurance  policy. </li>
              <li>MDF – We assume that all  items provided for spraying will be made from Moisture Resistant MDF. If low  quality standard MDF is sent, an additional preparation charge may be applied  for preparation of edges. </li>
              <li>Additional Charges - Very  rough edges or unevenly sawn material may carry a further preparation charge. Any  items requiring excessive amounts of preparation and filling work may also  incur further charges.</li>
              <li>Lead Times - We provide  lead times and delivery/collection dates in good faith, and these are based on  the relevant information we have at the time. In most cases we will keep you  informed of the progress of your works, but we cannot be held responsible for  delays outside our control and will not accept or agree to any contra charging,  penalties or provide any other form of compensation for any subsequent losses  you may incur. Unless stated otherwise, any delivery date is therefore purely  indicative.cturing from templates will be
                    within manufacturer tolerances.                            </li>
            </ol>

        </div>

        <!--<button class="btn-info">Send Quote</button>-->
         <a href="{{ url('view-send-pdf', $quotes->id) }}" data-toggle="tooltip"
                                            title="Send & Download Quote" class="btn-info">Send Quote</a>
    </main>

    <!-- Footer -->
    <footer class="footer">
   <div class="footer-copyright">
            ALL GOODS SUPPLIED REMAIN THE PROPERTY OF ROKA SPRAY UNTIL PAID FOR IN FULL.<br>  
            ALL ORDERS ARE ACCEPTED STRICTLY ON ROKA SPRAY’S TERMS AND CONDITIONS.<br>  
            <span>RBC London LLP t/a ROKA Spray | Unit 2,
8 Walmgate Road, Perivale, London, UB6 7LH | 020 3004 4824| office@roka-spray.com</span>
        </div>
    </footer>
    <!-- Footer -->

</body>

</html>
