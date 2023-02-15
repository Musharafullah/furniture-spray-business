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


    <x-scripts />
    @yield('scripts')
</body>

</html>
