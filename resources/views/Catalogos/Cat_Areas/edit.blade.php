@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Empresa: {{$Area->area}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		
		{!!Form::model($Area,['method'=>'PATCH', 'route'=>['Cat_Areas.update',$Area->id_area]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="area">Area</label>
				<input type="text" name="area" class="form-control" value="{{$Area->area}}" placeholder="Nombre del área...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Areas" class="btn btn-danger">Cancelar</a>
			</div> 	
		{!!Form::close()!!}
	</div>
</div>
@endsection