@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Responsables <a href="/Catalogos/Cat_Responsables/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Catalogos.Cat_Responsables.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Responsable</th>
					<th>Activo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($Responsable as $res)
				<tr>
					<td>{{$res->id_responsable}}</td>
					<td>{{$res->responsable}}</td>
					@if ($res->activo==1)
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif
					<td>

						<a href="{{URL::action('ResponsableController@edit',$res->id_responsable)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$res->id_responsable}}" data-toggle="modal">
						<button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Catalogos.Cat_Responsables.modal')
				@endforeach
			</table>
		</div>
		{{$Responsable->appends(Request::only(['searchText']))->render()}}
	</div>
</div>

@endsection