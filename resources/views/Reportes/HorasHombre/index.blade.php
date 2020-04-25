@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Reportes</h3>
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
		    {!!Form::open(array('url'=>'Reportes\HorasHombre','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
					<div class="row">
	                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                    <div class="form-group">
	                        <label for="nombre">Fecha Inicial</label>
	                        <input type="date" name="FechaInicial" id="FechaInicial" class="form-control" value="">
					 
	                    </div>
	                </div>
	                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                    <div class="form-group">
	                        <label for="nombre">Fecha Final</label>
	                        <input type="date" name="FechaFinal" id="FechaFinal" class="form-control" value="">
					 
	                    </div>
	                </div>
	                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Compañia</label>
                        <select id="tipo" name="tipo" class="form-control">

                            <option value="1">Tipo1</option>
                            <option value="2">Tipo2</option>

                        </select>
                    </div>
                </div>
                		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Generar</button>
                        <a href="/Reportes/ReporteHH" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            	</div>
             {!!Form::close()!!}
	
@endsection