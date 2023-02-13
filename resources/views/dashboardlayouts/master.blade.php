<html>

<head>
    <x-header />
    @yield('title')
</head>

<body>

    <!----------------------- Header ------------------------------->
    <x-navbar />
    <!----------------------- End Header ------------------------------->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    @yield('content')


    <x-scripts />

</body>

</html>
