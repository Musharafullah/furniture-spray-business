<html>

<head>
    <x-header />
    @yield('title')
</head>

<body>

    <!----------------------- Header ------------------------------->
    <x-navbar />
    <!----------------------- End Header ------------------------------->


    @yield('content')
    @if (\Auth::check())
        @php
            
            $admin = App\Models\User::where('id', Auth::user()->id)->first();
        @endphp

        <!--start Modal for Update admin profile-->
        <div aria-hidden="true" aria-labelledby="EditProfile" class="modal fade" id="updateprofile" role="dialog"
            tabindex="-1" style="margin-top:100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin_update') }}">
                            @csrf
                            <div class="modal-header">
                                <h3><span id="form_output" class="alert-info"></span></h3>
                                <h6><span id="errors" class="alert-danger"></span></h6>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <h3 class="modal-title">Update Profile</h3>
                                    </div>
                                    <div class="col-sm-6">
                                        <button aria-label="Close" class="close" data-dismiss="modal"
                                            type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="admin-name">Name</label>
                                            <input id="admin-name" name="name" class="form-control" type="text"
                                                placeholder="Enter Name" value="{{ $admin->name }}">
                                            @if ($errors->has('admin-name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('admin-name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="admin-email">Email</label>
                                            <input id="admin-email" name="email" class="form-control" type="email"
                                                placeholder="Enter Email" value="{{ $admin->email }}">
                                            @if ($errors->has('admin-email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('admin-email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="admin-password">Password</label>
                                            <input id="admin-password" name="password" class="form-control"
                                                type="password" placeholder="Enter Password">
                                            @if ($errors->has('admin-password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('admin-password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="admin-address">Address</label>
                                            <textarea class="form-control" name="address" rows="5">{{ $admin->address }}</textarea>
                                            @if ($errors->has('admin-address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong
                                                        class="text-danger">{{ $errors->first('admin-address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button> --}}
                                    <button class="btn btn-primary" type="submit" id="edit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-scripts />
    @yield('scripts')
</body>

</html>
