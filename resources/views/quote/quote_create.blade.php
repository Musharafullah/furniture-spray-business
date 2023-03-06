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
                            </select> --}}
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
                                <input id="cust_postcode" name="billing_postal_code" class="form-control" type="text"
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
                        <form action="{{ route('create_quote') }}" method="POST">
                            @csrf
                            <input type="hidden" name="client_id" id="client_id" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="code_id">Code</label>
                                            <select name="code_id" id="code_id" class="form-select">
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
                                            <select name="product_id" id="product_id" class="form-select">
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
                                                <option value="">-- Select option --</option>
                                                <option value="1">Single</option>
                                                <option value="2">Double</option>
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
                                                <option value="">-- Select option --</option>
                                                <option value="">80% Gloss - Add on / Sqm (1 sided)</option>
                                                <option value="">100% Gloss / Wet Look PU Paint (SQM)</option>
                                                <option value="">100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label>100% Gloss / Wet Look </label>
                                            <select name="gloss_100_acrylic_lacquer" id="gloss_100_acrylic_lacquer"
                                                class="form-select">
                                                <option value="">-- Select option --</option>
                                                <option value="">YES</option>
                                                <option value="">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label>Polyester / Full Grain (SQM)</label>
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
                                            <input id="trade_discount" name="trade_discount" class="form-control"
                                                type="number" placeholder="" value="" min="0">
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
                            </div>
                        </form>
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
                            <h4>Delivery Options</h4>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea id="comment" name="comment" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="internal-comment">Internal comment</label>
                                <textarea id="internal-comment" class="form-control" name="internal_comment" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 pull-right mt-4">
                            <button type="submit" class="btn btn-primary-rounded">
                                Add another item <span><i class="fa fa-save"></i></span>
                            </button>
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
                <form action="{{ route('customer.store') }}" method="post" id="">
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
                                    <select name="trade_discount" id="trade_discount" class="form-select">
                                        @php
                                            $discount = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                                        @endphp
                                        <option value=""> -- Select Product Type --</option>
                                        @foreach ($discount as $type)
                                            <option value="{{ $type }}">
                                                {{ $type }}
                                            </option>
                                        @endforeach
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
                        {{-- <button class="btn-primary" type="submit" id="add">Add Customer</button> --}}
                        <button class="btn-primary" type="submit" id="">Add Customer</button>
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

            $('.full_wood').hide();
            $('.full_paint').show();
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
                    //$("#clients").html(response.client);
                    $('#client_id').val(response.client.id);
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

        //set all client data after adding new client through modal
        function set_client(id, name, phone, postal_code, email, address, trade_discount, distance) {
            $.ajax({
                type: "GET",
                url: "{{ route('allclient') }}",
                dataType: 'json',
                cache: false,
                success: function(result) {
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
            options += '<option value="1">Single Side</option>';
            options += '<option value="2">Double Side</option>';
            $('#' + selectbox_id).html(options);
        }

        function set_gloss_percent(selectbox_id, gloss_80, gloss_100_paint, gloss_100_acrylic_lacquer) {
            var options = '';
            <option value="0">No Gloss</option>
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

            if (type == 'full_wood') {
                addon_selectboxes('gloss_100_acrylic_lacquer', row.gloss_100_acrylic_lacquer);
                set_gloss_percent('gloss_percentage', 0, 0, 0);
            }
            if (type == 'full_paint') {
                addon_selectboxes('gloss_100_acrylic_lacquer', 0);
                set_gloss_percent('gloss_percentage', row.gloss_80, row.gloss_100_paint, row.gloss_100_acrylic_lacquer);
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

            $('#note').text(row.product_note);

            var net_price = row.sale_net_sqm;
            $('#pro_price').val(net_price);

            if (type == 'standard' || type == 'basic') {
                $('.full_paint, .full_wood').hide();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(0.30);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_paint') {
                $('.full_wood').hide();
                $('.full_paint').show();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(0.30);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_wood') {
                $('.full_paint').hide();
                $('.full_wood').show();
                $('.sqm, .width, .height').show();

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_sqm').val(0.30);
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }

            if (type == 'basic') {
                $('.sqm, .width, .height').hide();
                $('#product_sqm').val(1);
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
            if (height.length > 0 && width.length > 0) {
                var mul = width * height;
                var sqm = mul / 1000000;

                if (sqm < 0.30) {
                    $('#product_sqm').val(0.30);
                } else {
                    $('#product_sqm').val(sqm);
                }

                var lm = (2 * Number(height)) + (2 * Number(width));
                lm = lm / 1000;
                $('#product_lm').val(lm);
                //alert(lm);

            } else {
                $('#product_sqm').val(0.30);
                $('#product_lm').val(1);
            }
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
                var input_sqm = Number($('#product_sqm').val());
                if (input_sqm < 0.30 || $('#product_sqm').val() == '') {
                    input_sqm = 0.30;
                    $('#product_sqm').val(0.30);
                }

                var sqm_product = Number($('#pro_price').val());

                if ($('#matt_finish_option').val() == 2) {
                    var sqm_price = input_sqm * sqm_product * 2;
                    $('#product_price').val(sqm_price);
                    total += sqm_price;
                } else {
                    var sqm_price = input_sqm * sqm_product;
                    $('#product_price').val(sqm_price);
                    total += sqm_price;
                }


                $('#matt_finish, #metallic_paint, #wood_stain, #gloss_percentage, #gloss_100_acrylic_lacquer, #polyester, #burnished_finish, #barrier_coat')
                    .each(function() {

                        if ($('#matt_finish_option').val() == 2) {
                            var value = Number($(this).val()) * input_sqm * 2;
                            total += value;
                        } else {
                            var value = Number($(this).val()) * input_sqm;
                            total += value;
                        }
                    });


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
    </script>
@endsection
