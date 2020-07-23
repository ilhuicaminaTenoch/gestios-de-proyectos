@extends('layouts.master_pdf')
@section('content')
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
@endsection