@extends('layouts.master_pdf')
@section('content')
    <table class="table">
        <tbody>
            <tr>
                <th>Nombre</th>
                <th>Induccion</th>
                <th>Examen Medico</th>
            </tr>
            @foreach($datum as $data)
            <tr>
           
                <td>{{ $data->Contratistas }}</td>
                <td>{{ $data->induccion }}</td>
                <td>{{ $data->examen_medico }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection