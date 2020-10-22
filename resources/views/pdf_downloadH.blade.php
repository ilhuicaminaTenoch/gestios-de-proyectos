<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>

<table class="table table-striped">
    @foreach($Habilidades as $hab)
        <tr>
            <td>{{ $hab->nombre }}</td>
            <td>{{ $hab->compania }}</td>

            <td>
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($hab->QR)) !!} ">
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>
