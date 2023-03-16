<div class="deliver-charges py-5">
    <div class="container">
        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Delivery charges</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($datadetail)
                    @foreach ($datadetail as $key => $datadetail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>£{{ number_format($datadetail->total_charges, 2) }}</td>
                            <td>
                                <div>
                                    <a href="" data-bs-toggle="modal" data-bs-toggle="modal"
                                        data-bs-target="#delivery" title="Edit">
                                        <i class="fa fa-pencil"></i>
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
<div aria-hidden="true" aria-labelledby="DeliveryModal" class="modal fade in" id="delivery" role="dialog"
    tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="">
                @csrf
                <input type="hidden" name="quote_create" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Update Delivery Charges</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Delivery(£)</label>
                                <input id="name" name="total_charges" class="form-control" type="text"
                                    placeholder="Enter Delivery" value="{{ number_format($datadetail->total_charges, 2) }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    {{-- <button class="btn-primary" type="submit" id="add">Add Customer</button> --}}
                    <button class="btn-primary" type="submit" id="">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
