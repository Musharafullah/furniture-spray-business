<div class="product py-5">
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
                    <th>Sale Net SQM(£)</th>
                    <th>Matt Finish(£)</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if ($datadetail)
                    @foreach ($datadetail as $key => $product)
                        @php
                            $type = $product->type;
                            $pro_type = str_replace('_', ' ', $type);
                            $pro_type = ucwords($pro_type);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td class="text-center">
                                <img src="{{ asset('product_image/product/' . $product->product_image_path) }}">
                            </td>
                            <td>{{ number_format($product->sale_net_sqm, 2) }}</td>
                            <td>{{ number_format($product->matt_finish, 2) }}</td>
                            <td>{{ $pro_type }}</td>
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
