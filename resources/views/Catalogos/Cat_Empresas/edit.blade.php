@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Editar Empresa: {{$Compania->emp}}</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		
		{!!Form::model($Compania,['method'=>'PATCH', 'route'=>['Cat_Empresas.update',$Compania->id_compania]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="compania">Empresa</label>
				<input type="text" name="compania" class="form-control" value="{{$Compania->compania}}" placeholder="Nombre de la compañia...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/Catalogos/Cat_Empresas" class="btn btn-danger">Cancelar</a>
			</div> 	
		{!!Form::close()!!}
	</div>
</div>
@endsection