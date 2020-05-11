@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		@include('Codigos.Barras.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Código</th>
				</thead>

				@foreach ($Contratistas as $contra)
				@php $id =strval($contra->id_contratista);
				@endphp
				<tr>
					<td>{{$contra->id_contratista}}</td>
					<td>{{$contra->nombre}}</td>
					<td> <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($contra->nombre, 'QRCODE', 5,5)}}"
                              alt="barcode"/></td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$Contratistas->render()}}
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> <a href="/pdfDownload"><button class="btn btn-primary">Descargar</button></a></h3>
	</div>
</div>
@endsection
