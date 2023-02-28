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
                        <div class="col-12">
                            <h3>Create A Quote</h3>
                        </div>
                    </div>

                    <!----------------------------------- Customer Info -------------------------------------->
                    <div class="row customer-info">
                        <div class="col-12">
                            <h4>Customer Info</h4>
                        </div>
                        <div class="col-12 col-md-8">
                            <select class="form-select" id="clients" onchange="client_info()"></select>
                        {{-- <select class="form-select" onchange="client_info()" id="clients">
                                <option value="">-- Select Customer --</option>
                                @foreach ($data as $client)
                                    <option value='{{ $client->id }}'>{{ $client->name }}
                                    </option>
                                @endforeach
                            </select>--}}
                        </div> 
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
                                    placeholder="Enter Name" value="" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust_phone">Telephone</label>
                                <input id="cust_phone" name="cust-phone" class="form-control" type="number"
                                    placeholder="Enter Number" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-email">Email</label>
                                <input id="cust_email" name="cust-email" class="form-control" type="email"
                                    placeholder="Enter Email" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-postcode">Billing Postcode</label>
                                <input id="cust_postcode" name="cust-postcode" class="form-control" type="text"
                                    placeholder="Postcode" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cust-address">Address</label>
                                <textarea id="cust_address" class="form-control" rows="3" placeholder="Enter Address" readonly=""></textarea>
                            </div>
                        </div>
                    </div>
                    <!----------------------------------- End Customer Info -------------------------------------->

                    <!----------------------------------- Add Products -------------------------------------->
                    <div class="row add-product">
                        <div class="col-12">
                            <h4>Add Product</h4>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="code_id">Code</label>
                                        <select name="code_id" id="code_id" class="form-control" data-live-search="true"
                                            tabindex="-1" aria-hidden="true">
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
                                        <select name="product_id" id="product_id" class="form-control"
                                            data-live-search="true" tabindex="-1" aria-hidden="true">
                                            <option value=""> -- Select One --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 width">
                                    <div class="form-group">
                                        <label for="network_preferences">Width</label>
                                        <input id="prod-width" name="width" class="form-control" type="number"
                                            placeholder=" ">
                                    </div>
                                    @if ($errors->has('width'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $errors->first('width') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2 height">
                                    <div class="form-group">
                                        <label for="network_preferences">Height</label>
                                        <input id="prod-height" name="height" class="form-control" type="number"
                                            placeholder=" " disabled>
                                        @if ($errors->has('height'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $errors->first('height') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-2 sqm">
                                    <div class="form-group">
                                        <label for="prod-sqm">SQM</label>
                                        <input id="prod-sqm" name="sqm" class="form-control" type="number"
                                            placeholder=" " readonly>
                                        <input id="pro-price" class="form-control" type="hidden" placeholder=" ">
                                        <input id="product_price" name="product_price" class="form-control"
                                            type="hidden" placeholder=" ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- first row in quote for paint --}}
                        <section class="row " id="row_paint">
                            <div class="row ">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_matt_finish">Rate / Sqm (1 sided) - Matt Finish</label>
                                        <select name="paint_matt_finish" id="paint_matt_finish" class="form-control "
                                            data-live-search="true" tabindex="-1" aria-hidden="true">
                                            <option value="0">
                                                -- select option --
                                            </option>
                                            <option value="65">
                                                Single Side
                                            </option>
                                            <option value="130">
                                                Double Side
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_spraying_edges">Spraying Edges - Rate per L/M</label>
                                        <select name="paint_spraying_edges" id="paint_spraying_edges"
                                            class="form-control ">
                                            <option value="5">
                                                Yes
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_metallic_paint">Metallic Paint - Add on / Sqm (1 sided)s</label>
                                        <select name="paint_metallic_paint" id="paint_metallic_paint"
                                            class="form-control ">
                                            <option value="0" selected>
                                                -- select option --
                                            </option>
                                            <option value="5">
                                                Single Side
                                            </option>
                                            <option value="10">
                                                Double Side
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_80_Gloss">80% Gloss - Add on / Sqm (1 sided)</label>
                                        <select name="paint_80_Gloss" id="paint_80_Gloss" class="form-select">
                                            <option value="0" selected>
                                                -- select option --
                                            </option>
                                            <option value="10">Single Side</option>
                                            <option value="20">Double Side</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_100_Gloss">100% Gloss / Wet Look PU Paint (SQM)</label>
                                        <select name="paint_100_Gloss" id="paint_100_Gloss" class="form-select">
                                            <option value="0">No</option>
                                            <option value="30">Yes</option>
                                            {{-- <option value="60">Double Side</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="paint_100_Gloss2">100% Gloss / Wet Look Clear Acrylic Lacquer
                                            (SQM)</label>
                                        <select name="paint_100_Gloss2" id="paint_100_Gloss2" class="form-select">
                                            <option value="0" selected>No</option>
                                            <option value="45">Yes</option>
                                            {{-- <option value="60">Double Side</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 finish ">
                                <div class="form-group">
                                    <label for="burnished_finish">Burnished Finish (SQM)</label>
                                    <select name="burnished_finish" id="burnished_finish" class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="100">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 finish ">
                                <div class="form-group">
                                    <label for="paint_edgebanding_rate">Edgebanding - Rate Per L/M</label>
                                    <select name="paint_edgebanding_rate" id="paint_edgebanding_rate"
                                        class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="6">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 shape ">
                                <div class="form-group">
                                    <label for="paint_micro_bevel">Micro bevel - Rate Per L/M</label>
                                    <select name="paint_micro_bevel" id="paint_micro_bevel" class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="4">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 sand ">
                                <div class="form-group">
                                    <label for="paint_routed_j">Routed / J Handle Spraying</label>
                                    <select name="paint_routed_j" id="paint_routed_j" class="form-control ">
                                        <option value="0" selected>
                                            No
                                        </option>
                                        <option value="15">
                                            yes
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 ritecs ">
                                <div class="form-group">
                                    <label for="paint_beaded_door">Beaded Door - Rate Per L/M</label>
                                    <select name="paint_beaded_door" id="paint_beaded_door" class="form-control ">
                                        <option value="0" selected>
                                            No
                                        </option>
                                        <option value="14">
                                            Yes
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </section>
                        {{-- first row in qoute for wood --}}
                        <section class="row " id="row_wood">
                            <div class="row row1_wood">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="wood_matt_finish">Rate / Sqm (1 sided) - Matt Finish</label>
                                        <select name="wood_matt_finish" id="wood_matt_finish" class="form-control "
                                            data-live-search="true" tabindex="-1" aria-hidden="true">
                                            <option value="40">
                                                Single Side
                                            </option>
                                            <option value="80">
                                                Double Side
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="wood_spraying_edges">Spraying Edges - Rate per L/M</label>
                                        <select name="wood_spraying_edges" id="wood_spraying_edges"
                                            class="form-control ">
                                            <option value="3">
                                                Yes
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="wood_stain">Wood stain - Add on / Sqm (1 sided)s</label>
                                        <select name="wood_stain" id="wood_stain" class="form-control ">
                                            <option value="25">
                                                Single Side
                                            </option>
                                            <option value="50">
                                                Double Side
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="wood_100_Gloss_acrylic_lacquer">100% Gloss / Wet Look Clear Acrylic
                                            Lacquer (SQM)</label>
                                        <select name="wood_100_Gloss_acrylic_lacquer" id="wood_100_Gloss_acrylic_lacquer"
                                            class="form-select">
                                            <option value="0">No</option>
                                            <option value="40">yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="wood_polyester">Polyester / Full Grain (SQM)</label>
                                        <select name="wood_polyester" id="wood_polyester" class="form-select">
                                            <option value="0">No</option>
                                            <option value="100">Yes</option>
                                            {{-- <option value="60">Double Side</option> --}}
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-2 finish">
                                <div class="form-group">
                                    <label for="wood_burnished">Burnished Finish (SQM)</label>
                                    <select name="wood_burnished" id="wood_burnished" class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="70">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 finish">
                                <div class="form-group">
                                    <label for="barrier_coat">Barrier Coat (SQM)</label>
                                    <select name="barrier_coat" id="barrier_coat" class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="70">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 shape">
                                <div class="form-group">
                                    <label for="wood_dgebanding_rate">Edgebanding - Rate Per L/M</label>
                                    <select name="micro_bevel" id="micro_bevel" class="form-control ">
                                        <option value="0" selected>No</option>
                                        <option value="7.5">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 sand">
                                <div class="form-group">
                                    <label for="wood_routed_j">Routed / J Handle Spraying</label>
                                    <select name="wood_routed_j" id="wood_routed_j" class="form-control ">
                                        <option value="0" selected>
                                            No
                                        </option>
                                        <option value="10">
                                            yes
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2 ritecs">
                                <div class="form-group">
                                    <label for="wood_beaded_door">Beaded Door - Rate Per L/M</label>
                                    <select name="wood_beaded_door" id="wood_beaded_door" class="form-control ">
                                        <option value="0" selected>
                                            No
                                        </option>
                                        <option value="10">
                                            Yes
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </section>
                        <div class="col-sm-2 bevel_edges ">
                            <div class="form-group">
                                <label for="bevel_edges">Bevel Edges</label>
                                <select name="bevel_edges" id="bevel_edges" class="form-control ">
                                    <option value="">
                                        Yes
                                    </option>
                                    <option value="">
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" name="quantity" class="form-control" type="number"
                                    placeholder="Please enter quantity" min="1" value="1" step="1">
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="data_volumn">Net Price</label>
                                <input id="net_price" name="net_price" class="form-control" type="number"
                                    placeholder=" " step="any" readonly>
                                <input type="hidden" id="basic_net">
                                @if ($errors->has('net_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('net_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="data_volumn">VAT</label>
                                <input id="vat" name="vat" class="form-control" type="number"
                                    placeholder=" " step="any" readonly>
                                @if ($errors->has('vat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('vat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="trade_discount">Trade_discount (%)</label>
                                <input id="trade_discount" name="trade_discount" class="form-control" type="number"
                                    placeholder=" " value="" min='0'>
                                @if ($errors->has('trade_discount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('trade_discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="data_volumn">Gross Total</label>
                                <input id="total_gross" name="total_gross" class="form-control" type="number"
                                    placeholder=" " step="any" readonly>
                                @if ($errors->has('total_gross'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('total_gross') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="product_note">Note</label>
                        <textarea id="product_note" class="form-control" rows="5" placeholder="" readonly></textarea>
                        @if ($errors->has('product_note'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('product_note') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="note">Product Note</label>
                        <textarea id="note" name="note" class="form-control" rows="5" placeholder="Please Add Product Note"></textarea>
                        @if ($errors->has('note'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('note') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <!----------------------------------- End Add Products -------------------------------------->

            <!----------------------------------- Delivery Options -------------------------------------->
            <div class="row delivery-options">
                <div class="col-12">
                    <h4>Delivery Options</h4>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="delivery-distance">Distance From Our Location (In Miles)</label>
                        <input id="delivery-distance" name="delivery-distance" class="form-control" type="text"
                            placeholder="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea id="comment" class="form-control" rows="3" placeholder=""></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="internal-comment">Internal comment</label>
                        <textarea id="internal-comment" class="form-control" rows="3" placeholder=""></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary-rounded">
                        Add another item <span><i class="fa fa-save"></i></span>
                    </button>
                </div>
            </div>
            <!----------------------------------- End Delivery Options -------------------------------------->
        </div>
    </div>
    <div class="text-center my-5">Please Filled the Billing Postcode field first and click the search button for
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
                                    <select name="trade_discount" id="trade_discount" class="form-select">
                                        <option value="0">-- Select One --</option>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>
                                        <option value="15">15%</option>
                                        <option value="20">20%</option>
                                        <option value="25">25%</option>
                                        <option value="30">30%</option>
                                        <option value="35">35%</option>
                                        <option value="40">40%</option>
                                        <option value="45">45%</option>
                                        <option value="50">50%</option>
                                    </select>
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
                        <button class="btn-primary" type="submit" id="add">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----------------------- End Add Customer Modal ------------------------------->

@endsection
@section('scripts')
    <script>
        var total = 0;

        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "{{ route('allclient') }}",
                success: function(response) {
                    console.log(response.client);
                    $("#clients").html(response.client);
                }
            });
        });

        function client_info() {
            var selectElement = document.querySelector('.form-select');
            var selectedValue = selectElement.value;
            // alert(selectedValue);
            $.ajax({
                type: "get",
                url: "{{ route('clientinfo') }}/" + selectedValue,
                success: function(response) {
                    console.log(response.client);
                    $("#client_data").html(response.client);
                    $('#cust_name').val(response.client.name);
                    $('#cust_phone').val(response.client.phone);
                    $('#cust_email').val(response.client.email);
                    $('#cust_postcode').val(response.client.postal_code);
                    $('#cust_address').val(response.client.address);
                    $('#trade_discount').val(response.client.trade_discount);
                }
            });
        }

        //client insert data
        $("#add_client_form").on('submit', function (event) {
            event.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
                    
                    $('#addcustomer').modal('hide');
                    $('.fade').hide();

                    $('#clients').val(data.id);
                    $('#cust_name').val(data.name);
                    $('#cust_phone').val(data.phone);
                    $('#cust_email').val(data.email);
                    $('#cust_postcode').val(data.postal_code);
                    $('#cust_address').val(data.address);
                    $('#trade_discount').val(data.trade_discount);
                    //$('#delivery_distance').val(distance);
                },
                error: function (data) {
                    console.log("Error");
                    var errors = '';
                    $.each(data.responseJSON.errors, function (key, value) {
                        errors += value + '<br />';
                    });
                    $('#errors').html(errors);
                }
            });
        });

       

        function addon_selectboxes(selectbox_id, mul) {
            var options = '';
            options += '<option value="0">NO</option>';
            options += '<option value="' + mul + '">YES</option>';
            $('#' + selectbox_id).html(options);
        }


        function set_selectbox(selectbox_id, mul) {
            var options = '';
            var loop = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
            $.each(loop, function(index, value) {
                options += '<option value="' + (value * mul) + '">' + value + '</option>';
            });
            $('#' + selectbox_id).html(options);

        }

        function set_form(row) {

            var options = '';
            options += '<option id="clear" value="0">Clear</option>';
            options += '<option id="paint" value="' + row.painted + '">Painted</option>';
            options += '<option id="print" value="' + row.printed + '">Printed</option>';
            $('#back_select').html(options);

            // painted option

            var option = '';
            option += '<option value="0">Select option</option>';
            option += '<option value="' + row.sparkle_finish + '">Sparkle Finish</option>';
            option += '<option value="' + row.metallic_finish + '">Mettalic Finish</option>';
            $('#painted_option').html(option);

            // display sparkle and metallic finish
            $('#back_select, #code_id, #product_id').each(function() {
                if ($('#back_select').val() == row.painted || row.type != 'non_glass') {
                    $('.width, .height, .sqm, .back, .finish').show();


                    // $('#quantity').show();
                    // $('#qty').hide();

                    $('#quantity, #trade_discount').show();
                    $('#qty, #trade_discount1').hide();
                    //                    $('#net_price1').val('');

                } else if (row.type == "non_glass" && $('#qty').val() == 1) {

                    // $('#quantity').hide();
                    // $('#qty').show();

                    $('#quantity, #trade_discount').hide();
                    $('#qty, #trade_discount1').show();

                    $('.width, .height,.sqm').hide();
                    var net_price = row.sale_net_sqm;

                    var qty = $('#quantity').val();

                    var net = qty * net_price;
                    $('#net_price').val(net);

                    var vat = (20 * net) / 100;
                    $('#vat').val(vat);

                    var gross = net + vat;


                    // var discount = $('#trade_discount').val();
                    var discount = $('#trade_discount1').val();



                    var net_discount = (discount * gross) / 100;


                    var total_gross = gross - net_discount;
                    $('#total_gross').val(total_gross.toFixed(2));

                    if (row.type == 'non_glass') {

                        // $('#qty').show();
                        // $('#quantity').hide();
                        $('#qty, #trade_discount1').show();
                        $('#quantity, #trade_discount').hide();

                        var back = '';
                        back += '<option value="0">Painted</option>';
                        back += '<option value="0">Printed</option>';
                        $('#back_select').html(back);
                        $('.back').hide();

                    }

                }
                $(".finish").hide();
                if (row.type == 'non_featured' || row.type == 'partial_featured') {

                    // $('#qty').hide();
                    // $('#quantity').show();
                    $('#qty, #trade_discount1').hide();
                    $('#quantity, #trade_discount').show();

                    var back = '';
                    back += '<option id="clear" value="0" selected="selected">Clear</option>';
                    back += '<option value="0">Painted</option>';
                    back += '<option value="0">Printed</option>';
                    $('#back_select').html(back);
                    $('.back').hide();

                }
                if ($('#qty') && row.type == 'non_glass') {

                    $('#qty, #trade_discount1').on('keyup.qty, keyup.trade_discount', function(e) {
                        // $('#quantity').hide();
                        // $('#qty').show();
                        $('#quantity, #trade_discount').hide();
                        $('#qty, #trade_discount1').show();
                        var net_price = row.sale_net_sqm;

                        var qty = $('#qty').val();

                        var net = qty * net_price;
                        $('#net_price').val(net);


                        var vat = (20 * net) / 100;
                        $('#vat').val(vat);

                        var gross = net + vat;

                        // var discount = $('#trade_discount').val();
                        var discount = $('#trade_discount1').val();


                        var net_discount = (discount * gross) / 100;


                        var total_gross = gross - net_discount;
                        $('#total_gross').val(total_gross.toFixed(2));


                    });
                }
            });

            //for non featured products
            if (row.type == 'non_featured') {

                set_selectbox('cutout', 0);
                set_selectbox('notch', 0);
                set_selectbox('hole', 0);
                set_selectbox('rake', 0);
                set_selectbox('radius_corners', 0);
                $('.cut, .notches, .holes, .rake, .radius_corners').hide();

                addon_selectboxes('cnc', 0);
                addon_selectboxes('sandblasted', 0);
                addon_selectboxes('ritec', 0);
                addon_selectboxes('bevel_edges', 0);
                $('.shape, .sand, .ritecs, .bevel_edges').hide();

            } else {
                $('.cut, .notches, .holes, .rake, .radius_corners, .shape, .sand, .ritecs, .bevel_edges').show();
                set_selectbox('cutout', row.cut_out);
                set_selectbox('notch', row.notch);
                set_selectbox('hole', row.hole);
                set_selectbox('rake', row.rake);
                set_selectbox('radius_corners', row.radius_corners);

                addon_selectboxes('cnc', row.cnc);
                addon_selectboxes('sandblasted', row.standblasted);
                addon_selectboxes('ritec', row.ritec);
                addon_selectboxes('bevel_edges', row.bevel_edges);

            }
            if (row.type == 'non_glass') {

                // $('#qty').show();
                // $('#quantity').hide();
                $('#qty, #trade_discount1').show();
                $('#quantity, #trade_discount').hide();

                set_selectbox('cutout', 0);
                set_selectbox('notch', 0);
                set_selectbox('hole', 0);
                set_selectbox('rake', 0);
                set_selectbox('radius_corners', 0);
                $('.cut, .notches, .holes, .rake, .radius_corners, .width, .height, .sqm, .back').hide();

                addon_selectboxes('cnc', 0);
                addon_selectboxes('sandblasted', 0);
                addon_selectboxes('ritec', 0);
                addon_selectboxes('bevel_edges', 0);
                $('.shape, .sand, .ritecs, .bevel_edges').hide();

            }
            var net_price = row.sale_net_sqm;
            $('#pro-price').val(net_price);
        }

        function calculate_gross() {

            var quantity = Number($('#quantity').val());
            var basic_net = Number($('#basic_net').val());
            //console.log('basic net:' + basic_net);
            var discount = 0;


            var net = Number(quantity * basic_net);

            $('#net_price').val(net.toFixed(2));


            var vat = (20 * net) / 100;
            $('#vat').val(vat.toFixed(2));


            var gross = net + vat;


            var net_discount = (discount * gross) / 100;

            var total_gross = gross - net_discount;

            $('#total_gross').val(total_gross.toFixed(2));

        }

        function calculate_price() {
            var total = 0;
            $('#cutout, #notch, #hole, #rake, #radius_corners, #cnc').each(function() {
                total += Number($(this).val());
            });

            // product price per sqm
            var input_sqm = Number($('#prod-sqm').val());
            if (input_sqm < 0.25) {
                input_sqm = 0.25;
            }
            $('#prod-sqm').val(input_sqm.toFixed(2));
            alert($('#pro-price').val());
            var sqm_product = $('#pro-price').val();

            var sqm_price = input_sqm * sqm_product;

            var pro_discount = Number($('#trade_discount').val());

            pro_discount = (pro_discount * sqm_price) / 100;

            sqm_price = sqm_price - pro_discount;


            $('#product_price').val(sqm_price.toFixed(2));

            //back per sqm
            var back = $('#back_select').val();
            var back_per_sqm = back * input_sqm;

            //finish per sqm
            var finish = $('#painted_option').val();

            var myOption = $("#back_select option:selected").attr("id");

            if (myOption == 'paint') {

                var finish_per_sqm = finish * input_sqm;
                $('.finish').show();
            }
            if (myOption == 'print' | myOption == 'clear') {
                var finish_per_sqm = 0 * input_sqm;
                $('.finish').hide();
            }

            //standblasted per sqm
            var stand = $('#sandblasted').val();
            var stand_per_sqm = stand * input_sqm;

            //ritec per sqm
            var retic = $('#ritec').val();
            var retic_per_sqm = retic * input_sqm;

            //bevel edges per sqm
            var bevel_edges = $('#bevel_edges').val();
            var bevel_edges_cal = bevel_edges * input_sqm;
            var bevel_edges_per_sqm = bevel_edges_cal * 4;

            total += sqm_price + back_per_sqm + stand_per_sqm + bevel_edges_per_sqm + retic_per_sqm + finish_per_sqm;

            $('#net_price').val(total.toFixed(2));
            $('#basic_net').val(total.toFixed(2));


            calculate_gross();

        }
        $(document).ready(function(e) {
            //
            //get product details
            $("#row_wood").hide();
            $("#code_id, #product_id").change(function() {
                var product_info = $('#code_id, #product_id, #notch, #hole');
                var val = $(this).val();
                var id = $(this).attr('id');
                if (id == 'code_id') {
                    $('#product_id').val(val);
                } else {
                    $('#code_id').val(val);
                }
                //This is simple Get ajax request
                var url = '{{ route('product_info') }}' + '/' + val;
                $.get(url, function(result) {
                    console.log(result.product_type);
                    // alert(result.product_type);
                    if (result.product_type == "full_paint" || result.product_type == "basic" ||
                        result.product_type == "standard") {
                        total += 5;
                        $("#row_wood").hide();
                        $("#row_paint").show();
                    } else {
                        total += 3;
                        $("#row_paint").hide();
                        $("#row_wood").show();
                    }
                });

                var height = Number($('#prod-height').val());
                var width = Number($('#prod-width').val());
                if (width > 0 && height > 0) {
                    calculate_price();

                }
            });
            //disabled remove from height attribute if width is given
            $('#prod-width').on('keyup', function(event) {
                var val = $(this).val();

                if (val.length > 0) {
                    $('#prod-height').removeAttr('disabled');
                } else {
                    $('#prod-height').attr('disabled', 'disabled');
                }
            });
            $('#prod-width, #prod-height').on('keyup', function(event) {
                // alert("call 1");
                var height = $('#prod-height').val();
                var width = $('#prod-width').val();
                if (height.length > 0 && width.length > 0) {
                    var mul = width * height;
                    var sqm = mul / 1000000;

                    if (sqm < 0.25) {
                        sqm = 0.25;
                    }
                    $('#prod-sqm').val(sqm);
                    // $('#prod-sqm').val(sqm);
                    calculate_price();
                }
            });

            // $('#paint_matt_finish', function() {
            //     alert("here");
            //     // calculate_price();
            // });
            //
        });
        $('#paint_matt_finish').on('change', function() {
            var paint_finish = parseInt($("#paint_matt_finish").val());
            if (paint_finish == "130") {
                alert("inside if");
                total += 130;
            } else if (paint_finish == "65") {
                alert("inside else");
                total += 65;
            }
        });
        $(' #paint_metallic_paint').on('change', function() {
            var paint_metallic_paint = parseInt($(" #paint_metallic_paint").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_metallic_paint == "10") {
                total += 10;
            } else if (paint_metallic_paint == "5") {
                total += 5;
            }
        });
        $(' #paint_80_Gloss').on('change', function() {
            var paint_80_Gloss = parseInt($(" #paint_80_Gloss").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_80_Gloss == "20") {
                total += 20;
            } else if (paint_80_Gloss == "10") {
                total += 10;
            }
            alert(total);
        });
        $(' #paint_100_Gloss').on('change', function() {
            var paint_100_Gloss = parseInt($(" #paint_100_Gloss").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_100_Gloss == "30") {
                total += 30;
            } else if (paint_100_Gloss == "0") {
                total -= 30;
            }
        });
        $(' #paint_100_Gloss2').on('change', function() {
            var paint_100_Gloss2 = parseInt($(" #paint_100_Gloss2").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_100_Gloss2 == "45") {
                total += 45;
            } else if (paint_100_Gloss2 == "0") {
                total -= 45;
            }
        });
        $(' #burnished_finish').on('change', function() {
            var burnished_finish = parseInt($(" #burnished_finish").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (burnished_finish == "100") {
                total += 100;
            } else if (burnished_finish == "0") {
                total -= 100;
            }
        });
        $(' #paint_edgebanding_rate').on('change', function() {
            var paint_edgebanding_rate = parseInt($(" #paint_edgebanding_rate").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_edgebanding_rate == "6") {
                total += 6;
            } else if (paint_edgebanding_rate == "0") {
                total -= 6;
            }
        });
        $(' #paint_micro_bevel').on('change', function() {
            var paint_micro_bevel = parseInt($(" #paint_micro_bevel").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_micro_bevel == "4") {
                total += 4;
            } else if (paint_micro_bevel == "0") {
                total -= 4;
            }
        });
        $(' #paint_routed_j').on('change', function() {
            var paint_routed_j = parseInt($(" #paint_routed_j").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_routed_j == "15") {
                total += 15;
            } else if (paint_routed_j == "0") {
                total -= 5;
            }
        });
        $(' #paint_beaded_door').on('change', function() {
            var paint_beaded_door = parseInt($(" #paint_beaded_door").val());
            // paint_metallic_paint
            // total += paint_edges;
            if (paint_beaded_door == "14") {
                total += 14;
            } else if (paint_beaded_door == "0") {
                total -= 14;
            }
        });
    </script>
@endsection
