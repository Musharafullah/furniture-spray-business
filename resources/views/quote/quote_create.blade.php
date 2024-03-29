@extends('dashboardlayouts.master')
@section('title')
    <title>Create quote</title>
@endsection
@section('content')

    <div class="create-quote py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Create A Quote</h3>
                        </div>
                        @if($quote->id)
                            <div class="col-12 col-md-6">
                                <div class="row gx-2 gy-2">
                                    <div class="col-sm-6">
                                        @if(isset($previous))
                                            <a href="{{ route('quote.create', $previous) }}" class="btn btn-rounded btn-info w-100">
                                                <span><i class="fa fa-step-backward"></i></span>&nbsp;Previous
                                                Quote
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if(isset($next))
                                            <a href="{{ route('quote.create', $next) }}"class="btn btn-rounded btn-info w-100">Next Quote
                                                <span><i class="fa fa-step-forward"></i></span>
                                            </a>

                                        @endif
                                    </div>
                                </div>  
                            </div>
                        @endif
                    </div>

                    <!----------------------------------- Customer Info -------------------------------------->
                    <div class="row customer-info">
                        <div class="col-12">
                            <h4>Customer Info</h4>
                        </div>

                        <div class="col-12 col-md-8">
                            <select class="form-select select2" id="clients" onchange="client_info()" data-live-search="true" required></select>
                        </div>
                        
                        @if ($quote->id)
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="cust_name">Name</label>
                                    <input id="cust_name" class="form-control" type="text" placeholder="Enter Name"
                                        value="{{ $quote->id ? $quote->client->name : '' }}"
                                        {{ $quote->id ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cust-billcode">Billing Postcode</label>
                                    <input id="cust_billcode" class="form-control" type="text" placeholder="Enter Name"
                                        value="{{ $quote->id ? $quote->client->postal_code : '' }}"
                                        {{ $quote->id ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="cust-postcode">Project Postcode</label>
                                    @if (!empty($quote->billing_postal_code))
                                        <input id="cust_postcode" class="form-control" type="text" placeholder="Enter Name"
                                            value="{{ $quote->id ? $quote->billing_postal_code : '' }}"
                                            {{ $quote->id ? 'readonly' : '' }}>
                                    @else
                                        <input id="cust_postcode" class="form-control" type="text" placeholder="Enter Name"
                                            value="{{ $quote->id ? $quote->client->postal_code : '' }}"
                                            {{ $quote->id ? 'readonly' : '' }}>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-sm-1">
                                <div style="margin-top:35px; margin-left:-23px;"><a href="#" data-toggle="modal"
                                        data-target="#editpostal" id="edit_postal">(Edit)</a></div>
                            </div> --}}

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cust-email">Email</label>
                                    <input id="cust_email" class="form-control" type="text" placeholder=""
                                        value="{{ $quote->id ? $quote->client->email : '' }}"
                                        {{ $quote->id ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cust_phone">Telephone</label>
                                    <input id="cust_phone" class="form-control" type="text" placeholder=""
                                        value="{{ $quote->id ? $quote->client->phone : '' }}"
                                        {{ $quote->id ? 'readonly' : '' }}>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td colspan="7">
                                                    <select class="form-select" id="hidden_option">
                                                        @php
                                                            $types = ['Option_1(display_all_price_fields)', 'Option_2(hide_net_price_column_and_discount_column)', 'Option_3(hide_all_price_column_and_discount_including_gross_total,vat,total net)'];
                                                        @endphp
                                                        @foreach ($types as $type)
                                                            @php
                                                                $select = old('hidden_price', $quote->hidden_price) == $type ? 'selected' : '';
                                                            @endphp
                                                            <option
                                                                value="{{ $type . '/' . $quote->id ?? old('type') }}"
                                                                {{ $select }}>
                                                                @php
                                                                    // $role_name= $role->name;
                                                                    $type = str_replace('_', ' ', $type);
                                                                    //$type = ucwords($type);
                                                                @endphp
                                                                {{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th colspan="11">Item details</th>

                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Code</td>
                                                <td>Product</td>
                                                <td>Width(mm)</td>
                                                <td>Height(mm)</td>
                                                <td>SQM(m)</td>
                                                <td>Quantity</td>
                                                <td>Net Price</td>
                                                <td>VAT</td>
                                                <td>Discount Applied (%)</td>
                                                <td>Gross Price</td>
                                                <td>Action</td>

                                            <tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_sqm = 0;
                                                $total_items = 0;
                                                $guest_code = 0;
                                            @endphp
                                            @foreach ($quote->deals as $deal)
                                                @php
                                                    if($deal->guest_id==null){
                                                        if($deal->product->type == 'basic'){
                                                            $total_sqm = $total_sqm + 0;
                                                        }
                                                        else{
                                                            $total_sqm = $total_sqm + ($deal->sqm * $deal->quantity);
                                                        }
                                                    }
                                                    $total_items = $total_items + $deal->quantity;
                                                @endphp
                                                <tr>
                                                    <td>{{ 'Item: ' . $loop->iteration }}</td>
                                                    <td>
                                                        @if($deal->product_id!=null)
                                                            {{ $deal->product->code }}
                                                        @elseif($deal->guest_id!=null)
                                                            @php
                                                                ++$guest_code;
                                                            @endphp
                                                            GUEST-{{ $guest_code }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($deal->product_id!=null)
                                                            {{ $deal->product->product_name }}
                                                        @elseif($deal->guest_id!=null)
                                                            {{ $deal->guest->title }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($deal->guest_id!=null || $deal->product->type == 'basic')
                                                            -
                                                        @else
                                                            {{ $deal->width }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($deal->guest_id!=null || $deal->product->type == 'basic')
                                                            -
                                                        @else
                                                            {{ $deal->height }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($deal->guest_id!=null || $deal->product->type == 'basic')
                                                            -
                                                        @else
                                                            {{ number_format($deal->sqm, 2) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $deal->quantity }}</td>
                                                    <td>
                                                        @php
                                                            if ($deal->product) {
                                                                $disc = ($deal->net_price * $deal->trade_discount) / 100;
                                                                $net_price1 = $deal->net_price - $disc;
                                                                $net_price = round($net_price1, 2);
                                                            } else {
                                                                $net_price = round($deal->net_price, 2);
                                                            }
                                                        @endphp
                                                        {{ number_format($net_price, 2) }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            if ($deal->product) {
                                                                $pro_disc = ($deal->net_price * $deal->trade_discount) / 100;
                                                                $pro_net_price = $deal->net_price - $pro_disc;
                                                                $pro_vat1 = ($pro_net_price * 20) / 100;
                                                                $pro_vat = round($pro_vat1, 2);
                                                            } else {
                                                                $pro_vat = round($deal->vat, 2);
                                                            }
                                                        @endphp
                                                        {{ number_format($pro_vat, 2) }}
                                                    </td>
                                                    <td>{{ $deal->trade_discount }}</td>
                                                    <td>{{ number_format($deal->total_gross, 2) }}</td>
                                                    <td>
                                                        <div>
                                                            <nobr>
                                                                @if($deal->product_id!=null)
                                                                    <a href="{{ route('duplicate_item', $deal->id) }}"
                                                                        data-toggle="tooltip" title="Duplicate Item"><i
                                                                            class="fa fa-copy"></i>
                                                                    </a>
                                                                    <a href="{{ route('quote.edit', $deal->id) }}" data-toggle="tooltip" title="Edit Item">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a href="{{ route('destroy_item', $deal->id) }}"
                                                                        data-toggle="tooltip" title="Delete Item"><i
                                                                            class="fa fa-times-circle"></i>
                                                                    </a>
                                                                    <label class="switch ">
                                                                        <input type="checkbox" name="image_status"
                                                                            class="primary" value="{{ $deal->id }}"
                                                                            {{ $deal->image_status == 1 ? 'checked' : '' }}>
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                @elseif($deal->guest_id!=null)
                                                                    <a href="{{ route('guestItem.edit', $deal->id) }}" data-toggle="tooltip" title="Edit Item">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a href="{{ route('destroy_guest', $deal->guest_id) }}"
                                                                        data-toggle="tooltip" title="Delete Item"><i
                                                                            class="fa fa-times-circle"></i>
                                                                    </a>
                                                                @endif
                                                            </nobr>
                                                        </div>

                                                    </td>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="10" style="border: 0px;">
                                                    @if($deal->product_id!=null)
                                                        @if($deal->product->type == 'basic' || $deal->product->type == 'standard')
                                                        @elseif ($deal->matt_finish_option == 1)
                                                            Single Sided |
                                                        @elseif($deal->matt_finish_option == 2)
                                                            Double Sided |
                                                        @endif
                                                        @if ($deal->spraying_edges > 0)
                                                            Sprayed Edges |
                                                        @endif
                                                        @if ($deal->metallic_paint > 0)
                                                            Metallic |
                                                        @endif
                                                        @if ($deal->gloss_percentage_option == 1)
                                                            80% Gloss |
                                                        @elseif($deal->gloss_percentage_option == 2)
                                                            100% Gloss |
                                                        @elseif($deal->gloss_percentage_option == 3)
                                                            100% Gloss Acrylic Lacquer |
                                                        @endif
                                                        @if ($deal->wood_stain > 0)
                                                            Wood stain |
                                                        @endif
                                                        @if ($deal->gloss_100_acrylic_lacquer > 0)
                                                            100% Gloss / Wet Look Clear Acrylic Lacquer |
                                                        @endif
                                                        @if ($deal->polyester > 0)
                                                            Polyester / Full Grain |
                                                        @endif
                                                        @if ($deal->burnished_finish > 0)
                                                            Burnished Finish |
                                                        @endif
                                                        @if ($deal->barrier_coat > 0)
                                                            Barrier Coat |
                                                        @endif
                                                        @if ($deal->edgebanding > 0)
                                                            Edge banding |
                                                        @endif
                                                        @if ($deal->micro_bevel > 0)
                                                            Micro bevel |
                                                        @endif
                                                        @if ($deal->routed_handle_spraying > 0)
                                                            Routed / J Handle |
                                                        @endif
                                                        @if ($deal->beaded_door > 0)
                                                            Beaded Door |
                                                        @endif
                                                    @elseif($deal->guest_id!=null)
                                                        <b>Description:</b> {{ $deal->guest->description }}
                                                    @endif
                                                    </td>
                                                </tr>
                                                @if ($deal->note)
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="10">

                                                            <b>Note:</b> {{ $deal->note }}
                                                        <td>
                                                    </tr>
                                                @endif
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td colspan="6">
                                                    @php
                                                        $product_sum_total = round($quote->deals->sum('total_gross'), 2);
                                                        $delivery_charges = $quote->delivery_charges;
                                                        $grand_total = $product_sum_total + $delivery_charges;

                                                        // calculation for net discount
                                                        $net = $product_sum_total / 1.2;
                                                        $discount_vat = $product_sum_total - $net;
                                                    @endphp
                                                    <h5>Total</h5>
                                                </td>
                                                <td colspan="3">
                                                    <h5>Net price: £{{ number_format($net, 2) }}
                                                        <label class="switch ">
                                                            <input type="checkbox" name="total_net_status" class="primary"
                                                                value="{{ $quote->id }}"
                                                                {{ $quote->total_net_status == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5> Vat : £{{ number_format($discount_vat, 2) }}<br />
                                                        <label class="switch ">
                                                            <input type="checkbox" name="total_vat_status" class="primary"
                                                                value="{{ $quote->id }}"
                                                                {{ $quote->total_vat_status == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </h5>
                                                </td>

                                                <td colspan="2">
                                                    <h5> Gross total :
                                                        £{{ number_format($product_sum_total, 2) }}<br />
                                                        <label class="switch ">
                                                            <input type="checkbox" name="gross_total_status" class="primary"
                                                                value="{{ $quote->id }}"
                                                                {{ $quote->gross_total_status == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </h5>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="pull-right">
                                                    <h5>
                                                        <label class="switch ">
                                                            <input type="checkbox" name="total_sqm_status" class="primary"
                                                                value="{{ $quote->id }}"
                                                                {{ $quote->total_sqm_status == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                        Total Sqm ({{  number_format($total_sqm, 2) }})
                                                    </h5>
                                                    <h5>
                                                        <label class="switch ">
                                                            <input type="checkbox" name="collect_status" class="primary"
                                                                value="{{ $quote->id }}"
                                                                {{ $quote->hide_collect == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                        {{-- Grand Total (Collected) : £{{ $quote->collected }} --}}
                                                        Grand Total (Collected) : £{{ number_format($product_sum_total, 2) }}
                                                    </h5>

                                                    <h5 class="pb-3">
                                                        <label class="switch ">
                                                            <input type="checkbox" name="delivered_status"
                                                                class="primary" value="{{ $quote->id }}"
                                                                {{ $quote->hide_delivered == 1 ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>

                                                        Grand Total (Delivered) :
                                                        @if ($quote->delivered == 'N/A')
                                                            N/A
                                                            <small><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#myModal"
                                                                    id="edit_delivered">(Edit)</a></small><br />
                                                            <small>Client distance exceed 60 miles</small>
                                                        @else
                                                            £{{ number_format($quote->delivered + $product_sum_total, 2) }}
                                                            <small><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#myModal"
                                                                    id="edit_delivered">(Edit)</a></small>
                                                        @endif
                                                    </h5>
                                                    <h6><b>Total items: {{ $total_items }}</b></h6>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-sm-6 pull-right">
                                    <a href="{{ route('quote.pdf', $quote->id) }}" target="_blank">
                                        <button class="btn btn-primary-rounded">
                                            Review Quote <span><i class="fa fa-save"></i></span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-4">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addcustomer">
                                    Add Customer <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust_name">Name</label>
                                    <input id="cust_name" name="cust-name" class="form-control" type="text"
                                        placeholder="Enter Name" value="{{ $quote->id ? $quote->client->name : '' }}" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust_phone">Telephone</label>
                                    <input id="cust_phone" name="cust-phone" class="form-control" type="number"
                                        placeholder="Enter Number" value="{{ $quote->id ? $quote->client->phone : '' }}" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust-email">Email</label>
                                    <input id="cust_email" name="cust-email" class="form-control" type="email"
                                        placeholder="Enter Email" readonly="" value="{{ $quote->id ? $quote->client->email : '' }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust-postcode">Billing Postcode</label>
                                    <input id="cust_postcode" name="billing_postal_code" class="form-control"
                                        type="text" placeholder="Postcode" value="{{ $quote->id ? $quote->client->postal_code : '' }}" readonly="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cust-address">Address</label>
                                    <textarea id="cust_address" class="form-control" rows="3" placeholder="Enter Address" readonly="">{{ $quote->id ? $quote->client->address : '' }}</textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!----------------------------------- End Customer Info -------------------------------------->

                    <!----------------------------------- Add Products -------------------------------------->
                    <form action="{{ route('create_quote') }}" method="POST">
                        @csrf
                        @if ($clint_id)
                            <input type="hidden" name="quote_id" id="" value="{{ $clint_id }}" />
                        @else
                            <input type="hidden" name="client_id" id="client_id" />
                        @endif

                        <div class="row add-product">
                            <div class="col-12">
                                <h4>Add Product</h4>
                            </div>
                            <div class="col-12 col-sm-7 col-md-5 col-lg-4 ms-auto mt-3 mb-3">
                                <button type="button" class="btn btn-primary-rounded" data-bs-toggle="modal" data-bs-target="#addGuest">
                                    Add Guest Item <span><i class="fa fa-save"></i></span>
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" id="type" />
                                            <label for="code_id">Code</label>
                                            <select name="code_id" id="code_id" class="form-select" required data-live-search="true">
                                                <option value=""> -- Select One --</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="product_id">Products</label>
                                            <select name="product_id" id="product_id" class="form-select" required data-live-search="true">
                                                <option value=""> -- Select One --</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 width">
                                        <div class="form-group">
                                            <label>Width</label>
                                            <input id="product_width" name="width" class="form-control" type="number"
                                                placeholder=" ">
                                        </div>
                                        @if ($errors->has('width'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $errors->first('width') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2 height">
                                        <div class="form-group">
                                            <label>Height</label>
                                            <input id="product_height" name="height" class="form-control"
                                                type="number" placeholder="" readonly>
                                            @if ($errors->has('height'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong class="text-danger">{{ $errors->first('height') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 sqm">
                                        <div class="form-group">
                                            <label for="product_sqm">SQM</label>
                                            <input id="product_sqm" name="sqm" class="form-control" type="number"
                                                placeholder="" readonly value="">
                                            <input id="db_sqm" class="form-control" type="hidden" placeholder="" value="">
                                            <input id="product_lm" class="form-control" type="hidden" placeholder="">
                                            <input id="pro_price" class="form-control" type="hidden" placeholder="">
                                            <input id="product_price" name="product_price" class="form-control"
                                                type="hidden" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Sides</label>
                                            <select name="matt_finish_option" id="matt_finish_option"
                                                class="form-select">
                                                <option value="0">-- Select option --</option>
                                                <option value="1">Single Sided</option>
                                                <option value="2">Double Sided</option>
                                            </select>
                                            <input name="matt_finish" id="matt_finish" class="form-control"
                                                type="hidden" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Sprayed Edges</label>
                                            <select name="spraying_edges" id="spraying_edges" class="form-select">
                                                <option value="1">YES</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Metallic</label>
                                            <select name="metallic_paint" id="metallic_paint" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label for="wood_stain">Wood stain</label>
                                            <select name="wood_stain" id="wood_stain" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Gloss Percentage</label>
                                            <select name="gloss_percentage" id="gloss_percentage" class="form-select">
                                                <option value="0">-- Select option --</option>
                                                <option value="">80% Gloss - Add on / Sqm (1 sided)</option>
                                                <option value="">100% Gloss / Wet Look PU Paint (SQM)</option>
                                                <option value="">100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)
                                                </option>
                                            </select>
                                            <input type="hidden" name="gloss_percentage_option"
                                                id="gloss_percentage_option" value="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label>100% Gloss / Wet Look</label>
                                            <select name="gloss_100_acrylic_lacquer" id="gloss_100_acrylic_lacquer"
                                                class="form-select">
                                                <option value="0">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label>Polyester / Full Grain</label>
                                            <select name="polyester" id="polyester" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Burnished Finish</label>
                                            <select name="burnished_finish" id="burnished_finish" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label for="barrier_coat">Barrier Coat</label>
                                            <select name="barrier_coat" id="barrier_coat" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Edge banding</label>
                                            <select name="edgebanding" id="edgebanding" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Micro bevel</label>
                                            <select name="micro_bevel" id="micro_bevel" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Routed / J Handle</label>
                                            <select name="routed_handle_spraying" id="routed_handle_spraying"
                                                class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Beaded Door</label>
                                            <select name="beaded_door" id="beaded_door" class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input id="quantity" name="quantity" class="form-control" type="number"
                                                placeholder="Please enter quantity" value="1">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="net_price">Net Price</label>
                                            <input id="net_price" name="net_price" class="form-control" type="number"
                                                placeholder="" readonly="">
                                            <input type="hidden" id="basic_net">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="vat">VAT</label>
                                            <input id="vat" name="vat" class="form-control" type="number"
                                                placeholder="" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="trade_discount">Trade_discount (%)</label>
                                            @if($quote->id)
                                                <input id="trade_discount" name="trade_discount" class="form-control"
                                                    type="number" placeholder="" value="{{ $quote->client->trade_discount }}">
                                            @else
                                                <input id="trade_discount" name="trade_discount" class="form-control"
                                                    type="number" placeholder="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="total_gross">Gross Total</label>
                                            <input id="total_gross" name="total_gross" class="form-control"
                                                type="number" placeholder="" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="product_note">Note</label>
                                            <textarea id="product_note" class="form-control" rows="3" placeholder="" readonly=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="note">Product Note</label>
                                            <textarea id="note" name="note" class="form-control" rows="3" placeholder="Please Add Product Note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------------------------- End Add Products -------------------------------------->
                        <!----------------------------------- Delivery Options -------------------------------------->
                        <div class="row delivery-options">
                            {{-- <div class="col-12">
                                <h4>Delivery Options</h4>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="delivery-distance">Distance From Our Location (In Miles)</label>
                                    <input id="delivery-distance" name="delivery-distance" class="form-control"
                                        type="text" placeholder="">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <h4>Quote Notes</h4>
                            </div>
                                
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea id="comment" name="comment" class="form-control" rows="3" style="text-align: start">@if ($quote->id){{ $quote->comment }}@endif</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="internal-comment">Internal comment</label>
                                    <textarea id="internal-comment" class="form-control" name="internal_comment" rows="3" style="text-align: start">@if ($quote->id){{ $quote->internal_comment }}@endif</textarea>
                                </div>
                            </div>

                            <div class="row mt-4 mx-0 g-3">
                                @if ($quote->id)
                                    <div class="col-sm-6">
                                        <button type="button" onclick="update_notes({{ $quote->id }})" class="btn btn-primary-rounded">
                                            Update quote notes <span><i class="fa fa-save"></i></span>
                                        </button>
                                    </div>  
                                @endif
                                <div class="col-sm-6 pull-right ms-auto">
                                    <button type="submit" class="btn btn-primary-rounded">
                                        Add another item <span><i class="fa fa-save"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
                <!----------------------------------- End Delivery Options -------------------------------------->

            </div>
        </div>
        <div class="text-center pt-5 pb-4">Please Filled the Billing Postcode field first and click the search button
            for
            house average price</div>
    </div>
    </div>


    <!----------------------- Add Customer Modal ------------------------------->
    <div aria-hidden="true" aria-labelledby="AddCustomerModal" class="modal modal-lg fade in" id="addcustomer"
        role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('client_store') }}" method="post" id="add_client_form">
                    @csrf
                    <input type="hidden" name="quote_create" value="1">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><span id="form_output" class="text-info"></span></h6>
                        <h6><span id="errors" class="text-danger"></span></h6>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                        placeholder="Enter Name" value="">
                                    @if ($errors->any())
                                        @if ($errors->has('name'))
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input id="phone" name="phone" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                    @if ($errors->any())
                                        @if ($errors->has('phone'))
                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        placeholder="Enter Email" value="">
                                    @if ($errors->any())
                                        @if ($errors->has('email'))
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="postal_code">Billing Postcode</label>
                                    <input id="postal_code" name="postal_code" class="form-control" type="text"
                                        placeholder="Postcode" value="">
                                    @if ($errors->any())
                                        @if ($errors->has('postal_code'))
                                            <strong class="text-danger">{{ $errors->first('postal_code') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="trade_discount">Trade Discount</label>
                                    <input name="trade_discount" class="form-control" type="number"
                                        placeholder="Enter Trade Discount" value="" >
                                    @if ($errors->any())
                                        @if ($errors->has('trade_discount'))
                                            <strong class="text-danger">{{ $errors->first('trade_discount') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" class="form-control" rows="3" placeholder="Enter Address" name="address"></textarea>
                                    @if ($errors->any())
                                        @if ($errors->has('address'))
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        {{-- <button class="btn-primary" type="submit" id="add">Add Customer</button> --}}
                        <button class="btn-primary" type="submit">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit delievry model --}}

    <!--start Modal for edit delivered-->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Delievery</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @php
                    $delivery = App\Models\DeliveryCharges::where('id', 1)->first();
                @endphp
                <form method="post" action="{{ route('edit_survey', $quote) }}" id="edit_delivered">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="delivered">Delivery Charges(£)</label>
                                    <input id="delivered" name="delivered" class="form-control" type="text"
                                        placeholder="Enter Number" value="{{ $quote->delivered }}">
                                    @if ($errors->has('delivered'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('delivered') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End endedit modal for delivered -->

    <!--start Modal for add guest item-->
    <div class="modal fade modal-lg" id="addGuest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Guest Item</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('guestItem.store') }}" id="add_guest_item">
                    @csrf

                    @if ($quote->id)
                        <input type="hidden" name="quote_id" value="{{ $quote->id }}" />
                    @else
                        <input type="hidden" name="client_id" id="item_client_id" />
                    @endif
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="guest_title">Title</label>
                                    <input id="guest_title" name="title" class="form-control" type="text"
                                        placeholder="Enter Title" value="Guest" required>
                                    @if ($errors->has('guest_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mt-4">
                                    <label for="guest_price">Price</label>
                                    <input id="guest_price" name="price" class="form-control" type="number"
                                        placeholder="Enter Price" value="" required>
                                    @if ($errors->has('guest_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mt-4">
                                    <label for="guest_quantity">Quantity</label>
                                    <input id="guest_quantity" name="quantity" class="form-control" type="number"
                                        placeholder="Enter Quantity" value="1" required>
                                    @if ($errors->has('guest_quantity'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-4">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4"
                                        placeholder="Enter Description" value="" required></textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group mt-4">
                                    <label for="guest_discount">Trade_discount (%)</label>
                                    <input id="guest_discount" name="trade_discount" class="form-control" type="number"
                                        placeholder="Enter Number" value="{{ $quote->id ? $quote->client->trade_discount : '' }}" required>
                                    @if ($errors->has('guest_discount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group mt-4">
                                    <label for="guest_net_price">Net Price</label>
                                    <input id="guest_net_price" name="net_price" class="form-control" value="" required readonly>
                                    @if ($errors->has('guest_net_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_net_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group mt-4">
                                    <label for="guest_vat">Vat</label>
                                    <input id="guest_vat" name="vat" class="form-control" value="" required readonly>
                                    @if ($errors->has('guest_vat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_vat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group mt-4">
                                    <label for="guest_total_price">Total Price</label>
                                    <input id="guest_total_price" name="total_price" class="form-control"value="" required readonly>
                                    @if ($errors->has('guest_total_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('guest_total_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 mt-2">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Add Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End add guest item modal -->


@endsection
@section('scripts')
    <script>
        function update_notes(id) {

            var comment = document.getElementById("comment").value;
            var internal_comment = document.getElementById("internal-comment").value;

            $.ajax({
                type: "get",
                url: "{{ route('update.notes') }}",
                data: {
                    id: id,
                    internal_comment: internal_comment,
                    comment: comment,
                },
                success: function(response) {
                    //alert(response);
                    showMessage('success', response)
                }
            });
        }

        function showMessage(data, message) {
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "debug": false,
                "newestOnTop": false,
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            if (data == 'success') {
                toastr.success(message)
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var quote_id = '{{ $quote->id }}';
            if(quote_id == null || quote_id==""){
                quote_id = null;
            }

            $.ajax({
                type: "get",
                url: "{{ route('allclient', ['id' => ':id']) }}".replace(':id', quote_id),
                success: function(response) {
                    //console.log(response.client);
                    $("#clients").html(response.client);
                }
            });

            $('.select2').select2().on('select2:open', function(e){
                $('.select2-search__field').attr('placeholder', 'Search here.....');
            });
            

            $('.full_wood').hide();
            $('.full_paint').show();

            //Product image hide/show
            $('input[name="image_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var deal_id = $(this).val();
                var status = 0;
                //console.log(event.target.checked);
                if (event.target.checked) {
                    status = 1;
                }

                $.ajax({
                    type: "GET",
                    url: " {{ route('image_status') }}",
                    data: {
                        status: status,
                        deal_id: deal_id
                    },
                    success: function(data) {
                        // console.log(data);
                    }

                });
            });
            //total vat status change
            $('input[name="total_vat_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                //console.log('quote_id' + quote_id);
                var total_vat_status = 0;
                if (event.target.checked) {
                    total_vat_status = 1;
                }
                $.ajax({
                    type: "GET",
                    url: " {{ route('total_vat_status') }}",
                    data: {
                        total_vat_status: total_vat_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                        // console.log('ok')
                    }

                });
            });
            // total net price status
            //total net status change
            $('input[name="total_net_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                //console.log('quote_id' + quote_id);
                var total_net_status = 0;
                if (event.target.checked) {
                    total_net_status = 1;
                }
                $.ajax({
                    type: "GET",
                    url: " {{ route('total_net_status') }}",
                    data: {
                        total_net_status: total_net_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                        // console.log('ok')
                    }

                });
            });

            //gross total status change
            $('input[name="gross_total_status"]').on('change', function(event,
                state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                console.log('quote_id' + quote_id);
                var gross_total_status = 0;
                if (event.target.checked) {
                    gross_total_status = 1;
                }
                $.ajax({
                    type: "GET",
                    url: " {{ route('gross_total_status') }}",
                    data: {
                        gross_total_status: gross_total_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                        // console.log('ok')
                    }

                });
            });
            //net price status change
            $('input[name="net_price_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                //console.log('quote_id' + quote_id);
                var net_price_status = 0;
                if (event.target.checked) {
                    net_price_status = 1;
                }
                $.ajax({
                    type: "GET",
                    url: " {{ route('net_price_status') }}",
                    data: {
                        net_price_status: net_price_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                        // console.log('ok')
                    }

                });
            });

            //total sqm status change
            $('input[name="total_sqm_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                console.log('quote_id' + quote_id);
                var total_sqm_status = 0;
                //console.log(event.target.checked);
                if (event.target.checked) {
                    total_sqm_status = 1;
                }

                $.ajax({
                    type: "GET",
                    url: " {{ route('total_sqm_status') }}",
                    data: {
                        total_sqm_status: total_sqm_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                    }
                });
            });

            //collect status change
            $('input[name="collect_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                console.log('quote_id' + quote_id);
                var collect_status = 0;
                //console.log(event.target.checked);
                if (event.target.checked) {
                    collect_status = 1;
                }

                $.ajax({
                    type: "GET",
                    url: " {{ route('collect_status') }}",
                    data: {
                        collect_status: collect_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                    }

                });
            });

            //delivered status change
            $('input[name="delivered_status"]').on('change', function(event, state) { //switchChange.bootstrapSwitch
                var quote_id = $(this).val();
                console.log('quote_id' + quote_id);
                var delivered_status = 0;
                //console.log(event.target.checked);
                if (event.target.checked) {
                    delivered_status = 1;
                }
                $.ajax({
                    type: "GET",
                    url: " {{ route('delivered_status') }}",
                    data: {
                        delivered_status: delivered_status,
                        quote_id: quote_id
                    },
                    success: function(data) {
                        // console.log(data);
                    }

                });
            });

        });

        function client_info() {
            var selectElement = document.querySelector('.form-select');
            var selectedValue = selectElement.value;
            //alert(selectedValue);
            $.ajax({
                type: "get",
                url: "{{ route('clientinfo') }}/" + selectedValue,
                success: function(response) {
                    console.log(response.client);
                    //$("#clients").html(response.client);
                    $('#client_id').val(response.client.id);
                    $('#cust_name').val(response.client.name);
                    $('#cust_phone').val(response.client.phone);
                    $('#cust_email').val(response.client.email);
                    if(response.client.billing_postal_code == null) {
                        $('#cust_billcode').val(response.client.postal_code);
                    }
                    else{
                        $('#cust_billcode').val(response.client.billing_postal_code);
                    }
                    
                    $('#cust_postcode').val(response.client.postal_code);
                    $('#cust_address').val(response.client.address);
                    $('#trade_discount').val(response.client.trade_discount);
                    $('#guest_discount').val(response.client.trade_discount);
                    //alert(response.client.trade_discount);

                    var quote_id = '{{ $quote->id }}';
                    if(quote_id == null || quote_id==""){}
                    else {
                        $.ajax({
                            type: "get",
                            url: "{{ route('update_client_id', ['id' => ':id']) }}".replace(':id', response.client.id),
                            data: {
                                quote_id: quote_id
                            },
                            success: function(response) {
                                toastr.options = {
                                    "closeButton": true,
                                    "positionClass": "toast-bottom-right",
                                    "progressBar": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                                toastr.success("Customer changed successfully");
                            }
                        });
                    }
                }
            });
        }

        //client insert data
        $("#add_client_form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    //$('#form_output').html('Client submit successfully');
                    set_client(data.id, data.name, data.phone, data.postal_code, data.email, data
                        .address, data.trade_discount, data.distance);
                },
                error: function(data) {
                    console.log("Error");
                    var errors = '';
                    $.each(data.responseJSON.errors, function(key, value) {
                        errors += value + '<br />';
                    });
                    $('#errors').html(errors);
                }
            });
        });

        //client insert data
        $("#add_guest_item").on('submit', function(event) {
            var item_client_id = $('#clients').val();
            $('#item_client_id').val(item_client_id);
        });

        //set all client data after adding new client through modal
        function set_client(id, name, phone, postal_code, email, address, trade_discount, distance) {
            var quote_id = '{{ $quote->id }}';
            if(quote_id == null || quote_id==""){
                quote_id = null;
            }
            $.ajax({
                type: "GET",
                url: "{{ route('allclient', ['id' => ':id']) }}".replace(':id', quote_id),
                dataType: 'json',
                cache: false,
                success: function(result) {
                    //alert(id);
                    $('#addcustomer').modal('hide');
                    $('.fade').hide();
                    $("#clients").html(result.client);
                    if (id) {
                        $('#client_id').val(id);
                        $('#clients').val(id);
                        $('#cust_name').val(name);
                        $('#cust_phone').val(phone);
                        $('#cust_email').val(email);
                        $('#cust_postcode').val(postal_code);
                        $('#cust_address').val(address);
                        $('#trade_discount').val(trade_discount);
                        //$('#delivery_distance').val(distance);
                    }
                },
            });
        }

        $("#code_id, #product_id").change(function() {
            var val = $(this).val();
            var id = $(this).attr('id');
            if (id == 'code_id') {
                $('#product_id').val(val);
            } else {
                $('#code_id').val(val);
            }

            //This is simple Get ajax request
            var url = '{{ url('get-product-data') }}' + '/' + val;

            $.get(url, function(result) {
                set_product(result);

                var height = Number($('#product_height').val());
                var width = Number($('#product_width').val());
                if (width > 0 && height > 0) {
                    calculate_price();
                }
            });
        });

        function addon_selectboxes(selectbox_id, mul) {
            var options = '';
            options += '<option value="0" >NO</option>';
            options += '<option value="' + mul + '">YES</option>';
            $('#' + selectbox_id).html(options);
        }

        function set_selectbox(selectbox_id) {
            var options = '';
            options += '<option value="1">Single Sided</option>';
            options += '<option value="2">Double Sided</option>';
            $('#' + selectbox_id).html(options);
        }

        function set_gloss_percent(selectbox_id, gloss_80, gloss_100_paint, gloss_100_acrylic_lacquer) {
            var options = '';
            options += '<option value="0">No Gloss</option>';
            options += '<option value="' + gloss_80 + '">80% Gloss - Add on / Sqm (1 sided)</option>';
            options += '<option value="' + gloss_100_paint + '">100% Gloss / Wet Look PU Paint (SQM)</option>';
            options += '<option value="' + gloss_100_acrylic_lacquer +
                '">100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)</option>';

            $('#' + selectbox_id).html(options);
        }

        function set_single_selectbox(selectbox_id, mul) {
            var options = '';
            options += '<option value="' + mul + '">YES</option>';
            $('#' + selectbox_id).html(options);
        }

        //set product data
        function set_product(row) {
            var type = row.type;
            $('#type').val(type);

            if (type == 'full_wood') {
                addon_selectboxes('gloss_100_acrylic_lacquer', row.gloss_100_acrylic_lacquer);
                set_gloss_percent('gloss_percentage', 0, 0, 0);
            }
            if (type == 'full_paint') {
                addon_selectboxes('gloss_100_acrylic_lacquer', 0);
                set_gloss_percent('gloss_percentage', row.gloss_80, row.gloss_100_paint, row.gloss_100_acrylic_lacquer);
            }
            if (type == 'standard' || type== 'basic') {
                addon_selectboxes('gloss_100_acrylic_lacquer', 0);
                set_gloss_percent('gloss_percentage',  0, 0, 0);
            }

            addon_selectboxes('polyester', row.polyester_or_full_grain);
            addon_selectboxes('burnished_finish', row.burnished_finish);
            addon_selectboxes('barrier_coat', row.barrier_coat);
            addon_selectboxes('edgebanding', row.edgebanding);
            addon_selectboxes('micro_bevel', row.micro_bevel);
            addon_selectboxes('routed_handle_spraying', row.routed_handle_spraying);
            addon_selectboxes('beaded_door', row.beaded_door);
            addon_selectboxes('wood_stain', row.wood_stain);
            addon_selectboxes('metallic_paint', row.metallic_paint);

            set_selectbox('matt_finish_option');
            $('#matt_finish').val(row.matt_finish);

            set_single_selectbox('spraying_edges', row.spraying_edges);

            $('#product_note').text(row.product_note);

            var net_price = row.sale_net_sqm;
            $('#pro_price').val(net_price);

            if (type == 'standard' || type == 'basic') {
                $('.full_paint, .full_wood').hide();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(row.min_sqm);
                    $('#db_sqm').val(row.min_sqm);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_paint') {
                $('.full_wood').hide();
                $('.full_paint').show();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(row.min_sqm);
                    $('#db_sqm').val(row.min_sqm);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_wood') {
                $('.full_paint').hide();
                $('.full_wood').show();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(row.min_sqm);
                    $('#db_sqm').val(row.min_sqm);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }

            if (type == 'basic') {
                $('.sqm, .width, .height').hide();
                $('#product_sqm').val(1);
                $('#db_sqm').val(1);
                $('#product_lm').val(1);
                calculate_price();
            }
        }

        //disabled remove from height attribute if width is given
        $('#product_width').on('keyup', function(event) {
            var val = $(this).val();
            console.log(val.length);
            if (val.length > 0) {
                $('#product_height').removeAttr('readonly');
            } else {
                $('#product_height').attr('readonly', 'disabled');
            }
        });
        

        //calculate sqm and lm
        $('#product_width, #product_height').on('keyup', function(event) {
            var height = $('#product_height').val();
            var width = $('#product_width').val();
            var min_sqm = $('#db_sqm').val();

            if (height.length > 0 && width.length > 0) {
                var mul = width * height;
                var sqm = mul / 1000000;

                if (sqm < min_sqm) {
                    $('#product_sqm').val(min_sqm);
                } else {
                    $('#product_sqm').val(sqm);
                }

                var lm = (2 * Number(height)) + (2 * Number(width));
                lm = lm / 1000;
                $('#product_lm').val(lm);
                //alert(lm);

            } else {
                $('#product_sqm').val(min_sqm);
                $('#product_lm').val(1);
            }
        });

        $('#guest_price, #guest_quantity, #guest_discount').on('keyup', function(event) {
            calculate_guest_gross();
        });

        $('#quantity, #net_price, #trade_discount').on('keyup', function(event) {
            calculate_gross();
        });

        $('#product_height').on('keyup', function() {
            calculate_price();
        });

        $('#product_width').on('keyup', function() {
            var height = $('#product_height').val();
            if (height != '' && height > 0) {
                calculate_price();
            }
        });

        $('#matt_finish_option, #spraying_edges, #metallic_paint, #wood_stain, #gloss_percentage, #gloss_100_acrylic_lacquer, #polyester, #burnished_finish, #barrier_coat, #edgebanding, #routed_handle_spraying, #beaded_door, #micro_bevel')
            .on('keyup keydown change', function() {
                calculate_price();
            });


        function calculate_price() {
            if ($('#code_id').val() != '') {
                var total = 0;

                // product price per sqm
                var height = $('#product_height').val();
                var width = $('#product_width').val();
                var mul = width * height;
                var input_sqm = mul / 1000000;
                var calculated_sqm = mul / 1000000;
                var db_sqm = Number($('#db_sqm').val());

                var min_sqm = Number($('#db_sqm').val());
                if ($('#matt_finish_option').val() == 1) {
                    if(input_sqm < min_sqm ) {
                        input_sqm = min_sqm;
                        $('#product_sqm').val(min_sqm);
                    }
                    else {
                        $('#product_sqm').val(input_sqm);
                    }
                }
                else if ($('#matt_finish_option').val() == 2) {
                    var temp = input_sqm * 2;
                    if (temp > min_sqm){
                        input_sqm = temp;
                    }
                    else {
                        input_sqm = min_sqm;
                    }
                    $('#product_sqm').val(input_sqm);
                }

                var product_sqm = $('#product_sqm').val();
                var sqm_product = Number($('#pro_price').val());

                /*if ($('#matt_finish_option').val() == 2) {
                    var sqm_price = input_sqm * sqm_product * 2;
                    $('#product_price').val(sqm_price);
                    total += sqm_price;
                } else {
                    var sqm_price = input_sqm * sqm_product;
                    $('#product_price').val(sqm_price);
                    total += sqm_price;
                }*/

                var sqm_price = input_sqm * sqm_product;
                $('#product_price').val(sqm_price);
                var type = $('#type').val();
                if (type == 'basic' || type == 'standard'){
                    total += sqm_price;
                } 

                $(' #metallic_paint, #wood_stain, #gloss_percentage, #gloss_100_acrylic_lacquer, #polyester, #burnished_finish, #barrier_coat')
                    .each(function() {

                        if ($('#matt_finish_option').val() == 2) {
                            var temp = calculated_sqm * 2;
                            if(temp > product_sqm) {
                                var value = Number($(this).val()) * temp;
                                total += value;
                            }
                            else {
                                var value = Number($(this).val()) * input_sqm;
                                total += value;
                            }
                        } else {
                            var value = Number($(this).val()) * input_sqm;
                            total += value;
                        }
                    });

                $('#matt_finish_option').each(function() {

                    if ($('#matt_finish_option').val() == 2) {
                        var temp = calculated_sqm * 2;
                        if(temp > product_sqm) {
                            var matt_finish = Number($('#matt_finish').val()) * temp;
                            total += matt_finish;
                        }
                        else {
                            var matt_finish = Number($('#matt_finish').val()) * input_sqm;
                            total += matt_finish;
                        }
                    }
                    else {
                        var matt_finish = Number($('#matt_finish').val()) * input_sqm;
                        total += matt_finish;
                    }
                });


                /*if ($('#matt_finish_option').val() == 2) {
                    var temp = calculated_sqm * 2;
                    if(temp > product_sqm) {
                        var matt_finish = Number($('#matt_finish').val()) * input_sqm * 2;
                        total += matt_finish;
                    }
                    else {
                        var matt_finish = Number($('#matt_finish').val()) * input_sqm;
                        total += matt_finish;
                    }
                }
                else {
                    var matt_finish = Number($('#matt_finish').val()) * input_sqm;
                    total += matt_finish;
                }*/
                

                var lm = Number($('#product_lm').val());
                $('#spraying_edges, #edgebanding, #beaded_door, #micro_bevel')
                    .each(function() {
                        var value = Number($(this).val()) * lm;
                        total += value;
                    });

                var routed_handle_spraying = Number($('#routed_handle_spraying').val());
                total += routed_handle_spraying;

                $('#net_price').val(total.toFixed(2));
                $('#basic_net').val(total.toFixed(2));

                calculate_gross();
            }
        }

        function calculate_gross() {
            var quantity = Number($('#quantity').val());
            var basic_net = Number($('#basic_net').val());
            var discount = Number($('#trade_discount').val());

            var net = Number(quantity * basic_net);
            $('#net_price').val(net.toFixed(2));

            var vat = (20 * net) / 100;
            $('#vat').val(vat.toFixed(2));

            var gross = net + vat;

            var net_discount = (discount * gross) / 100;

            var total_gross = gross - net_discount;

            $('#total_gross').val(total_gross.toFixed(2));
        }

        function calculate_guest_gross() {
            var quantity = Number($('#guest_quantity').val());
            var basic_net = Number($('#guest_price').val());
            var discount = Number($('#guest_discount').val());

            var net = Number(quantity * basic_net);
            var vat = (20 * net) / 100;
            var gross = net + vat;

            var net_discount = (discount * gross) / 100;
            var total_gross = gross - net_discount;

            var net_discount1 = (discount * net) / 100;
            var total_net = net - net_discount1;

            var vat_discount = (discount * vat) / 100;
            var total_vat = vat - vat_discount;

            $('#guest_net_price').val(total_net.toFixed(2));
            $('#guest_vat').val(total_vat.toFixed(2));
            $('#guest_total_price').val(total_gross.toFixed(2));
        }

        $('#gloss_percentage').on('change', function() {
            // alert(this.html());
            var selected_gross = $('#gloss_percentage option:selected').text();
            if (selected_gross == "80% Gloss - Add on / Sqm (1 sided)") {
                $('#gloss_percentage_option').val(1);
            } else if (selected_gross == "100% Gloss / Wet Look PU Paint (SQM)") {
                $('#gloss_percentage_option').val(2);
            } else if (selected_gross == "100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)") {
                $('#gloss_percentage_option').val(3);
            } else {
                $('#gloss_percentage_option').val(0);
            }
        });

        //hidden price for quote
        $('#hidden_option').on('change', function() {
            var hidden_option =this.value;
                //alert(hidden_option);
            hidden_option = hidden_option.split("/");

            var quote_option = hidden_option[0];
            var quote_id = hidden_option[1];
            //alert('quote option :'+quote_option+ ' qute_id:'+quote_id);
            $.ajax({
                type: "GET",
                url: " {{route('hidden.option')}}",
                data: {quote_option: quote_option, quote_id: quote_id},
                success: function (data) {
                    //console.log(data);
                    // console.log('ok')
                }

            });
        });
    </script>
@endsection