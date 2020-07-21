<!DOCTYPE html>
<html>
<head>
	<title>Hi</title>
</head>
<body>
    <table class="table">
        <tbody>
            <tr>
                <th>Contratista</th>
                <th>Entrada</th>
                <th>Salida</th>
            </tr>
            @foreach($datum as $data)
            <tr>
           
                <td>{{ $data->contratista }}</td>
                <td>{{ $data->fecha_inicial }}</td>
                <td>{{ $data->fecha_final }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>