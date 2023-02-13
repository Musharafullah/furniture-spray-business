@extends('dashboardlayouts.master')
@section('title')
    <title>Add Product</title>
@endsection

@section('content')
    <div class="product-add-edit py-3">
        <div class="container">
            <div class="card">
                @if ($errors->any())
                    @error('product_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                @endif
                <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>Create Product</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 col-sm-10 col-xlg-11">
                                <div class="form-group">
                                    <select class="form-select" name="type">
                                        {{-- <option value=""> -- Select Product Type --</option> --}}
                                        <option value="Full Featured">Full Featured</option>
                                        <option value="Partial Featured" selected>Partial Featured</option>
                                        <option value="Non Featured">Non Featured</option>
                                        <option value="Non Glass">Non Glass</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-3 col-sm-2 col-xl-1">
                                <div class="form-group">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#productdetail"><i
                                            class="fa fa-question-circle"></i> Help</a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="product_image">Product Image</label>
                                <input type="file" name="product_image" id="product_image" class="dropify" />
                                @if ($errors->any())
                                    @error('product_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input id="code" name="code" class="form-control" type="text"
                                        placeholder="Enter Code" value="">
                                </div>
                                @if ($errors->any())
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product_name">Title</label>
                                    <input id="product_name" name="product_name" class="form-control" type="text"
                                        placeholder="Enter Product Name" value="">
                                </div>
                                @if ($errors->any())
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cost_from_supplier">Cost From Supplier</label>
                                    <input id="cost_from_supplier" name="cost_from_supplier" class="form-control"
                                        type="number" placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('cost_from_supplier')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="sale_net_sqm">Sale Net Per SQM</label>
                                    <input id="sale_net_sqm" name="sale_net_sqm" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('sale_net_sqm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cut_out">Cut Out</label>
                                    <input id="cut_out" name="cut_out" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('cut_out')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="notch">Notch</label>
                                    <input id="notch" name="notch" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('notch')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="hole">Hole</label>
                                    <input id="hole" name="hole" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('hole')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="rake">Rake</label>
                                    <input id="rake" name="rake" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('rake')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="radius_corners">Radius Corners</label>
                                    <input id="radius_corners" name="radius_corners" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('radius_corners')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="printed">Printed</label>
                                    <input id="printed" name="printed" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('printed')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="painted">Painted</label>
                                    <input id="painted" name="painted" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('painted')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="sparkle_finish">Sparkle Finish</label>
                                    <input id="sparkle_finish" name="sparkle_finish" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('sparkle_finish')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="metallic_finish">Metallic Finish</label>
                                    <input id="metallic_finish" name="metallic_finish" class="form-control"
                                        type="number" placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('metallic_finish')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cnc">CNC</label>
                                    <input id="cnc" name="cnc" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('cnc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="standblasted">Sandblasted</label>
                                    <input id="standblasted" name="standblasted" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('standblasted')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ritec">Ritec</label>
                                    <input id="ritec" name="ritec" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('ritec')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="bevel_edges">Bevel Edges</label>
                                    <input id="bevel_edges" name="bevel_edges" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                                @if ($errors->any())
                                    @error('bevel_edges')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product_note">Note</label>
                                    <textarea id="product_note" name="product_note" class="form-control" placeholder="Add Product Note" rows="5"></textarea>
                                </div>
                                @if ($errors->any())
                                    @error('product_note')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <div class="row d-flex button-container">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary-rounded">
                                    Save <span><i class="fa fa-save"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
