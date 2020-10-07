@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Proyectos <a href="/Catalogos/Cat_Tipo_Proyecto/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Catalogos.Cat_Tipo_Proyecto.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Proyecto</th>
					<th>Activo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($Proyecto as $pro)
				<tr>
					<td>{{$pro->id_proyecto}}</td>
					<td>{{$pro->proyecto}}</td>
					@if ($pro->activo==1)
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif
					<td>

						<a href="{{URL::action('TipoProyectoController@edit',$pro->id_proyecto)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$pro->id_proyecto}}" data-toggle="modal">
						<button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Catalogos.Cat_Tipo_Proyecto.modal')
				@endforeach
			</table>
		</div>
		{{$Proyecto->appends(Request::only(['searchText']))->render()}}
	</div>
</div>

@endsection