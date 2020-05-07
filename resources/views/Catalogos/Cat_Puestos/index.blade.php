@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Puestos <a href="/Catalogos/Cat_Puestos/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('Catalogos.Cat_Puestos.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Puesto</th>
					<th>Activo</th>
					<th>Opciones</th>
				</thead>
				@foreach ($Puesto as $pues)
				<tr>
					<td>{{$pues->id_puesto}}</td>
					<td>{{$pues->puesto}}</td>
					@if ($pues->activo==1)
						<td>Activo</td>
					@else
						<td>Inactivo</td>
					@endif
					<td>

						<a href="{{URL::action('PuestoController@edit',$pues->id_puesto)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$pues->id_puesto}}" data-toggle="modal">
						<button class="btn btn-danger">Activo/Inactivo</button></a>
					</td>
				</tr>
				@include('Catalogos.Cat_Puestos.modal')
				@endforeach
			</table>
		</div>
		{{$Puesto->render()}}
	</div>
</div>

@endsection