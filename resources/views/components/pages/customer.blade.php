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
                            <td>{{ $loop->iteration }}</td>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#myModal-{{ $clients->id }}" data-toggle="tooltip" title="Delete Customer">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!--start Modal for delete customer-->
                        <div class="modal fade" id="myModal-{{ $clients->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $clients->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel-{{ $clients->id }}">Delete Customer</h5>
                                        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="DELETE" action="{{ route('change_customer_status', $clients->id) }}" id="edit_delivered">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Are you sure you want to delete this customer?</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-2">
                                            <button class="btn btn-secondary w-25" data-bs-dismiss="modal" type="button">No</button>
                                            <button class="btn btn-primary w-25" type="submit">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End endedit modal for delete customer -->
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
