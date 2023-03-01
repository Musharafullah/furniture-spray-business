<div class="product py-5">
    <div class="container">
        <a href="{{ route('customer.create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add New Customer
        </a>
        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Postal Code</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($datadetail)
                    @foreach ($datadetail as $key => $clients)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $clients->name }}</td>
                            <td>{{ $clients->email }}</td>
                            <td>{{ $clients->phone }}</td>
                            <td>{{ $clients->postal_code }}</td>
                            <td>{{ $clients->address }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('customer.edit', $clients->id) }}" data-toggle="tooltip"
                                        title="Edit Customer">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('quote.show', $clients->id) }}" data-toggle="tooltip"
                                        title="View Related Quotes">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
