<option value="">-- Select Customer --</option>
@foreach ($data as $client)
    <option value='{{ $client->id }}'>{{ $client->name }}</option>
@endforeach


{{-- <div class="col-12 col-md-6">
    <div class="form-group">
        <label for="cust-name">Name</label>
        <input id="cust-name" name="cust-name" class="form-control" type="text" placeholder="Enter Name" value=""
            readonly="">
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label for="cust-phone">Telephone</label>
        <input id="cust-phone" name="cust-phone" class="form-control" type="number" placeholder="Enter Number"
            readonly="">
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label for="cust-email">Email</label>
        <input id="cust-email" name="cust-email" class="form-control" type="email" placeholder="Enter Email"
            readonly="">
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="form-group">
        <label for="cust-postcode">Billing Postcode</label>
        <input id="cust-postcode" name="cust-postcode" class="form-control" type="text" placeholder="Postcode"
            readonly="">
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <label for="cust-address">Address</label>
        <textarea id="cust-address" class="form-control" rows="3" placeholder="Enter Address" readonly=""></textarea>
    </div>
</div> --}}
