@extends('layouts.graficas')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-text-width"></i>

                <h3 class="box-title">Datos Generales</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt>Contratistas Totales:</dt>
                    <dd>{{ $head[0]->CONTRATISTAS }}</dd>
                    <dt>Compañia Totales:</dt>
                    <dd>{{ $head[0]->EMPRESA }}</dd>
                </dl>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!--<a class="btn btn-info" href="{{ route('download', ['fechaInicial' => $params['fechaInicial']]) }}">
                    <i class="fa fa-file-pdf-o"></i> Exportar a PDF
                </a>-->
                    <a class="btn btn-info" href="#" onclick="javascript:window.print()">
                        <i class="fa fa-file-pdf-o"></i> Exportar a PDF
                    </a>
            </div>
            <!-- box-footer -->

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Distribución Por Tipo De Compañía</h3>


            </div>
            <div class="box-body" id="pieChart">
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Distribución Por Areas</h3>
            </div>
            <div class="box-body" id="columArea"></div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Distribución Por Compañía</h3>
            </div>
            <div class="box-body" id="columnChart"></div>
            <!-- /.box-body -->
            <div class="box-footer">
               <br/><br/><br/><br/><br/>
            </div><!-- box-footer -->
        </div>
    </div>
</div>
@endsection
