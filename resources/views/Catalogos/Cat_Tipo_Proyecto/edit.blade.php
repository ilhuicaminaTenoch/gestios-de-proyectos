@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Proyecto: {{$Proyecto->proyecto}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		
		{!!Form::model($Proyecto,['method'=>'PATCH', 'route'=>['Cat_Tipo_Proyecto.update',$Proyecto->id_proyecto]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="proyecto">Proyecto</label>
				<input type="text" name="proyecto" class="form-control" value="{{$Proyecto->proyecto}}" placeholder="Nombre del Proyecto...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Tipo_Proyecto" class="btn btn-danger">Cancelar</a>
			</div> 	
		{!!Form::close()!!}
	</div>
</div>
@endsection