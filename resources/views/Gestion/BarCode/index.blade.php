@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <search-person :type="{{ json_encode($type)}}"></search-person>
    </div>
@endsection
