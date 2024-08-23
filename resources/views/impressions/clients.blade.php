<table border="1">

    <thead>
        <tr>

            <th>Name</th>
            <th>Age</th>
            <th>Tel</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{$client->user->getFullName()}}</td>
            <td>{{$client->user->age}}</td>
            <td>{{$client->user->tel}}</td>
        </tr>

        @endforeach
    </tbody>
</table>