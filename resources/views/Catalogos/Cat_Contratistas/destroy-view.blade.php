@extends('layouts.admin')
@section('contenido')


<div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">¿En verdad quieres eliminar a {{ $contratistas->nombre }} ?</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ action('ContratistaController@activo') }}" accept-charset="UTF-8">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Motivo</label>
                  <textarea name="motivo" class="form-control" rows="4" placeholder="Enter ..."></textarea>
                  <input type="hidden" name="idContratista" value="{{ $contratistas->id_contratista }}"></input>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <a href="/Catalogos/Cat_Contratistas" class="btn btn-primary">No</a>
                <button type="submit" class="btn btn-danger">SI</button>
              </div>
            </form>
          </div>
    </div>
</div>


@endsection
