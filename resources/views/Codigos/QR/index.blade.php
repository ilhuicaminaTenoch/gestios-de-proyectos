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
					<th>Opción</th>
				</thead>				
				@foreach ($Compania as $compa)
				<tr>
					<td>{{$compa->id_compania}}</td>
					<td>{{$compa->compania}}</td>
					<td>

						<a href="{{URL::action('HabilidadesController@Buscar',$compa->id_compania)}}"><button class="btn btn-info">Descargar</button></a>
					</td>
					
				</tr>
				@endforeach
			</table>
		</div>
		{{$Compania->render()}}
	</div>
</div>
{{-- <div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> <a href="/pdfDownloadH"><button class="btn btn-primary">Descargar</button></a></h3>
	</div>
</div>
 --}}@endsection
