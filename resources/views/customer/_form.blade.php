<div class="row mt-3">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Name</label>
            @if ($client->name)
                <input id="name" name="name" class="form-control" type="text" placeholder="Enter Name"
                    value="{{ $client->name }}">
            @else
                <input id="name" name="name" class="form-control" type="text" placeholder="Enter Name"
                    value="">
            @endif
            @if ($errors->any())
                @if ($errors->has('name'))
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="phone">Phone</label>
            @if ($client->phone)
                <input id="phone" name="phone" class="form-control" type="number" placeholder="Enter Phone No"
                    value="{{ $client->phone }}">
            @else
                <input id="phone" name="phone" class="form-control" type="number" placeholder="Enter Phone No"
                    value="">
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="email">Email</label>
            @if ($client->email)
                <input id="email" name="email" class="form-control" type="email" placeholder="Enter Email"
                    value="{{ $client->email }}">
            @else
                <input id="email" name="email" class="form-control" type="email" placeholder="Enter Email"
                    value="">
            @endif
            @if ($errors->any())
                @if ($errors->has('email'))
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="postal_code">Billing Postcode</label>
            @if ($client->postal_code)
                <input id="postal_code" name="postal_code" class="form-control" type="text"
                    placeholder="Enter ZipCode" value="{{ $client->postal_code }}">
            @else
                <input id="postal_code" name="postal_code" class="form-control" type="text"
                    placeholder="Enter ZipCode" value="">
            @endif
            @if ($errors->any())
                @if ($errors->has('postal_code'))
                    <strong class="text-danger">{{ $errors->first('postal_code') }}</strong>
                @endif
            @endif
        </div>
    </div>
    <input type="hidden" id="latitude" name="latitude" value="{{ $client->latitude ?? old('latitude') }}">
    <input type="hidden" id="longitude" name="longitude" value="{{ $client->longitude ?? old('longitude') }}">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="trade_discount">Trade Discount</label>
            <select name="trade_discount" class="form-select">
                @php
                    $discount = [0, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                @endphp
                <option value=""> -- Select Product Type --</option>
                @foreach ($discount as $type)
                    @php
                        $select = old('trade_discount', $client->trade_discount) == $type ? 'selected' : '';
                    @endphp
                    <option value="{{ $type ?? old('trade_discount') }}" {{ $select }}>{{ $type }}
                    </option>
                @endforeach
            </select>
            @if ($errors->any())
                @if ($errors->has('trade_discount'))
                    <strong class="text-danger">{{ $errors->first('trade_discount') }}</strong>
                @endif
            @endif
            {{-- <option value=""> -- Select --</option>
                <option value="0">0</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option> --}}
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="address">Address</label>
            @if ($client->postal_code)
                <textarea name="address" id="address" class="form-control" rows="5">{{ $client->address }}</textarea>
            @else
                <textarea name="address" id="address" class="form-control" rows="5"></textarea>
            @endif

        </div>
    </div>
</div>
<div class="row d-flex button-container">
    <div class="col-sm-6">
        <button type="submit" class="btn btn-primary-rounded">
            Save <span><i class="fa fa-save"></i></span>
        </button>
    </div>
</div>
