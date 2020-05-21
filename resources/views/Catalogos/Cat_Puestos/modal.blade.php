<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$pues->id_puesto}}">
	{{-- {{Form::Open(array('action'=>array('PuestoController@destroy',$pues->id_puesto),'method'=>'delete'))}} --}}
	<form action="/Catalogos/Cat_Puestos/destroy{{ $pues->id_puesto }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Puesto</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar el puesto: {{ $pues->puesto }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

				<a href="{{URL::action('PuestoController@destroy',$pues->id_puesto)}}"><button class="btn btn-info">Confirmar</button></a>
			</div>
		</div>
	</div>
</form>
	{{-- {{Form::Close()}} --}}
</div>