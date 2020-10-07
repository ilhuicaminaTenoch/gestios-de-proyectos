@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva Compañia:</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif

		{!!Form::open(array('url'=>'Catalogos\Cat_Empresas','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="compania">Compañia</label>
				<input type="text" name="compania" class="form-control" placeholder="Nombre de la Empresa...">
				
			</div>
			<div class="form-group">
                    <label>Giro</label>
                    <select id="id_giro" name="id_giro" class="form-control">
                        @foreach ($Giro as $gir)
                            <option value="{{ $gir->id_giro }}">{{ $gir->giro }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <label>Responsable</label>
                    <select id="id_responsable" name="id_responsable" class="form-control">
                        @foreach ($Responsable as $resp)
                            <option value="{{ $resp->id_responsable }}">{{ $resp->responsable }}</option>
                        @endforeach
                    </select>
            </div>
			<div class="form-group">
                    <label>Proyecto</label>
                    <select id="id_proyecto" name="id_proyecto" class="form-control">
                        @foreach ($Proyecto as $pro)
                            <option value="{{ $pro->id_proyecto }}">{{ $pro->proyecto }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <label>Área</label>
                    <select id="id_area" name="id_area" class="form-control">
                        @foreach ($Area as $are)
                            <option value="{{ $are->id_area }}">{{ $are->area }}</option>
                        @endforeach
                    </select>
            </div>



			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Empresas" class="btn btn-danger">Cancelar</a>
			</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection