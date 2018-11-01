

<div class="box box-primary"> 
	<div class="box-header with-border">
		<h3 class="box-title">Nuevo</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	
		<div class="box-body">
      <form method="POST" id="formularioCrear" action="{{ route('offices.store') }}">
      {{ csrf_field() }}
  			<div class="form-group">
  				<label>Nombre </label> <input type="text"
  					class="form-control" name="name" id="inputNombre" placeholder=""
  					required>
  			</div>
  			<div class="form-group">
  				<label>Estado</label> 
  				<select class="form-control select2" name="state" style="width: 100%;" required>
  					<option value="1">Habilitado</option>
  					<option value="2">Deshabilitado</option>
  				</select>
  			</div>
  			<div class="box-boton" style="padding-top: 0px;">
  				<button type="submit" id="btnCrear" class="btn btn-primary"><span><i class="fa fa-paper-plane-o"></i></span>Crear</button>
  			</div>
	   </form>
    </div>
</div>

<script>
 $(document).ready(function(){
   
 });
</script>

