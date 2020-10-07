@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Compañia:</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif

	    
		{!!Form::model($Compania,['method'=>'PATCH', 'route'=>['Cat_Empresas.update',$Compania[0]->id_compania], 'class'=>'form-horizontal'])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="compania" class="col-sm-2 control-label">Empresa</label>
				<div class="col-sm-10">
				<input type="text" name="compania" class="form-control" value="{{$Compania[0]->compania}}" placeholder="Nombre de la compañia...">
			</div>
			</div>
			<div class="form-group">
                            <label for="ip1" class="col-sm-2 control-label">Giro</label>

                            <div class="col-sm-10">
                                <select id="id_giro" name="id_giro" class="form-control">
                                    @foreach ($Giro as $gir)
                                        @if($gir->id_giro==$Compania[0]->id_giro)
                                            <option value="{{ $gir->id_giro }}" selected>{{ $gir->giro }}</option>
                                        @else
                                            <option value="{{ $gir->id_giro }}">{{ $gir->giro }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
            </div>
                        
                        <div class="form-group">
                            <label for="ip2" class="col-sm-2 control-label">Responsable</label>

                            <div class="col-sm-10">
                                <select id="id_responsable" name="id_responsable" class="form-control">
                                    @foreach ($Responsable as $resp)
                                        @if($resp->id_responsable==$Compania[0]->id_responsable)
                                            <option value="{{ $resp->id_responsable }}" selected>{{ $resp->responsable }}</option>
                                        @else
                                            <option value="{{ $resp->id_responsable }}">{{ $resp->responsable }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
            </div>
                        
            <div class="form-group">
                            <label for="ip3" class="col-sm-2 control-label">Proyecto</label>

                            <div class="col-sm-10">
                                <select id="id_proyecto" name="id_proyecto" class="form-control">
                                    @foreach ($Proyecto as $pro)
                                        @if($pro->id_proyecto==$Compania[0]->id_proyecto)
                                            <option value="{{ $pro->id_proyecto }}" selected>{{ $pro->proyecto }}</option>
                                        @else
                                            <option value="{{ $pro->id_proyecto }}">{{ $pro->proyecto }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
            </div>
                        
            <div class="form-group">
                            <label for="ip4" class="col-sm-2 control-label">Área</label>

                            <div class="col-sm-10">
                                <select id="id_area" name="id_area" class="form-control">
                                    @foreach ($Area as $are)
                                        @if($are->id_area==$Compania[0]->id_area)
                                            <option value="{{ $are->id_area }}" selected>{{ $are->area }}</option>
                                        @else
                                            <option value="{{ $are->id_area }}">{{ $are->area }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
            </div>
                        
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Empresas" class="btn btn-danger">Cancelar</a>
			</div> 	
		{!!Form::close()!!}
	</div>
	</div>


@endsection