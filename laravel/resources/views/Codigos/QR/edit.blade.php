@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Compañia</th>
                </thead>

                @foreach ($Compania as $compa)
                <tr>
                    <td>{{$compa->id_contratista}}</td>
                    <td>{{$compa->nombre}}</td>
                    
                    
                </tr>
                @endforeach
            </table>
        </div>
        {{$Compania->render()}}
    </div>
</div>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        {{-- <a href="{{URL::action('BarrasController@buscar',$comp->id_compania)}}"><button class="btn btn-info">Buscar</button></a>
         --}}{{-- <h3> <a href={{URL::action('BarrasController@pdfDownload')}}><button class="btn btn-primary">Descargar</button></a></h3> --}}
    </div>
</div>
@endsection
