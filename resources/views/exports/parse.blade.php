<table>
    <thead>
        <tr>
            <th>Название</th>
            <th>Дата регистрации</th>
            <th>ИНН</th>
            <th>Статус</th>
            <th>ОПФ</th>
            <th>СООГУ</th>
            <th>ОКЭД</th>
            <th>Уставный фонд</th>
            <th>Телефон</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item[0] ?? "Отсутствует" }}</td>
            <td>{{ $item[1] ?? "Отсутствует" }}</td>
            <td>{{ $item[2] ?? "Отсутствует" }}</td>
            <td>{{ $item[3] ?? "Отсутствует" }}</td>
            <td>{{ $item[4] ?? "Отсутствует" }}</td>
            <td>{{ $item[5] ?? "Отсутствует" }}</td>
            <td>{{ $item[6] ?? "Отсутствует" }}</td>
            <td>{{ $item[7] ?? "Отсутствует" }}</td>
            <td>{{ $item[8] ?? "Отсутствует" }}</td>
        </tr>
        @endforeach
    </tbody>
</table>