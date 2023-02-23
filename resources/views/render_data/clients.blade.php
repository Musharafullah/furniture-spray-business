<option value=""> -- Select Customer --</option>
@foreach ($data as $client)
    <option value='{{ $client->id }}'>{{ $client->name }}</option>
@endforeach
