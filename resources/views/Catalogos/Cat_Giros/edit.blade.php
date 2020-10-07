@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Giro: {{$Giro->giro}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		
		{!!Form::model($Giro,['method'=>'PATCH', 'route'=>['Cat_Giros.update',$Giro->id_giro]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="giro">Giro</label>
				<input type="text" name="giro" class="form-control" value="{{$Giro->giro}}" placeholder="Nombre del Giro...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Giros" class="btn btn-danger">Cancelar</a>
			</div> 	
		{!!Form::close()!!}
	</div>
</div>
@endsection