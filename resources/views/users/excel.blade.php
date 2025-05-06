<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $val)
        <tr>
            <td>{{ $val->name }}</td>
            <td>{{ $val->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>