@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Accesos</h3>
		@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
</div>
		
		<form action="/Catalogos/Cat_Contratistas/{{ $Contratistas->id_contratista }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Inducción</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->induccion));
					@endphp
					@if($hab->induccion!=null) 
					<input type="date" id="induccion" name="induccion" class="form-control" value="{{ $fecha }}">
					 @else 
					  
						<input type="date" name="induccion" id="inducion" class="form-control" value="">
					 @endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="nombre">Examen Médico</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha2=date('Y-m-d',strtotime($hab->examen_medico));
					@endphp
					@if($hab->examen_medico!=null)

					<input type="date" name="examen_medico" id="examen_medico" class="form-control" value="{{ $fecha2 }}">
					 @else 
					 
						<input type="date" name="examen_medico" id="examen_medico" class="form-control" value="">
					 @endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					@foreach ($Habilidades as $hab)

 					@if($hab->diciembre==1)
						<input type="checkbox" checked="checked" name="diciembre" class="form-check-input" id="diciembre">
					@else
						<input type="checkbox" class="form-check-input" name="diciembre" id="diciembre">
					@endif
    				@endforeach
    				<label class="form-check-label" for="diciembre">Diciembre</label>
 
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					@foreach ($Habilidades as $hab)

 					@if($hab->febrero==1)
						<input type="checkbox" name="febrero" checked="checked" class="form-check-input" id="febrero">
					@else
						<input type="checkbox" class="form-check-input" name="febrero" id="febrero">
					@endif
    				@endforeach
    				<label class="form-check-label" for="febrero">Febrero</label>
 
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					
 					@foreach ($Habilidades as $hab)

 					@if($hab->abril==1)
						<input type="checkbox" checked="checked" name="abril" class="form-check-input" id="abril">
						@else 
						<input type="checkbox"  name="abril" class="form-check-input" id="abril">
					@endif
    				@endforeach 
    				<label class="form-check-label" for="abril">Abril</label>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					@foreach ($Habilidades as $hab)

 					@if($hab->junio==1)
						<input type="checkbox" name="junio" checked="checked" class="form-check-input" id="junio">
					@else
						<input type="checkbox" name="junio" class="form-check-input" id="junio">
						@endif
    				@endforeach 
    				
    				<label class="form-check-label" for="junio">Junio</label>
 	
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					@foreach ($Habilidades as $hab)

 					@if($hab->agosto==1)
					<input type="checkbox" name="agosto" checked="checked" class="form-check-input" id="agosto">
					@else
					<input type="checkbox" name="agosto" class="form-check-input" id="agosto">
					@endif
    				@endforeach 
    				<label class="form-check-label" for="agosto">Agosto</label>
 
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="form-group">
					@foreach ($Habilidades as $hab)

 					@if($hab->octubre==1)
					<input type="checkbox" name="octubre" checked="checked" class="form-check-input" id="octubre">
					@else
					<input type="checkbox" name="octubre" class="form-check-input" id="octubre">
					@endif
    				@endforeach 
    				<label class="form-check-label" for="octubre">Octubre</label>
 
				</div>
			</div>
			</div>
		<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3>Habilidades</h3>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="alturas">Alturas</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->alturas));
					@endphp
					@if($hab->alturas!=null)
					<input type="date" name="alturas" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="alturas" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="armado_a">Armado de andamios</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->armado_a));
					@endphp
					@if($hab->armado_a!=null)
					<input type="date" name="armado_a" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="armado_a" class="form-control" value="">
					@endif
					@endforeach 

				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="plataforma_e">Plataforma Elevadora</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->plataforma_e));
					@endphp
					@if($hab->plataforma_e!=null)
						<input type="date" name="plataforma_e" class="form-control" value="{{ $fecha }}">
					 @else 
						<input type="date" name="plataforma_e" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="gruas_i">Gruas e izajes</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->gruas_i));
					@endphp
					@if($hab->gruas_i!=null)
					<input type="date" name="gruas_i" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="gruas_i" class="form-control" value="">
					@endif
					@endforeach
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="montacargas">Montacargas</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->montacargas));
					@endphp
					@if($hab->montacargas!=null)
						<input type="date" name="montacargas" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="montacargas" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="equipo_aux">Equipo Aux. de Carga</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->equipo_aux));
					@endphp
					@if($hab->equipo_aux!=null)
						<input type="date" name="equipo_aux" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="equipo_aux" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="maquinaria_p">Maquinaria Pesada</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->maquinaria_p));
					@endphp
					@if($hab->maquinaria_p!=null)
						<input type="date" name="maquinaria_p" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="maquinaria_p" class="form-control" value="">
					@endif
					@endforeach
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="e_confinados">E. Confinados</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->e_confinados));
					@endphp
					@if($hab->e_confinados!=null)
					<input type="date" name="e_confinados" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="e_confinados" class="form-control" value="">
					@endif
					@endforeach
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="t_caliente">T. Caliente</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->t_caliente));
					@endphp
					@if($hab->t_caliente!=null)
						<input type="date" name="t_caliente" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="t_caliente" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="t_electricos">T. Eléctricos</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->t_electricos));
					@endphp
					@if($hab->t_electricos!=null)
						<input type="date" name="t_electricos" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="t_electricos" class="form-control" value="">
					@endif
					@endforeach
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="loto">L.O.T.O</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->loto));
					@endphp
					@if($hab->loto!=null)
						<input type="date" name="loto" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="loto" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="apertura_I">Apertura de Líneas</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->apertura_l));
					@endphp
					@if($hab->apertura_l!=null)
						<input type="date" name="apertura_l" class="form-control" value="{{ $fecha }}">
					 @else 
						<input type="date" name="apertura_l" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="amoniaco">Amoniaco</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->amoniaco));
					@endphp
					@if($hab->amoniaco!=null)
						<input type="date" name="amoniaco" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="amoniaco" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="quimicos">Químicos</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->quimicos));
					@endphp
					@if($hab->quimicos!=null)
						<input type="date" name="quimicos" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="quimicos" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="temperatura_e">Temperaturas Elevadas</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->temperatura_e));
					@endphp
					@if($hab->temperatura_e!=null)
						<input type="date" name="temperatura_e" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="temperatura_e" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="temperatura_a">Temperaturas Abatidas</label>
					@foreach ($Habilidades as $hab) 
					@php $fecha=date('Y-m-d',strtotime($hab->temperatura_a));
					@endphp
					@if($hab->temperatura_a!=null)
						<input type="date" name="temperatura_a" class="form-control" value="{{ $fecha }}">
					@else 
						<input type="date" name="temperatura_a" class="form-control" value="">
					@endif
					@endforeach 
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<a href="/Catalogos/Cat_Contratistas" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
		</div>

		</form>
	
@endsection