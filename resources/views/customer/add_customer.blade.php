@extends('dashboardlayouts.master')
@section('title')
    <title>Add Customer</title>
@endsection
{{-- @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif --}}
@section('content')
    <div class="client py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Add Customer</h4>
                        </div>
                    </div>
                    <form action="{{ route('customer.store') }}" method="post">
                        @csrf
                        @include('customer/_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // insert data into database through ajax
        $('#postal_code').on('keyup focus focusout change paste', function(event) {
            var postal_code = $('#postal_code').val();
            if (postal_code.length >= 5) {
                var geocoder = new google.maps.Geocoder();
                var address = document.getElementById("postal_code").value;
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        $('#latitude').val(latitude);
                        $('#longitude').val(longitude);
                    } else {
                        console.log("Request failed.")
                    }
                });
            }
        });
    </script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5sdMWvB4J4X8W9Z6fuiNNaKI1eYUXLK4"></script>
@endsection
