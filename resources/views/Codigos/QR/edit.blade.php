@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="col-md-6 col-xs-12">
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                {!!Form::model($Contratistas,['method'=>'PATCH', 'route'=>['QR.Buscar',$Contratistas->id_contratista], 'class'=>'form-horizontal'])!!}
                {{Form::token()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                            <label for="compania" class="col-sm-2 control-label">Compañia</label>

                        </div>
                    </div>
                    
                {!!Form::close()!!}
            </div>
        </div>
    </div>
@endsection
