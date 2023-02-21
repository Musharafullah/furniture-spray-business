<div class="row">
    <div class="col-9 col-sm-10 col-xl-11">
        <select name="type" id="type" class="form-select" required>
            <option value=""> -- Select Product Type --</option>
            <option value="standard" {{ $product->type == 'standard' ? 'selected' : ''}} >Standard</option>
            <option value="basic" {{ $product->type == 'basic' ? 'selected' : ''}} >Basic</option>
            <option value="full_paint" {{ $product->type == 'full_paint' ? 'selected' : ''}} >Full (Paint)</option>
            <option value="full_wood" {{ $product->type == 'full_wood' ? 'selected' : ''}} >Full (Wood)</option>
        </select>
        @if ($errors->any())
            @if ($errors->has('type'))
                <strong class="text-danger">{{ $errors->first('type') }}</strong>
            @endif
        @endif
    </div>
    <div class="col-3 col-sm-2 col-xl-1">
        <a href="" data-bs-toggle="modal" data-bs-target="#productdetail">
            <i class="fa fa-question-circle"></i> Help
        </a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <label for="product_image">Product Image</label>
        @if ($product->product_image_path)
        <input type="file" name="product_image" id="product_image" class="dropify" value="{{ $product->product_image }}" 
                        data-default-file="{{ asset('product_image/product/' . $product->product_image_path) }}" />
        @else
            <input type="file" name="product_image" id="product_image" class="dropify" />
        @endif
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="code">Code</label>
            <input id="code" name="code" class="form-control" type="text" placeholder="Enter Code" value="{{ $product->code ?? old('code') }}">
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
            <input id="product_name" name="product_name" class="form-control" type="text" placeholder="Enter Product Name" value="{{ $product->product_name ?? old('product_name') }}">
            @if ($errors->any())
                @if ($errors->has('product_name'))
                    <strong class="text-danger">{{ $errors->first('product_name') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="cost_from_supplier">Cost From Supplier</label>
            <input id="cost_from_supplier" name="cost_from_supplier" class="form-control" type="number" placeholder="Enter Number" value="{{ $product->cost_from_supplier ?? old('cost_from_supplier') }}" step="any">
            @if ($errors->any())
                @if ($errors->has('cost_from_supplier'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('cost_from_supplier') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6 standard basic">
        <div class="form-group">
            <label for="sale_net_sqm">Sale Net Per SQM</label>
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
    <div class="col-sm-6 full_wood full_paint">
        <div class="form-group">
            <label>Rate / Sqm (1 sided) - Matt Finish</label>
            <select class="form-select" id="matt_finish" name="matt_finish">
                <option value=""> -- Select One --</option>
                <option value="single" {{ $product->matt_finish == 'single' ? 'selected' : ''}} >Single</option>
                <option value="double" {{ $product->matt_finish == 'double' ? 'selected' : ''}} >Double</option>
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
            <input class="form-control" type="number" name="min_charges" id="min_charges" placeholder="Enter Number" value="{{ $product->min_charges ?? old('min_charges') }}">
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
                <option value="yes" {{ $product->metallic_paint == 'yes' ? 'selected' : ''}}>Yes</option>
                <option value="no" {{ $product->metallic_paint == 'no' ? 'selected' : ''}}>No</option>
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
                <option value="yes" {{ $product->wood_stain == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->wood_stain == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->gloss_80 == 'yes' ? 'selected' : ''}}>Yes</option>
                <option value="no" {{ $product->gloss_80 == 'no' ? 'selected' : ''}}>No</option>
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
                <option value="yes" {{ $product->gloss_100_paint == 'yes' ? 'selected' : ''}}>Yes</option>
                <option value="no" {{ $product->gloss_100_paint == 'no' ? 'selected' : ''}}>No</option>
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
                <option value="yes" {{ $product->gloss_100_acrylic_lacquer == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->gloss_100_acrylic_lacquer == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->polyester_or_full_grain == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->polyester_or_full_grain == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->burnished_finish == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->burnished_finish == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->edgebanding == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->edgebanding == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->micro_bevel == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->micro_bevel == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->routed_handle_spraying == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->routed_handle_spraying == 'no' ? 'selected' : ''}} >No</option>
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
                <option value="yes" {{ $product->beaded_door == 'yes' ? 'selected' : ''}} >Yes</option>
                <option value="no" {{ $product->beaded_door == 'no' ? 'selected' : ''}} >No</option>
            </select>
            @if ($errors->any())
                @if ($errors->has('beaded_door'))
                    <strong class="text-danger">{{ $errors->first('beaded_door') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="product_note">Note</label>
            <textarea id="product_note" name="product_note" class="form-control" placeholder="Add Product Note" rows="5">{{ $product->product_note ?? old('product_note') }}</textarea>
            @if ($errors->any())
                @if ($errors->has('product_note'))
                    <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('product_note') }}</strong>
                    </span>
                @endif
            @endif
        </div>
    </div>
</div>

<div class="row d-flex button-container">
    <div class="col-sm-6">
        <button class="btn btn-primary-rounded">
            Save <span><i class="fa fa-save"></i></span>
        </button>
    </div>
</div>
