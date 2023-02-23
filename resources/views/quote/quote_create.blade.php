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
                                            <input id="pro_price" class="form-control" type="hidden" placeholder=" ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Rate / Sqm (1 sided) - Matt Finish</label>
                                            <select class="form-select" id="matt_finish" name="matt_finish">
                                                <option value=""> -- Select One --</option>
                                                <option value="single">Single</option>
                                                <option value="double">Double</option>
                                            </select>
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
                                            <select class="form-select" id="spraying_edges" name="spraying_edges">
                                                <option value="yes" selected>Yes</option>
                                            </select>
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
                                            <select class="form-select" id="metallic_paint" name="metallic_paint">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="wood_stain" name="wood_stain">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="gloss_80" name="gloss_80">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @if ($errors->any())
                                                @if ($errors->has('gloss_80%'))
                                                    <strong class="text-danger">{{ $errors->first('gloss_80%') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_paint">
                                        <div class="form-group">
                                            <label>100% Gloss / Wet Look PU Paint (SQM)</label>
                                            <select class="form-select" id="gloss_100_paint" name="gloss_100_paint">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="gloss_100_acrylic_lacquer" name="gloss_100_acrylic_lacquer">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="polyester_or_full_grain" name="polyester_or_full_grain">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="burnished_finish" name="burnished_finish">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @if ($errors->any())
                                                @if ($errors->has('burnished_finish'))
                                                    <strong class="text-danger">{{ $errors->first('burnished_finish') }}</strong>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Edgebanding - Rate Per L/M</label>
                                            <select class="form-select" id="edgebanding" name="edgebanding">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="micro_bevel" name="micro_bevel">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="routed_handle_spraying" name="routed_handle_spraying">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                            <select class="form-select" id="beaded_door" name="beaded_door">
                                                <option value=""> -- Select One --</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
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
                                        <option value="">-- Select One --</option>
                                        <option value="0">0%</option>
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
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "{{ route('allclient') }}",
                success: function(response) {
                    console.log(response.client);
                    $("#clients").html(response.client);
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
                });

                $('#product_sqm').val(0.25);

                var height = Number($('#product_height').val());
                var width = Number($('#product_width').val());
                if (width > 0 && height > 0) {
                    calculate_price();
                }
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

            $('#produt_height').on('keyup', function () {
                calculate_price();
            });

            $('#cutout, #notch, #hole, #back_select, #cnc, #sandblasted, #ritec').on('keyup keydown change', function () {
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

                var net_price = row.sale_net_sqm;
                $('#pro_price').val(net_price);
            }

            if (type == 'basic') {
                $('.full_paint, .full_wood').hide();

                var net_price = row.sale_net_sqm;
                $('#pro_price').val(net_price);
            }
            if (type == 'full_paint') {
                $('.full_wood, .standard').hide();
                $('.full_paint').show(); 

                if(row.matt_finish =="65")
                {
                    $('#matt_finish').val('single');
                }else{
                    $('#matt_finish').val('double');
                }

                $('#min_charges').val(row.min_charges);

                if(row.metallic_paint =="10")
                {
                    $('#metallic_paint').val('yes');
                }else{
                    $('#metallic_paint').val('no');
                } 

                if(row.gloss_80 =="10")
                {
                    $('#gloss_80').val('yes');
                }else{
                    $('#gloss_80').val('no');
                }

                if(row.gloss_100_paint =="30")
                {
                    $('#gloss_100_paint').val('yes');
                }else{
                    $('#gloss_100_paint').val('no');
                }

                if(row.gloss_100_acrylic_lacquer =="45")
                {
                    $('#gloss_100_acrylic_lacquer').val('yes');
                }else{
                    $('#gloss_100_acrylic_lacquer').val('no');
                }

                if(row.edgebanding =="6")
                {
                    $('#edgebanding').val('yes');
                }else{
                    $('#edgebanding').val('no');
                }

                if(row.micro_bevel =="4")
                {
                    $('#micro_bevel').val('yes');
                }else{
                    $('#micro_bevel').val('no');
                }

                if(row.routed_handle_spraying =="15")
                {
                    $('#routed_handle_spraying').val('yes');
                }else{
                    $('#routed_handle_spraying').val('no');
                }

                if(row.beaded_door =="45")
                {
                    $('#beaded_door').val('yes');
                }else{
                    $('#beaded_door').val('no');
                }

            }
            if (type == 'full_wood') {
                $('.full_paint, .standard').hide();
                $('.full_wood').show(); 

                if(row.matt_finish =="40")
                {
                    $('#matt_finish').val('single');
                }else{
                    $('#matt_finish').val('double');
                }

                $('#min_charges').val(row.min_charges);

                if(row.wood_stain =="3")
                {
                    $('#wood_stain').val('yes');
                }else{
                    $('#wood_stain').val('no');
                } 

                if(row.gloss_100_acrylic_lacquer =="44")
                {
                    $('#gloss_100_acrylic_lacquer').val('yes');
                }else{
                    $('#gloss_100_acrylic_lacquer').val('no');
                }

                if(row.polyester_or_full_grain =="100")
                {
                    $('#polyester_or_full_grain').val('yes');
                }else{
                    $('#polyester_or_full_grain').val('no');
                }

                if(row.burnished_finish =="70")
                {
                    $('#burnished_finish').val('yes');
                }else{
                    $('#burnished_finish').val('no');
                }

                if(row.edgebanding =="7.5")
                {
                    $('#edgebanding').val('yes');
                }else{
                    $('#edgebanding').val('no');
                }

                if(row.routed_handle_spraying =="10")
                {
                    $('#routed_handle_spraying').val('yes');
                }else{
                    $('#routed_handle_spraying').val('no');
                }

                if(row.beaded_door =="10")
                {
                    $('#beaded_door').val('yes');
                }else{
                    $('#beaded_door').val('no');
                }
            }

            function calculate_price() {
                var total = 0;
                $('#cutout, #notch, #hole, #cnc').each(function () {
                    total += Number($(this).val());
                });
                // product price per sqm
                var input_sqm = Number($('#product_sqm').val());
                if (input_sqm < 0.25) {
                    input_sqm = 0.25;
                }

                var sqm_product = $('#pro_price').val();

                var sqm_price = input_sqm * sqm_product;
                $('#product_price').val(sqm_price);

                //back per sqm
                var back = $('#back_select').val();
                var back_per_sqm = back * input_sqm;

                //standblasted per sqm
                var stand = $('#sandblasted').val();
                var stand_per_sqm = stand * input_sqm;

                //ritec per sqm
                var retic = $('#ritec').val();
                var retic_per_sqm = retic * input_sqm;
                total += sqm_price + back_per_sqm + stand_per_sqm + retic_per_sqm;

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

                var gross = net + vat;

                var net_discount = (discount * gross) / 100;

                var total_gross = gross - net_discount;

                $('#total_gross').val(total_gross.toFixed(2));
            }
        }
    </script>
@endsection
