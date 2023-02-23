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

                    <form action="" class="form-light" method="post">
                        <!----------------------------------- Customer Info -------------------------------------->
                        <div class="row customer-info">
                            <div class="col-12">
                                <h4>Customer Info</h4>
                            </div>
                            <div class="col-12 col-md-8">
                                <select class="form-select" id="clients">
                                </select>
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
                                    <input id="cust_name" name="cust_name" class="form-control" type="text"
                                        placeholder="Enter Name" value="" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust_phone">Telephone</label>
                                    <input id="cust_phone" name="cust_phone" class="form-control" type="number"
                                        placeholder="Enter Number" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust_email">Email</label>
                                    <input id="cust_email" name="cust_email" class="form-control" type="email"
                                        placeholder="Enter Email" readonly="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="cust_postcode">Billing Postcode</label>
                                    <input id="cust_postcode" name="cust_postcode" class="form-control" type="text"
                                        placeholder="Postcode" readonly="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="cust_address">Address</label>
                                    <textarea id="cust_address" name="cust_address" class="form-control" rows="3" placeholder="Enter Address" readonly=""></textarea>
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
                                            <label for="product-code">Code</label>
                                            <select name="code_id" id="code_id" class="form-select">
                                                <option value=""> -- Select One --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('code_id'))
                                                <strong class="text-danger">{{ $errors->first('code_id') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="products">Products</label>
                                            <select name="product_id" id="product_id" class="form-select">
                                                <option value=""> -- Select One --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('product_id'))
                                                <strong class="text-danger">{{ $errors->first('product_id') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="product_width">Width</label>
                                            <input id="product_width" name="width" class="form-control" type="number"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="product_height">Height</label>
                                            <input id="product_height" name="height" class="form-control" type="number"
                                                placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="product_sqm">SQM</label>
                                            <input id="product_sqm" name="sqm" class="form-control" type="number"
                                                placeholder="" readonly="">
                                            <input id="pro_price" class="form-control" type="hidden" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cost_from_supplier">Cost From Supplier</label>
                                            <input id="cost_from_supplier" name="cost_from_supplier" class="form-control" type="number" value="" placeholder="Enter Number">
                                            @if ($errors->any())
                                                @if ($errors->has('cost_from_supplier'))
                                                    <strong class="text-danger">{{ $errors->first('cost_from_supplier') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input id="price" name="price" class="form-control" type="number" value="" readonly>
                                            @if ($errors->any())
                                                @if ($errors->has('price'))
                                                    <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Rate / Sqm (1 sided) - Matt Finish</label>
                                            <input id="matt_finish" name="matt_finish" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('matt_finish'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('matt_finish') }}</strong>
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Min Charges</label>
                                            <input class="form-control" type="number" name="min_charges" id="min_charges" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('min_charges'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong class="text-danger">{{ $errors->first('min_charges') }}</strong>
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Spraying Edges - Rate per L/M</label>
                                            <input id="spraying_edges" name="spraying_edges" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('spraying_edges'))
                                                    <strong class="text-danger">{{ $errors->first('spraying_edges') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_paint">
                                        <div class="form-group">
                                            <label>Metallic Paint - Add on / Sqm (1 sided)</label>
                                            <input id="metallic_paint" name="metallic_paint" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('metallic_paint'))
                                                    <strong class="text-danger">{{ $errors->first('metallic_paint') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood">
                                        <div class="form-group">
                                            <label>Wood Stain - Add on / Sqm (1 sided)</label>
                                            <input id="wood_stain" name="wood_stain" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('wood_stain'))
                                                    <strong class="text-danger">{{ $errors->first('wood_stain') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_paint">
                                        <div class="form-group">
                                            <label>80% Gloss - Add on / Sqm (1 sided)</label>
                                            <input id="gloss_80" name="gloss_80" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('gloss_80'))
                                                    <strong class="text-danger">{{ $errors->first('gloss_80') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_paint">
                                        <div class="form-group">
                                            <label>100% Gloss / Wet Look PU Paint (SQM)</label>
                                            <input id="gloss_100_paint" name="gloss_100_paint" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('gloss_100_paint'))
                                                    <strong class="text-danger">{{ $errors->first('gloss_100_paint') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)</label>
                                            <input id="gloss_100_acrylic_lacquer" name="gloss_100_acrylic_lacquer" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('gloss_100_acrylic_lacquer'))
                                                    <strong class="text-danger">{{ $errors->first('gloss_100_acrylic_lacquer') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood">
                                        <div class="form-group">
                                            <label>Polyester / Full Grain (SQM)</label>
                                            <input id="polyester_or_full_grain" name="polyester_or_full_grain" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('polyester_or_full_grain'))
                                                    <strong class="text-danger">{{ $errors->first('polyester_or_full_grain') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood">
                                        <div class="form-group">
                                            <label>Burnished Finish (SQM)</label>
                                            <input id="burnished_finish" name="burnished_finish" class="form-control" type="number" placeholder="Enter Number" value="">
                                                @if ($errors->has('burnished_finish'))
                                                    <strong class="text-danger">{{ $errors->first('burnished_finish') }}</strong>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Edgebanding - Rate Per L/M</label>
                                            <input id="edgebanding" name="edgebanding" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('edgebanding'))
                                                    <strong class="text-danger">{{ $errors->first('edgebanding') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_paint">
                                        <div class="form-group">
                                            <label>Micro bevel - Rate Per L/M</label>
                                            <input id="micro_bevel" name="micro_bevel" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('micro_bevel'))
                                                    <strong class="text-danger">{{ $errors->first('micro_bevel') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Routed / J Handle  Spraying</label>
                                            <input id="routed_handle_spraying" name="routed_handle_spraying" class="form-control" type="number" placeholder="Enter Number" value="">
                                            @if ($errors->any())
                                                @if ($errors->has('routed_handle_spraying'))
                                                    <strong class="text-danger">{{ $errors->first('routed_handle_spraying') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Beaded Door - Rate Per L/M</label>
                                            <input id="beaded_door" name="beaded_door" class="form-control" type="number" placeholder="Enter Number" value="">

                                            @if ($errors->any())
                                                @if ($errors->has('beaded_door'))
                                                    <strong class="text-danger">{{ $errors->first('beaded_door') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
                                            <input type="hidden" id="basic_net" >
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
                                            <input id="trade_discount" name="trade_discount" class="form-control"
                                                type="number" placeholder="" value="" min="0">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="total_gross">Gross Total</label>
                                            <input id="total_gross" name="total_gross" class="form-control" type="number"
                                                placeholder="" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea id="note" class="form-control" rows="3" placeholder="" readonly=""></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product-note">Product Note</label>
                                    <textarea id="product-note" class="form-control" rows="3" placeholder="Please Add Product Note"></textarea>
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
                                    <input id="delivery-distance" name="delivery-distance" class="form-control"
                                        type="text" placeholder="">
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
                    </form>
                    <!----------------------------------- Customer Info -------------------------------------->
                    <div class="row customer-info">
                        <div class="col-12">
                            <h4>Customer Info</h4>
                        </div>
                        <div class="col-12 col-md-8">
                            <select class="form-select" onchange="client_info()">
                                @foreach ($data as $client)
                                    <option value='{{ $client->id }}'>{{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#addcustomer">
                                Add Customer <i class="fa fa-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-name">Name</label>
                                <input id="cust_name" name="cust-name" class="form-control" type="text"
                                    placeholder="Enter Name" value="" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-phone">Telephone</label>
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
                                        <label for="network_preferences">SQM</label>
                                        <input id="prod-sqm" name="sqm" class="form-control" type="number"
                                            placeholder=" " readonly>
                                        <input id="pro-price" class="form-control" type="hidden" placeholder=" ">
                                        <input id="product_price" name="product_price" class="form-control"
                                            type="hidden" placeholder=" ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="network_preferences">Cut Out</label>
                                    <select name="cutout" id="cutout" class="form-control " data-live-search="true"
                                        tabindex="-1" aria-hidden="true">
                                        <option value=""> -- Select One --</option>
                                        <option value="">
                                            1
                                        </option>
                                        <option value="">
                                            2
                                        </option>
                                        <option value="">
                                            3
                                        </option>
                                        <option value="">
                                            4
                                        </option>
                                        <option value="">
                                            5
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="notch">Notches</label>
                                    <select name="notch" id="notch" class="form-control ">
                                        <option value=""> -- Select One --</option>
                                        <option value="">
                                            1
                                        </option>
                                        <option value="">
                                            2
                                        </option>
                                        <option value="">
                                            3
                                        </option>
                                        <option value="">
                                            4
                                        </option>
                                        <option value="">
                                            More
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="hole">Holes</label>
                                    <select name="hole" id="hole" class="form-control ">
                                        <option value=""> -- Select One --</option>
                                        <option value="">
                                            1
                                        </option>
                                        <option value="">
                                            2
                                        </option>
                                        <option value="">
                                            3
                                        </option>
                                        <option value="">
                                            4
                                        </option>
                                        <option value="">
                                            5
                                        </option>
                                        <option value="">
                                            6
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="rake">Rake</label>
                                    <select name="rake" id="rake" class="form-select">
                                        <option value=""> -- Select One --</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="radius_corners">Radius Corners</label>
                                    <select name="radius_corners" id="radius_corners" class="form-select">
                                        <option value=""> -- Select One --</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label for="back_select">Back</label>
                                    <select name="back_select" id="back_select" class="form-select">
                                        <option value=""> -- Select One --</option>
                                        <option value=""> Painted</option>
                                        <option value="">Printed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 finish">
                            <div class="form-group">
                                <label for="painted_option">Finish</label>
                                <select name="finish" id="painted_option" class="form-control ">
                                    <option value="0"> -- Select One --</option>
                                    <option value="0">
                                        Sparkle Finish
                                    </option>
                                    <option value="">
                                        Metallic Finish
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 shape">
                            <div class="form-group">
                                <label for="cnc">CNC Shape</label>
                                <select name="cnc" id="cnc" class="form-control ">
                                    <option value=""> -- Select One --</option>
                                    <option value="">
                                        Yes
                                    </option>
                                    <option value="">
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 sand">
                            <div class="form-group">
                                <label for="sandblasted">Sand Blasted</label>
                                <select name="sandblasted" id="sandblasted" class="form-control ">
                                    <option value=""> -- Select One --</option>
                                    <option value="">
                                        Yes
                                    </option>
                                    <option value="">
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 ritecs">
                            <div class="form-group">
                                <label for="ritec">Ritec</label>
                                <select name="ritec" id="ritec" class="form-control ">
                                    <option value=""> -- Select One --</option>
                                    <option value="">
                                        Yes
                                    </option>
                                    <option value="">
                                        No
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 bevel_edges">
                            <div class="form-group">
                                <label for="bevel_edges">Bevel Edges</label>
                                <select name="bevel_edges" id="bevel_edges" class="form-control ">
                                    <option value=""> -- Select One --</option>
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
        function client_info() {
            var selectElement = document.querySelector('.form-select');
            var selectedValue = selectElement.value;
            // alert(selectedValue);
            $.ajax({
                type: "get",
                url: "{{ route('clientinfo') }}/" + selectedValue,
                success: function(response) {
                    // console.log(response.client);
                    $("#client_data").html(response.client);
                    $('#cust_name').val(response.client.name);
                    $('#cust_phone').val(response.client.phonr);
                    $('#cust_email').val(response.client.email);
                    $('#cust_postcode').val(response.client.postal_code);
                    $('#cust_address').val(response.client.address);
                    $('#trade_discount').val(response.client.trade_discount);
                }
            });


            // get client data from database through ajax
            $("#clients").change(function () {
                var id = $(this).val();

                $.ajax
                ({
                    type: "GET",
                    url: "{{route('get_data','id')}}",
                    data: {id: id},
                    dataType: 'json',
                    cache: false,
                    success: function (data) {

                        //geting value from database
                        var name = data.name;
                        var phone = data.phone;
                        var email = data.email;
                        var postal = data.postal_code;
                        var distance = data.distance;
                        var address = data.address;
                        var trade_discount = data.trade_discount;

                        //display value in input fields
                        $('#cust_name').val(name);
                        $('#cust_phone').val(phone);
                        $('#cust_email').val(email);
                        $('#cust_postcode').val(postal);
                        $('#cust_address').val(address);
                        $('#delivery_distance').val(distance);
                        $('#trade_discount').val(trade_discount);
                    }
                });


                //calculate gross price
                $('#quantity, #net_price, #trade_discount').on('keyup', function (event) {
                    calculate_gross();
                });

            });

            //client insert data
            $("#add_client_form").on('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (data) {
                        //$('#form_output').html('Client submit successfully');
                        set_client(data.id, data.name, data.phone, data.postal_code, data.email, data.address, data.trade_discount, data.distance);
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

            $('.full_paint, .full_wood').hide();
            //get product details
            $("#code_id, #product_id").change(function () {
                var val = $(this).val();
                var id = $(this).attr('id');
                if (id == 'code_id') {
                    $('#product_id').val(val);
                } else {
                    $('#code_id').val(val);
                }

                //This is simple Get ajax request
                var url = '{{ url('get-product-data') }}' + '/' + val;

                $.get(url, function (result) {
                    set_product(result);

                    var height = Number($('#product_height').val());
                    var width = Number($('#product_width').val());
                    if (width > 0 && height > 0) {
                        calculate_price();
                    }
                });
                
            });

            //disabled remove from height attribute if width is given
            $('#product_width').on('keyup', function (event) {
                var val = $(this).val();
                console.log(val.length);
                if (val.length > 0) {
                    $('#product_height').removeAttr('readonly');
                } else {
                    $('#product_height').attr('readonly', 'disabled');
                }
            });

            //calculate sqm
            $('#product_width, #product_height').on('keyup', function (event) {
                var height = $('#product_height').val();
                var width = $('#product_width').val();
                if (height.length > 0 && width.length > 0) {
                    var mul = width * height;
                    var sqm = mul / 1000000;
   
                    if (sqm < 0.25) {
                        $('#product_sqm').val(0.25);
                    }
                    else {
                        $('#product_sqm').val(sqm);
                    } 
                }
            });

            $('#quantity, #net_price, #trade_discount').on('keyup', function (event) {
                calculate_gross();
            });

            $('#product_height').on('keyup', function () {
                calculate_price();
            });

            $('#cost_from_supplier, #matt_finish, #min_charges, #metallic_paint, #wood_stain, #gloss_80, #gloss_100_paint, #gloss_100_acrylic_lacquer, #polyester_or_full_grain, #burnished_finish, #edgebanding, #routed_handle_spraying, #beaded_door, #micro_bevel, #spraying_edges').on('keyup keydown change', function () {
                calculate_price();
            });

        });


        //set all client data after adding new client
        function set_client(id, name, phone, postal_code, email, address, trade_discount, distance) {

            $.ajax({
                type: "GET",
                url: "{{ route('allclient') }}",
                dataType: 'json',
                cache: false,
                success: function (result) {
                    $('#addcustomer').modal('hide');
                    $('.fade').hide();
                    $("#clients").html(result.client);
                    if (id) {
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

        //set product data
        function set_product(row) {
            var type = row.type;
            if (type == 'standard') {
                $('.full_paint, .full_wood').hide();
                $('.standard').show();

                $('#matt_finish').val(0);
                $('#min_charges').val(0);
                $('#metallic_paint').val(0);
                $('#gloss_80').val(0);
                $('#gloss_100_paint').val(0);
                $('#gloss_100_acrylic_lacquer').val(0);
                $('#edgebanding').val(0);
                $('#micro_bevel').val(0);
                $('#routed_handle_spraying').val(0);
                $('#beaded_door').val(0);
                $('#wood_stain').val(0);
                $('#polyester_or_full_grain').val(0);
                $('#burnished_finish').val(0);
                $('#spraying_edges').val(0);
                
            }
            if (type == 'basic') {
                $('.full_paint, .full_wood').hide();
                $('.basic').show();

                $('#matt_finish').val(0);
                $('#min_charges').val(0);
                $('#metallic_paint').val(0);
                $('#gloss_80').val(0);
                $('#gloss_100_paint').val(0);
                $('#gloss_100_acrylic_lacquer').val(0);
                $('#edgebanding').val(0);
                $('#micro_bevel').val(0);
                $('#routed_handle_spraying').val(0);
                $('#beaded_door').val(0);
                $('#wood_stain').val(0);
                $('#polyester_or_full_grain').val(0);
                $('#burnished_finish').val(0);
                $('#spraying_edges').val(0);
            }
            if (type == 'full_paint') {
                $('.full_wood').hide();
                $('.full_paint').show(); 

                $('#matt_finish').val(row.matt_finish);
                $('#min_charges').val(row.min_charges);
                $('#metallic_paint').val(row.metallic_paint);
                $('#gloss_80').val(row.gloss_80);
                $('#gloss_100_paint').val(row.gloss_100_paint);
                $('#gloss_100_acrylic_lacquer').val(row.gloss_100_acrylic_lacquer);
                $('#edgebanding').val(row.edgebanding);
                $('#micro_bevel').val(row.micro_bevel);
                $('#routed_handle_spraying').val(row.routed_handle_spraying);
                $('#beaded_door').val(row.beaded_door);
                $('#spraying_edges').val(row.spraying_edges);

                $('#wood_stain').val(0);
                $('#polyester_or_full_grain').val(0);
                $('#burnished_finish').val(0);
            }
            if (type == 'full_wood') {
                $('.full_paint').hide();
                $('.full_wood').show(); 

                $('#matt_finish').val(row.matt_finish);
                $('#min_charges').val(row.min_charges);
                $('#wood_stain').val(row.wood_stain);
                $('#gloss_100_acrylic_lacquer').val(row.gloss_100_acrylic_lacquer);
                $('#polyester_or_full_grain').val(row.polyester_or_full_grain);
                $('#burnished_finish').val(row.burnished_finish);
                $('#edgebanding').val(row.edgebanding);
                $('#routed_handle_spraying').val(row.routed_handle_spraying);
                $('#beaded_door').val(row.beaded_door);
                $('#spraying_edges').val(row.spraying_edges);

                $('#metallic_paint').val(0);
                $('#gloss_80').val(0);
                $('#gloss_100_paint').val(0);
                $('#micro_bevel').val(0);
            }

            $('#cost_from_supplier').val(row.cost_from_supplier);
            $('#note').val(row.note);
            var net_price = row.sale_net_sqm;
            $('#pro_price').val(net_price);
        }

        function calculate_price() {
            var total = 0;

            $('#cost_from_supplier, #matt_finish, #min_charges, #metallic_paint, #wood_stain, #gloss_80, #gloss_100_paint, #gloss_100_acrylic_lacquer, #polyester_or_full_grain, #burnished_finish, #edgebanding, #routed_handle_spraying, #beaded_door, #micro_bevel, #spraying_edges').each(function () {
                total += Number($(this).val());
            });
            // product price per sqm
            var input_sqm = Number($('#product_sqm').val());
            if (input_sqm < 0.25) {
                input_sqm = 0.25;
            }

            var sqm_product = Number($('#pro_price').val());

            var sqm_price = input_sqm * sqm_product;
            $('#price').val(sqm_price);

            total += sqm_price;

            $('#net_price').val(total.toFixed(2));
            $('#basic_net').val(total.toFixed(2));

            calculate_gross();
        }

        function calculate_gross() {
            var quantity = Number($('#quantity').val());
            var basic_net = Number($('#basic_net').val());
            var discount = Number($('#trade_discount').val());

            var net = Number(quantity * basic_net);

            var vat = (20 * net) / 100;
            $('#vat').val(vat.toFixed(2));

            var gross = net + vat;

            var net_discount = (discount * gross) / 100;

            var total_gross = gross - net_discount;

            $('#total_gross').val(total_gross.toFixed(2));
        
        }

        //
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
            //get product details
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
                var url = '{{ url('get.product') }}' + '/' + val;
                $.get(url, function(result) {
                    var pro_type = result.type;
                    var product_note = result.product_note;
                    $('#pro_type').val(pro_type);
                    $('#product_note').val(product_note);
                    set_form(result);
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
                var height = $('#prod-height').val();
                var width = $('#prod-width').val();
                if (height.length > 0 && width.length > 0) {
                    var mul = width * height;
                    var sqm = mul / 1000000;

                    $('#prod-sqm').val(sqm);

                }
            });
            $('#cutout, #notch, #hole, #rake, #radius_corners, #back_select, #cnc, #sandblasted, #ritec, #bevel_edges, #painted_option,#code_id, #prod-height, #trade_discount')
                .on('keyup keydown change', function() {
                    // $('#cutout, #notch, #hole, #back_select, #cnc, #sandblasted, #ritec, #painted_option,#code_id, #prod-height, #trade_discount').on('keyup keydown change', function () {
                    calculate_price();
                });

        });
    </script>
@endsection
