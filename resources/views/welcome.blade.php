<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <title></title>
</head>

<body>
    <div class="login-page">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="mt-4 d-flex justify-content-center">
                        <img src="assets/images/logo.jpg">
                    </div>
                    <div class="row">
                        <div class="col-11 col-md-10 col-lg-8">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="my-5">
                                    <h4>Admin Login</h4>
                                </div>
                                <div class="input-group my-2" id="email-container">
                                    <div class="input-group-text" id="email-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group my-2" id="password-container">
                                    <div class="input-group-text" id="password-icon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" required
                                        autocomplete="current-password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    {{-- <button class="btn btn-primary" type="submit">
                                        Login
                                    </button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#email").focus(function() {
                //$("#password-container").removeClass("login-input-animation");
                //$("#email-container").addClass("login-input-animation");
                $("#password-icon").removeClass("focus-icon");
                $("#email-icon").addClass("focus-icon");
            });

            $("#password").focus(function() {
                //$("#email-container").removeClass("login-input-animation");
                //$("#password-container").addClass("login-input-animation");
                $("#email-icon").removeClass("focus-icon");
                $("#password-icon").addClass("focus-icon");
            });

            $("#password").focus(function() {
                //$("#email-container").removeClass("login-input-animation");
                //$("#password-container").addClass("login-input-animation");
                $("#email-icon").removeClass("focus-icon");
                $("#password-icon").addClass("focus-icon");
            });
        });
    </script>
</body>

</html>
