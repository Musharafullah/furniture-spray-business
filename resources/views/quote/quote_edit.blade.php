@extends('dashboardlayouts.master')
@section('title')
    <title>Editquote</title>
@endsection
@section('content')
    <div class="create-quote py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>Update Quote</h3>
                        </div>
                    </div>

                    <!----------------------------------- Customer Info -------------------------------------->
                    <div class="row customer-info">
                        <div class="col-12">
                            <h4>Customer Info</h4>
                        </div>

                        {{-- <div class="col-12 col-md-8">
                            <select class="form-select" id="clients" onchange="client_info()"></select>
                             <select class="form-select" onchange="client_info()" id="clients">
                                    <option value="">-- Select Customer --</option>
                                    @foreach ($data as $client)
                                        <option value='{{ $client->id }}'>{{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                        </div> --}}
                        {{-- <div class="col-12 col-md-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#addcustomer">
                                Add Customer <i class="fa fa-plus-circle"></i>
                            </button>
                        </div> --}}
                        <input type="hidden" value="{{ $client }}" id="clients" />
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
                    <form action="{{ route('quote.update', $deal->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="quote_id" id="quote_id"
                            value="{{ $deal->quote_id ?? old('quote_id') }}" />
                        <div class="row add-product">
                            <div class="col-12">
                                <h4>Product Info</h4>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" id="type" />
                                            <label for="code_id">Code</label>
                                            <select id="code_id" class="form-select" required data-live-search="true">
                                                <option value=""> -- Select One --</option>
                                                @foreach ($products as $product)
                                                    @php
                                                        $select = $product->id == old('product_id') || $product->id == $deal->product_id ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $product->id }}" {{ $select }}>
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
                                                    @php
                                                        $select = $product->id == old('product_id') || $product->id == $deal->product_id ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $product->id }}" {{ $select }}>
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
                                                placeholder="" value="{{ $deal->width ?? old('width') }}">
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
                                            <input id="product_height" name="height" class="form-control" type="number"
                                                placeholder="" value="{{ $deal->height ?? old('height') }}" readonly>
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
                                                placeholder="" readonly value="{{ $deal->sqm ?? old('sqm') }}">
                                            <input id="db_sqm" class="form-control" type="hidden" placeholder="">
                                            <input id="product_lm" class="form-control" type="hidden" placeholder="">
                                            <input id="pro_price" class="form-control" type="hidden" placeholder="">
                                            <input id="product_price" name="product_price" class="form-control"
                                                type="hidden" placeholder=""
                                                value="{{ $deal->product_price ?? old('product_price') }}">
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
                                                <option value="1">Single Sided</option>
                                                <option value="2">Double Sided</option>
                                            </select>
                                            <input name="matt_finish" id="matt_finish" class="form-control"
                                                type="hidden" placeholder="" value="{{ $deal->matt_finish }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Sprayed Edges</label>
                                            <select name="spraying_edges" id="spraying_edges" class="form-select">
                                                <option>YES</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Metallic</label>
                                            <select name="metallic_paint" id="metallic_paint" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label for="wood_stain">Wood stain</label>
                                            <select name="wood_stain" id="wood_stain" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Gloss Percentage</label>
                                            <select name="gloss_percentage" id="gloss_percentage" class="form-select">
                                                <option value="0">No Gloss</option>
                                                <option>80% Gloss - Add on / Sqm (1 sided)</option>
                                                <option>100% Gloss / Wet Look PU Paint (SQM)</option>
                                                <option>100% Gloss / Wet Look Clear Acrylic Lacquer (SQM)
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
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label>Polyester / Full Grain</label>
                                            <select name="polyester" id="polyester" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Burnished Finish</label>
                                            <select name="burnished_finish" id="burnished_finish" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood">
                                        <div class="form-group">
                                            <label for="barrier_coat">Barrier Coat</label>
                                            <select name="barrier_coat" id="barrier_coat" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Edge banding</label>
                                            <select name="edgebanding" id="edgebanding" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_paint">
                                        <div class="form-group">
                                            <label>Micro bevel</label>
                                            <select name="micro_bevel" id="micro_bevel" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Routed / J Handle</label>
                                            <select name="routed_handle_spraying" id="routed_handle_spraying"
                                                class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 full_wood full_paint">
                                        <div class="form-group">
                                            <label>Beaded Door</label>
                                            <select name="beaded_door" id="beaded_door" class="form-select">
                                                <option>YES</option>
                                                <option>NO</option>
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
                                                placeholder="Please enter quantity"
                                                value="{{ $deal->quantity ?? old('quantity') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="net_price">Net Price</label>
                                            <input id="net_price" name="net_price" class="form-control" type="number"
                                                placeholder="" readonly=""
                                                value="{{ $deal->net_price ?? old('net_price') }}">
                                            <input type="hidden" id="basic_net">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="vat">VAT</label>
                                            <input id="vat" name="vat" class="form-control" type="number"
                                                placeholder="" readonly="" value="{{ $deal->vat ?? old('vat') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="trade_discount">Trade_discount (%)</label>
                                            <input id="trade_discount" name="trade_discount" class="form-control" placeholder=""
                                                type="number" value="{{ $deal->trade_discount ?? old('trade_discount') }}"> 
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="total_gross">Gross Total</label>
                                            <input id="total_gross" name="total_gross" class="form-control"
                                                type="number" placeholder="" readonly=""
                                                value="{{ $deal->total_gross ?? old('total_gross') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="note">Product Note</label>
                                            <textarea id="note" name="note" class="form-control" rows="3" placeholder="Please Add Product Note">{{ $deal->note ?? old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----------------------------------- End Add Products -------------------------------------->

                        <!----------------------------------- Delivery Options -------------------------------------->

                        <div class="row d-flex justify-content-end">
                            {{-- <div class="col-sm-6 mt-4">
                                <button type="submit" class="btn btn-primary-rounded">
                                    Cancel <span><i class="fa fa-times"></i></span>
                                </button>
                            </div> --}}

                            <div class="col-sm-6 mt-4">
                                <button type="submit" class="btn btn-primary-rounded">
                                    Update quote <span><i class="fa fa-save"></i></span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!----------------------------------- End Delivery Options -------------------------------------->

            <div class="text-center pt-5 pb-4">
                Please Filled the Billing Postcode field first and click the search button for house average price
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function client_info($id) {

            $.ajax({
                type: "get",
                url: "{{ route('clientinfo') }}/" + $id,
                success: function(response) {
                    //console.log(response.client);
                    //$("#clients").html(response.client);
                    $('#client_id').val(response.client.id);
                    $('#cust_name').val(response.client.name);
                    $('#cust_phone').val(response.client.phone);
                    $('#cust_email').val(response.client.email);
                    $('#cust_postcode').val(response.client.postal_code);
                    $('#cust_address').val(response.client.address);
                    //$('#trade_discount').val(response.client.trade_discount);
                }
            });
        }
        $(document).ready(function() {

            $('.select2').select2().on('select2:open', function(e){
                $('.select2-search__field').attr('placeholder', 'Search here.....');
            });


            $id = $("#clients").val();
            client_info($id);

            $('.full_wood').hide();
            $('.full_paint').show();

            var val = $('#product_id').val();

            var height = $('#product_height').val();
            var width = $('#product_width').val();
            if (height.length > 0 && width.length > 0) {
                var lm = (2 * Number(height)) + (2 * Number(width));
                lm = lm / 1000;
                $('#product_lm').val(lm);
                //alert(lm);

            } else {
                $('#product_lm').val(1);
                $('#product_sqm').val(1);
            }

            if (width.length > 0) {
                $('#product_height').removeAttr('readonly');
            } else {
                $('#product_height').attr('readonly', 'disabled');
            }

            //This is simple Get ajax request
            var url = '{{ url('get-product-data') }}' + '/' + val;

            $.get(url, function(result) {
                set_product(result);

                //selected addons
                $("#matt_finish_option option[value={{ $deal->matt_finish_option }}]").prop("selected",
                    "selected");
                $("#metallic_paint option[value={{ $deal->metallic_paint }}]").prop("selected",
                    "selected");
                $("#wood_stain option[value={{ $deal->wood_stain }}]").prop("selected", "selected");
                $("#gloss_percentage option[value={{ $deal->gloss_percentage }}]").prop("selected",
                    "selected");
                $("#gloss_100_acrylic_lacquer option[value={{ $deal->gloss_100_acrylic_lacquer }}]").prop(
                    "selected", "selected");
                $("#polyester option[value={{ $deal->polyester }}]").prop("selected", "selected");
                $("#burnished_finish option[value={{ $deal->burnished_finish }}]").prop("selected",
                    "selected");
                $("#barrier_coat option[value={{ $deal->barrier_coat }}]").prop("selected", "selected");
                $("#edgebanding option[value={{ $deal->edgebanding }}]").prop("selected", "selected");
                $("#micro_bevel option[value={{ $deal->micro_bevel }}]").prop("selected", "selected");
                $("#routed_handle_spraying option[value={{ $deal->routed_handle_spraying }}]").prop(
                    "selected", "selected");
                $("#beaded_door option[value={{ $deal->beaded_door }}]").prop("selected", "selected");
                $("#gloss_percentage_option").val({{ $deal->gloss_percentage_option }});
            });


        });



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
                    //console.log("Error");
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

            //$('#note').text(row.product_note);

            var net_price = row.sale_net_sqm;
            $('#pro_price').val(net_price);

            if (type == 'standard') {
                $('.full_paint, .full_wood').hide();
                $('.sqm, .width, .height').show();

                //$('#product_sqm').val(row.min_sqm);
                $('#db_sqm').val(row.min_sqm);

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_paint') {
                $('.full_wood').hide();
                $('.full_paint').show();
                $('.sqm, .width, .height').show();

                //$('#product_sqm').val(row.min_sqm);
                $('#db_sqm').val(row.min_sqm);

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }
            if (type == 'full_wood') {
                $('.full_paint').hide();
                $('.full_wood').show();
                $('.sqm, .width, .height').show();

                //$('#product_sqm').val(row.min_sqm);
                $('#db_sqm').val(row.min_sqm);

                if ($('#product_height').val() == '' || $('#product_width').val() == '') {
                    $('#product_lm').val(1);
                    calculate_price();
                }
            }

            if (type == 'basic') {
                $('.full_paint, .full_wood').hide();
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
            //console.log(val.length);
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

        $('#net_price').on('keyup', function(event) {
            calculate_gross();
        });

        $('#quantity, #trade_discount').on('keyup', function(event) {
            calculate_price();
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
                    if(input_sqm < min_sqm) {
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
                        $('#product_sqm').val(input_sqm);
                    }
                    else {
                        input_sqm = min_sqm;
                        $('#product_sqm').val(input_sqm);
                    }
                }

                var product_sqm = $('#product_sqm').val();
                var sqm_product = Number($('#pro_price').val());



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
    </script>
@endsection
