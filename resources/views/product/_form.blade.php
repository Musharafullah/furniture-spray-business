<div class="row">
    <div class="col-sm-11">
        <div class="form-group">
            <select name="type" id="type" class="form-control " data-live-search="false" tabindex="-1"
                aria-hidden="true" required>
                @php
                    $types = ['full_featured', 'partial_featured', 'non_featured', 'non_glass'];
                @endphp

                <option value=""> -- Select Product Type --</option>
                @foreach ($types as $type)
                    @php
                        $select = old('type', $product->type) == $type ? 'selected' : '';
                    @endphp
                    <option value="{{ $type ?? old('type') }}" {{ $select }}>
                        @php
                            // $role_name= $role->name;
                            $type = str_replace('_', ' ', $type);
                            $type = ucwords($type);
                        @endphp
                        {{ $type }}</option>
                @endforeach
            </select>
            @if ($errors->any())
                @if ($errors->has('type'))
                    <strong class="text-danger">{{ $errors->first('type') }}</strong>
                @endif
            @endif

        </div>
    </div>
    <div class="col-sm-1">
        <div class="form-group">
            <a href="#" data-toggle="modal" data-target="#productdetail" id="product_detail"><i
                    class="fa fa-question-circle"></i> Help</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label for="input-file-now">Product Image</label>
        @if ($product->product_image)
            <input type="file" name="product_image" id="product_image" class="dropify"
                value="{{ $product->product_image }}"
                data-default-file="{{ asset('assets/product_images/' . $product->product_image) }}" />
        @else
            <input type="file" name="product_image" id="product_image" class="dropify" />
        @endif
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="code">Code</label>
            <input id="code" name="code" class="form-control" type="text" placeholder="Enter Code"
                value="{{ $product->code ?? old('code') }}">
            {{--  --}}
            @if ($errors->any())
                @if ($errors->has('code'))
                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="product_name">Title</label>
            <input id="product_name" name="product_name" class="form-control" type="text"
                placeholder="Enter Product Name" value="{{ $product->product_name ?? old('product_name') }}">
            @if ($errors->any())
                @if ($errors->has('product_name'))
                    <strong class="text-danger">{{ $errors->first('product_name') }}</strong>
                @endif
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="cost_from_supplier">Cost From Supplier
            </label>
            <input id="cost_from_supplier" name="cost_from_supplier" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->cost_from_supplier ?? old('cost_from_supplier') }}"
                step="any">
            @if ($errors->any())
                @if ($errors->has('cost_from_supplier'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('cost_from_supplier') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="sale_net_sqm">Sale Net Per SQM
            </label>
            <input id="sale_net_sqm" name="sale_net_sqm" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->sale_net_sqm ?? old('sale_net_sqm') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('Sale_net_sqm'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('Sale_net_sqm') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
</div>

<div class="row non_featured">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="cut_out">Cut Out
            </label>
            <input id="cut_out" name="cut_out" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->cut_out ?? old('cut_out') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('cut_out'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('cut_out') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="notch">Notch
            </label>
            <input id="notch" name="notch" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->notch ?? old('notch') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('notch'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('notch') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="hole">Hole
            </label>
            <input id="hole" name="hole" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->hole ?? old('hole') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('hole'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('hole') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    {{--    new feature starts --}}
    <div class="col-sm-6">
        <div class="form-group">
            <label for="hole">Rake
            </label>
            <input id="hole" name="rake" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->rake ?? old('rake') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('rake'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('rake') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="hole">Radius Corners
            </label>
            <input id="hole" name="radius_corners" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->radius_corners ?? old('radius_corners') }}"
                step="any">
            @if ($errors->any())
                @if ($errors->has('radius_corners'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('radius_corners') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    {{--    new feature ends --}}
    <div class="col-sm-6 paint">
        <div class="form-group">
            <label for="printed">Printed
            </label>
            <input id="printed" name="printed" class="form-control print" type="number"
                placeholder="Enter Number" value="{{ $product->printed ?? old('printed') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('printed'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('printed') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>

    <div class="col-sm-4 print">
        <div class="form-group">
            <label for="painted">Painted
            </label>
            <input id="painted" name="painted" class="form-control paint" type="number"
                placeholder="Enter Number" value="{{ $product->painted ?? old('painted') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('painted'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('painted') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-4 sparkle">
        <div class="form-group">
            <label for="sparkle_finish">Sparkle Finish
            </label>
            <input id="sparkle_finish" name="sparkle_finish" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->sparkle_finish ?? old('sparkle_finish') }}"
                step="any">
            @if ($errors->any())
                @if ($errors->has('sparkle_finish'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('sparkle_finish') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-4 metallic">
        <div class="form-group">
            <label for="metallic_finish">Metallic Finish
            </label>
            <input id="metallic_finish" name="metallic_finish" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->metallic_finish ?? old('metallic_finish') }}"
                step="any">
            @if ($errors->any())
                @if ($errors->has('metallic_finish'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('metallic_finish') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="cnc">CNC
            </label>
            <input id="cnc" name="cnc" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->cnc ?? old('cnc') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('cnc'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('cnc') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="standblasted">Sandblasted
            </label>
            <input id="standblasted" name="standblasted" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->standblasted ?? old('standblasted') }}"
                step="any">
            @if ($errors->any())
                @if ($errors->has('standblasted'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('standblasted') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="ritec">Ritec
            </label>
            <input id="ritec" name="ritec" class="form-control" type="number" placeholder="Enter Number"
                value="{{ $product->ritec ?? old('ritec') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('ritec'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('ritec') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    {{--    new feature starts --}}
    <div class="col-sm-4">
        <div class="form-group">
            <label for="standblasted">Bevel Edges
            </label>
            <input id="standblasted" name="bevel_edges" class="form-control" type="number"
                placeholder="Enter Number" value="{{ $product->bevel_edges ?? old('bevel_edges') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('bevel_edges'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('bevel_edges') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    {{--    new feature ends --}}
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="product_note">Note
            </label>
            <textarea id="product_note" name="product_note" class="form-control" placeholder="Add Product Note" rows="5">{{ $product->product_note ?? old('product_note') }}</textarea>
            @if ($errors->any())
                @if ($errors->has('ritec'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('product_note') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
</div>
<div style="clear: both; height: 20px;"></div>
<div class="row">
    <div class="col-sm-offset-6 col-sm-6">
        <button class="btn btn-rounded btn-primary btn-block form-group">Save
            <span><i class="fa fa-save"></i></span></button>
    </div>
</div>


<!--start Modal for edit survey and fit-->
<div aria-hidden="true" aria-labelledby="ProductDetailModal" class="modal fade" id="productdetail" role="dialog"
    tabindex="-1" style="margin-top:100px;">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><span id="form_output" class="alert-info"></span></h3>
                    <h6><span id="errors" class="alert-danger"></span></h6>
                    <div class="row">
                        <div class="col-sm-6">

                            <h3 class="modal-title">Product Type Details</h3>
                        </div>
                        <div class="col-sm-6">
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_type_id">Full Featured Products:</label>
                                <p>Products which contains all of the attributes. In full featured product we have to
                                    fill all of the fields.</p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_type_id">Partial Featured Products:</label>
                                <p>
                                    Products which the Painted/ Printed Back attributes. In Partial featured products
                                    the fields for
                                    <span style="color:red;">'Printed', 'Painted', 'Sparkle Finish'</span>
                                    and <span style="color:red;">'Metallic Finish'</span> are excluded.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_type_id">Non Featured Products:</label>
                                <p>

                                    Products which contains only the Width and Height attributes. In Non featured
                                    products we have only these fields,
                                    <span style="color:blue;">'Code', 'Title', 'Cost From Supplier', 'Sale Net Per
                                        SQM', ‘Width’</span>
                                    and <span style="color:blue;">‘Height’</span>.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="product_type_id">Non Glass Products:</label>
                                <p>
                                    Products which are to be quoted based on quantity only. In Non glass products we
                                    only these fields,
                                    <span style="color:blue;">'Code', 'Title' , 'Cost From Supplier'</span> and
                                    <span style="color:blue;">'Sale Price’</span>.

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End endedit modal for survey and fit -->
