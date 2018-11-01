<div class="modal fade modalDelete" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-eliminar ">
      <div class="modal-content">
      	<div class="panel panel-default">
      		<div class="panel-heading">
      			<div class="title-delete-patient">
      				¿Esta seguro que desea eliminar al paciente <strong id="name-delete-patient"></strong> ?
      			</div>
      		</div>
      		<div class="panel-body" style="padding: 15px;">
			      	<form method="POST" id="form-delete">
						{{method_field('DELETE')}}
						{{csrf_field()}}

						<button class="btn btn-danger" style="color:#FFFFFF"> Eliminar Paciente</button>				
					</form>
			</div>
		</div>
      </div>
    </div>
</div>
