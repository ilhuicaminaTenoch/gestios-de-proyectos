@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		@include('Codigos.QR.search')
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
					<th>Opción</th>
				</thead>				
				@foreach ($Contratistas as $compa)
				<tr>
					<td>{{$compa->id_contratista}}</td>
					<td>{{$compa->nombre}}</td>
					<td>{{$compa->compania}}</td>
                     
					<td>

						<a href="{{URL::action('HabilidadesController@Buscar',$compa->id_contratista)}}"><button class="btn btn-info">Descargar</button></a>
					</td>

					
				</tr>
				@endforeach
			</table>

		</div>
		{{$Contratistas->appends(Request::only(['searchText']))->render()}}
	</div>
</div>
 {{-- <div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> <a href="/pdfDownloadH"><button class="btn btn-primary">Descargar</button></a></h3>
	</div>
</div> --}}
@endsection
