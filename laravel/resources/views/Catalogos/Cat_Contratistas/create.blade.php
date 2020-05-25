@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Contratista:</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!!Form::open(array('url'=>'Catalogos\Cat_Contratistas','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del contratista...">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Compañia</label>
                        <select id="id_compania" name="id_compania" class="form-control">
                            @foreach ($Compania as $comp)
                                <option value="{{ $comp->id_compania }}">{{ $comp->compania }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Puesto</label>
                        <select id="id_puesto" name="id_puesto" class="form-control">
                            @foreach ($Puesto as $pue)
                                <option value="{{ $pue->id_puesto }}">{{ $pue->puesto }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select id="tipo" name="tipo" class="form-control">

                            <option value="1">Tipo1</option>
                            <option value="2">Tipo2</option>

                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="RFC">Seguro Social</label>
                        <input type="text" name="RFC" class="form-control" placeholder="RFC...">
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a href="/Catalogos/Cat_Contratistas" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
@endsection
