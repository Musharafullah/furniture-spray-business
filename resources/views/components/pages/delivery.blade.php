<div class="deliver-charges py-5">
    <div class="container">
        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Total Charges</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($datadetail)
                    @foreach ($datadetail as $key => $datadetail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $datadetail->total_charges }}</td>
                            <td>
                                <div>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#editdeliverycharges"
                                        title="Edit">
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
