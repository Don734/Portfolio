<table>
    <thead>
        <tr>
            <th>СООГУ</th>
            <th>ОКЭД</th>
            <th>Уставный фонд</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach ($data as $item)
                <td>{{ $item }}</td>
            @endforeach
        </tr>
    </tbody>
</table>