@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Áreas <a href="/Catalogos/Cat_Areas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Catalogos.Cat_Areas.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Área</th>
					<th>Activo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($Area as $area)
				<tr>
					<td>{{$area->id_area}}</td>
					<td>{{$area->area}}</td>
					@if ($area->activo==1)
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif
					<td>

						<a href="{{URL::action('AreaController@edit',$area->id_area)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$area->id_area}}" data-toggle="modal">
						<button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('Catalogos.Cat_Areas.modal')
				@endforeach
			</table>
		</div>
		{{$Area->appends(Request::only(['searchText']))->render()}}
	</div>
</div>

@endsection