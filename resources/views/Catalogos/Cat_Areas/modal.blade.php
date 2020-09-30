<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$area->id_area}}">
	{{Form::Open(array('action'=>array('AreaController@destroy',$area->id_area),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Área</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar el área: {{ $area->area }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<a href="{{URL::action('AreaController@destroy',$area->id_area)}}"><button class="btn btn-info">Confirmar</button></a>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>