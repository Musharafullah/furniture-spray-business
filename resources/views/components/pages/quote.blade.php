<div class="quotes py-5">
    <div class="container">
        <table class="table table-bordered nowrap no-footer w-100" id="example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Phone Number</th>
                    <th>Postal Code</th>
                    <th>Added On</th>
                    <th>Quote Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($datadetail)
                    @foreach ($datadetail as $quote)
                        <tr>
                            <td>MCG-0000{{ $quote->id }}</td>
                            <td>{{ $quote->client->name }}</td>
                            <td>{{ $quote->client->phone }}</td>
                            <td>{{ $quote->client->postal_code }}</td>
                            <td>{{ date('d-m-Y', strtotime($quote->created_at)) }}</td>
                            <td>
                                @php
                                    $quote_total = $quote->deals->sum('total_gross');
                                @endphp
                                {{ $quote_total }}</td>

                            <td>

                                <select name="status" id="quote-status"
                                    onchange="quoteStatus('{{ $quote->id ?? '' }}', this)" class="form-control"
                                    data-live-search="true" tabindex="-1" aria-hidden="true">
                                    @php
                                        $quote_status = ['draft', 'sent', 'reminder', 'paid-collected', 'paid-delivered', 'collect', 'delivered', 'expired'];
                                    @endphp
                                    <option value=""> -- Select Product Type --</option>
                                    @foreach ($quote_status as $status)
                                        @php
                                            $select = old('status', $quote->status) == $status ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $status }}" {{ $select }}>{{ $status }}
                                        </option>
                                    @endforeach
                                </select>

                            </td>

                            <td class="text-center">
                                <ul class="list-inline">

                                    <li>
                                        <a href="{{ route('quote.create', $quote) }}" data-toggle="tooltip"
                                            title="View Quote"><i class="fa fa-eye"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tooltip" title="Send & Download Quote"><i
                                                class="fa fa-location-arrow"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('quote_riplicate', $quote) }}" data-toggle="tooltip"
                                            title="Duplicate Quote"><i class="fa fa-copy"></i></a>
                                    </li>


                                </ul>

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@section('scripts')
    <script>
        // function quoteStatus(id) {
        //     var selectedValue = $('#quote-status').val();
        //     alert(selectedValue);

        //     // any other code you want to execute based on the selected value
        // }

        function quoteStatus(quoteId, select) {
            var quote_id = quoteId;
            var status = $(select).val();
            $.ajax({
                type: "GET",
                url: " {{ route('quote_status') }}",
                data: {
                    status: status,
                    quote_id: quote_id
                },
                success: function(data) {
                    console.log(data);
                    //console.log(data);
                    // console.log('ok')
                    // location.reload();
                }

            });

        }
    </script>
@endsection
