@extends('dashboardlayouts.master')
@section('title')
    <title>Create quote</title>
@endsection
@section('content')
    <!----------------------- Header ------------------------------->
    <!----------------------- End Header ------------------------------->


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
                                <label for="cust-name">Name</label>
                                <input id="cust-name" name="cust-name" class="form-control" type="text"
                                    placeholder="Enter Name" value="" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-phone">Telephone</label>
                                <input id="cust-phone" name="cust-phone" class="form-control" type="number"
                                    placeholder="Enter Number" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-email">Email</label>
                                <input id="cust-email" name="cust-email" class="form-control" type="email"
                                    placeholder="Enter Email" readonly="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="cust-postcode">Billing Postcode</label>
                                <input id="cust-postcode" name="cust-postcode" class="form-control" type="text"
                                    placeholder="Postcode" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="cust-address">Address</label>
                                <textarea id="cust-address" class="form-control" rows="3" placeholder="Enter Address" readonly=""></textarea>
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
                                        <select class="form-select" id="product-code">
                                            <option value=""> -- Select One --</option>
                                            <option value="">12AET</option>
                                            <option value="">11LET</option>
                                            <option value="">12AEP</option>
                                            <option value="">12AEI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="products">Products</label>
                                        <select class="form-select" id="products">
                                            <option value=""> -- Select One --</option>
                                            <option value="">6mm Low Iron Toughened Back-Painted Solid, Foil backed,
                                                Glass</option>
                                            <option value="">15mm Low-Iron Toughened PAR Glass</option>
                                            <option value="">17.5mm Toughened Laminated Glass PAR</option>
                                            <option value="">21.5mm Toughened Laminated Glass</option>
                                            <option value="">21.5mm Toughened Laminated Glass</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="product-width">Width</label>
                                        <input id="product-width" name="width" class="form-control" type="number"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="product-height">Height</label>
                                        <input id="product-height" name="height" class="form-control" type="number"
                                            placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="product-sqm">SQM</label>
                                        <input id="product-sqm" name="sqm" class="form-control" type="number"
                                            placeholder="" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="cutout">Cut Out</label>
                                        <select name="cutout" id="cutout" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="notch">Notches</label>
                                        <select name="notch" id="notch" class="form-select ">
                                            <option value=""> -- Select One --</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">More</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="hole">Holes</label>
                                        <select name="hole" id="hole" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">1</option>
                                            <option value="">2</option>
                                            <option value="">3</option>
                                            <option value="">4</option>
                                            <option value="">5</option>
                                            <option value="">6</option>
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

                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="cnc">CNC Shape</label>
                                        <select name="cnc" id="cnc" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="sandblasted">Sand Blasted</label>
                                        <select name="sandblasted" id="sandblasted" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="ritec">Ritec</label>
                                        <select name="ritec" id="ritec" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="bevel_edges">Bevel Edges</label>
                                        <select name="bevel_edges" id="bevel_edges" class="form-select">
                                            <option value=""> -- Select One --</option>
                                            <option value="">Yes</option>
                                            <option value="">No</option>
                                        </select>
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
                                        <label for="trade-discount">Trade_discount (%)</label>
                                        <input id="trade-discount" name="trade-discount" class="form-control"
                                            type="number" placeholder="" value="" min="0">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="total-gross">Gross Total</label>
                                        <input id="total-gross" name="total-gross" class="form-control" type="number"
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
                <form method="" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                        placeholder="Enter Name" value="">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input id="phone" name="phone" class="form-control" type="number"
                                        placeholder="Enter Number" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        placeholder="Enter Email" value="">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="postal_code">Billing Postcode</label>
                                    <input id="postal_code" name="postal_code" class="form-control" type="text"
                                        placeholder="Postcode" value="">
                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <div class="form-group">
                                    <label for="trade_discount">Trade Discount</label>
                                    <select name="trade_discount" id="trade_discount" class="form-select">
                                        <option value="">-- Select One --</option>
                                        <option value="">5%</option>
                                        <option value="">10%</option>
                                        <option value="">15%</option>
                                        <option value="">20%</option>
                                        <option value="">25%</option>
                                        <option value="">30%</option>
                                        <option value="">35%</option>
                                        <option value="">40%</option>
                                        <option value="">45%</option>
                                        <option value="">50%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" class="form-control" rows="3" placeholder="Enter Address" name="address"></textarea>
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


    <!----------------- Update Profile Modal ------------------>
    <div aria-hidden="true" aria-labelledby="EditProfile" class="modal modal-lg fade in" id="updateprofile"
        role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Profile</h5>
                        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                        placeholder="Enter Name" value="Admin">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        placeholder="Enter Email" value="majidfazal@gmail.com">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" class="form-control" type="password"
                                        placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" class="form-control" name="address" rows="5">london</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit" id="edit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!----------------- End Update Profile Modal ------------------>
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
        });
    </script>
@endsection
