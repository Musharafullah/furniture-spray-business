@extends('dashboardlayouts.master')
@section('title')
    <title>Edit Guest Item</title>
@endsection
@section('content')
    <div class="create-quote py-3">
        <div class="container">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12">
                            <h3>Update Guest Item</h3>
                        </div>
                    </div>
                    <div>
                        <form method="post" action="{{ route('guestItem.update', $deal->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mt-4">
                                        <label for="guest_title_edit">Title</label>
                                        <input id="guest_title_edit" name="title" class="form-control" type="text"
                                            placeholder="Enter Title" value="{{ $deal->guest->title }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mt-4">
                                        <label for="guest_price_edit">Price</label>
                                        <input id="guest_price_edit" name="price" class="form-control" type="number"
                                            placeholder="Enter Price" value="{{ $deal->guest->price }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mt-4">
                                        <label for="guest_quantity_edit">Quantity</label>
                                        <input id="guest_quantity_edit" name="quantity" class="form-control" type="number"
                                            placeholder="Enter Quantity" value="{{ $deal->quantity }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mt-4">
                                        <label for="description_edit">Description</label>
                                        <textarea id="description_edit" name="description" class="form-control" rows="4"
                                            placeholder="Enter Description" value="" required>{{ $deal->guest->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="guest_discount_edit">Trade_discount (%)</label>
                                        <input id="guest_discount_edit" name="trade_discount" class="form-control" type="number"
                                            placeholder="Enter Number" value="{{ $deal->trade_discount }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="guest_net_price_edit">Net Price</label>
                                        <input id="guest_net_price_edit" name="net_price" class="form-control" value="{{ $deal->net_price }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="guest_vat_edit">Vat</label>
                                        <input id="guest_vat_edit" name="vat" class="form-control" value="{{ $deal->vat }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="guest_total_price_edit">Total Price</label>
                                        <input id="guest_total_price_edit" name="total_price" class="form-control" value="{{ $deal->total_gross }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 ms-auto mt-5">
                                    <button type="submit" class="btn btn-primary-rounded">
                                        Update item <span><i class="fa fa-save"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
        $('#guest_price_edit, #guest_quantity_edit, #guest_discount_edit').on('keyup', function(event) {
            calculate_guest_gross_edit();
        });

        function calculate_guest_gross_edit() {
            var quantity = Number($('#guest_quantity_edit').val());
            var basic_net = Number($('#guest_price_edit').val());
            var discount = Number($('#guest_discount_edit').val());

            var net = Number(quantity * basic_net);
            var vat = (20 * net) / 100;
            var gross = net + vat;

            var net_discount = (discount * gross) / 100;
            var total_gross = gross - net_discount;

            var net_discount1 = (discount * net) / 100;
            var total_net = net - net_discount1;

            var vat_discount = (discount * vat) / 100;
            var total_vat = vat - vat_discount;

            $('#guest_net_price_edit').val(total_net.toFixed(2));
            $('#guest_vat_edit').val(total_vat.toFixed(2));
            $('#guest_total_price_edit').val(total_gross.toFixed(2));
        }
    </script>    
@endsection
