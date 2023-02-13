<div class="product mt-5">
    <div class="container">
        <a href="{{ route('add_product') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Add New Product
        </a>
        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th width="100">Image</th>
                    <th>Cost From Supplier</th>
                    <th>Sale Net SQM</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>40</td>
                    <td>34564700020</td>
                    <td>10mm Tinted Grey Toughened PAR Glass</td>
                    <td class="text-center">
                        <img src="{{ asset('assets/images/logo.jpg') }}">
                    </td>
                    <td>12.15</td>
                    <td>25</td>
                    <td>Non Glass</td>
                    <td>
                        <div>
                            <a href="" data-toggle="tooltip" title="Edit Product">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="" data-toggle="tooltip" title="Duplicate Product">
                                <i class="fa fa-copy"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>46</td>
                    <td>10074700020</td>
                    <td>10mm Acid Etched Toughened PAR Glass</td>
                    <td class="text-center">
                        <img src="{{ asset('assets/images/logo.jpg') }}">
                    </td>
                    <td>12.15</td>
                    <td>25</td>
                    <td>Non Glass</td>
                    <td>
                        <div>
                            <a href="" data-toggle="tooltip" title="Edit Product">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="" data-toggle="tooltip" title="Duplicate Product">
                                <i class="fa fa-copy"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
