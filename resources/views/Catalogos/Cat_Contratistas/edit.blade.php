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
                <div class="box-header with-border">
                    <h3 class="box-title">Editar </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                {!!Form::model($Contratistas,['method'=>'PATCH', 'route'=>['Cat_Contratistas.update',$Contratistas[0]->id_contratista], 'class'=>'form-horizontal'])!!}
                {{Form::token()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" name="nombre" class="form-control" value="{{$Contratistas[0]->nombre}}"
                                       placeholder="Nombre del contratista...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Compañia</label>

                            <div class="col-sm-10">
                                <select id="id_compania" name="id_compania" class="form-control">
                                    @foreach ($Compania as $comp)
                                        @if($comp->id_compania==$Contratistas[0]->id_compania)
                                            <option value="{{ $comp->id_compania }}" selected>{{ $comp->compania }}</option>
                                        @else
                                            <option value="{{ $comp->id_compania }}">{{ $comp->compania }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Puesto</label>

                            <div class="col-sm-10">
                                <select id="id_puesto" name="id_puesto" class="form-control">
                                    @foreach ($Puesto as $pue)
                                        @if($pue->id_puesto==$Contratistas[0]->id_puesto)
                                            <option value="{{ $pue->id_puesto }}" selected>{{ $pue->puesto }}</option>
                                        @else
                                            <option value="{{ $pue->id_puesto }}">{{ $pue->puesto }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>

                            <div class="col-sm-10">
                                <select id="tipo" name="tipo" class="form-control">

                                    @if($Contratistas[0]->tipo==1)
                                        {
                                        <option value="{{$Contratistas[0]->tipo}}" selected>Tipo{{$Contratistas[0]->tipo}}</option>
                                        <option value="2">Tipo2</option>
                                        }


                                    @else
                                        {
                                        <option value="{{$Contratistas[0]->tipo}}" selected>Tipo{{$Contratistas[0]->tipo}}</option>
                                        <option value="1">Tipo1</option>
                                        }

                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Seguro Social</label>

                            <div class="col-sm-10">

                                <input type="text" name="nss" class="form-control" value="{{$Contratistas[0]->nss}}" placeholder="Seguro Social...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Motivos</label>

                            <div class="col-sm-10">
                                <input type="text" name="motivos" class="form-control"  placeholder="Motivos...">

                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="radio">
                                <label class="col-sm-2 control-label">
                                    <input type="radio" class="optionsRadios" name="optionsRadios" value="1" @if($Contratistas[0]->suspendido == 1) checked @endif >
                                    Suspender
                                </label>
                                <label class="col-sm-2 control-label">
                                    <input type="radio" class="optionsRadios" name="optionsRadios" value="0" @if($Contratistas[0]->suspendido == 0) checked @endif>
                                    Reanudar
                                </label>
                                
                            </div>
                        </div>
                        <div id="grupo-fechas" @if($Contratistas[0]->suspendido == 1) style="display:block;" @else style="display:none;" @endif>
                            <div class="form-group">
                                <label for="inicio" class="col-sm-2 control-label">Fecha de inicio</label>
                                <input type="date" id="inicio" name="inicio" value="{{ $Contratistas[0]->fechaISuspencion }}">
                            </div>
                            <div class="form-group">
                                <label for="fin" class="col-sm-2 control-label">Fecha de fin</label>
                                <input type="date" id="fin" name="fin" value="{{ $Contratistas[0]->fechaFSuspencion }}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="/Catalogos/Cat_Contratistas" class="btn btn-danger">Cancelar</a>
                        <button class="btn btn-info pull-right" type="submit">Guardar</button>
                    </div>
                    <!-- /.box-footer -->
                {!!Form::close()!!}
            </div>
        </div>
        
       
    </div>

@endsection