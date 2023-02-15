<div class="product mt-5">
    <div class="container">
        <a href="{{ route('product.create') }}" class="btn btn-primary pull-right">
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

                @if ($datadetail)

                    @foreach ($datadetail as $key => $product)
                        {{-- @dd($product->product_image_path) --}}
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td class="text-center">
                                <img src="{{ asset('product_image/product/' . $product->product_image_path) }}">
                            </td>
                            <td>{{ $product->cost_from_supplier }}</td>
                            <td>{{ $product->sale_net_sqm }}</td>
                            <td>{{ $product->type }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('product.edit', $product->id) }}" data-toggle="tooltip"
                                        title="Edit Product">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('product_duplicate', $product->id) }}" data-toggle="tooltip"
                                        title="Duplicate Product">
                                        <i class="fa fa-copy"></i>
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
