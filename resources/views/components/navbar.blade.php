<nav class="navbar navbar-expand-xl navbar-default">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logo.jpg') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse navbar-ex1-collapse collapse in" id="navbarSupportedContent">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('home') }}" class="btn">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('customer.index') }}" class="btn">Customers</a>
                </li>
                <li>
                    <a href="{{ route('product.index') }}" class="btn">Products</a>
                </li>
                <li>
                    <a href="{{ route('quote.index') }}" class="btn">Quotes</a>
                </li>
                <li>
                    <a href="{{ route('home', 'delivery') }}" class="btn">Delivery Charges</a>
                </li>
                <li>
                    <a href="{{ route('home', 'reports') }}" class="btn">Report</a>
                </li>
                <li class="quote-btn-nav ">
                    <a class="btn btn-primary" href="{{ route('quote.create') }}">Create a Quote</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="btn" data-toggle="modal" data-target="#updateprofile"
                        id="update_profile">Update Profile</a>
                </li>
                <li>
                    <a href="" class="btn">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
