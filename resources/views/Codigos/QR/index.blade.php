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
					<th>Código</th>
				</thead>				
				@foreach ($Habilidades as $hab)
				<tr>
					<td>{{$hab->id_contratista}}</td>
					<td>{{$hab->nombre}}</td>
					<td> <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($hab->QR, 'QRCODE', 5,5)}}"
                              alt="barcode"/></td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$Habilidades->render()}}
	</div>
</div>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3> <a href="/pdfDownloadH"><button class="btn btn-primary">Descargar</button></a></h3>
	</div>
</div>
@endsection
