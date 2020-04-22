<!DOCTYPE html>
<html>
<head>
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
    @foreach($contratistas as $contratista)
        <tr>
            <td>{{ $contratista->nombre }}</td>
            <td>
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($contratista->id_contratista, 'QRCODE', 5,5)}}"
                     alt="barcode"/>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>