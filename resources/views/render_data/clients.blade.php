@if ($quote==null || $quote=='null')
    <option value="" disabled selected>-- Select Customer --</option>
    @foreach ($clients as $client)
        <option value='{{ $client->id }}'>{{ $client->name }}</option>
    @endforeach
@else
    @foreach ($clients as $client)
        <option value='{{ $client->id }}' {{ $client->id == $quote->client_id ? 'selected' : ''}}>{{ $client->name }}</option>
    @endforeach
@endif
