<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$pro->id_proyecto}}">
	{{-- {{Form::Open(array('action'=>array('protoController@destroy',$pro->id_proyecto),'method'=>'delete'))}} --}}
	<form action="/Catalogos/Cat_Tipo_Proyecto/destroy{{ $pro->id_proyecto }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar proyecto</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar el proyecto: {{ $pro->proyecto }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

				<a href="{{URL::action('TipoProyectoController@destroy',$pro->id_proyecto)}}"><button class="btn btn-info">Confirmar</button></a>
			</div>
		</div>
	</div>
</form>
	{{-- {{Form::Close()}} --}}
</div>