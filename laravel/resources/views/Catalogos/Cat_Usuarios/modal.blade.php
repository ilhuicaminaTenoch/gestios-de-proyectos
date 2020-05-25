<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$usu->id}}">
	{{Form::Open(array('action'=>array('UsuarioController@destroy',$usu->id),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Usuario</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar al Usuario: {{ $usu->name }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<a href="{{URL::action('UsuarioController@destroy',$usu->id)}}"><button class="btn btn-info">Confirmar</button></a>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>