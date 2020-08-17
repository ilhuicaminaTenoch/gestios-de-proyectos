@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Contratistas <a href="/Catalogos/Cat_Contratistas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Catalogos.Cat_Contratistas.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Compañia</th>
					<th>Puesto</th>
					<th>Tipo</th>
					<th>Seguro Social</th>
					{{-- <th>codigo</th> --}}
					<th>activo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($Contratistas as $contra)
				<tr>
					<td>{{$contra->id_contratista}}</td>
					<td>{{$contra->nombre}}</td>
					<td>{{$contra->compania}}</td>
					<td>{{$contra->puesto}}</td>
					<td>Tipo{{$contra->tipo}}</td>
					<td>{{$contra->nss}}</td>
					{{-- <td> {!! DNS1D::getBarcodeHTML($contra->nombre,"C128") !!}</td> --}}
					@if ($contra->activo==1)
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif

					<td>

						<a href="{{URL::action('ContratistaController@edit',$contra->id_contratista)}}"><button class="btn btn-info">Editar</button></a>
					</td>
					<td >
						<a href="{{URL::action('ContratistaController@agregarH',$contra->id_contratista)}}"><button class="btn btn-info">Habilidad</button></a>
					</td>
					<td >
						<a href="{{ URL::action('ContratistaController@destroyView', $contra->id_contratista) }}">
							<button class="btn btn-danger">Eliminar</button
						></a>
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$Contratistas->appends(Request::only(['searchText']))->render()}}
	</div>
</div>

@endsection