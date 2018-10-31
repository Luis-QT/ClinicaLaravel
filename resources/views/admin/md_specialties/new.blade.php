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
			<div class="form-group">
				<label>Nombre </label> <input type="text"
					class="form-control" name="name" id="inputNombre" placeholder=""
					required>
			</div>
			<div class="form-group">
				<label>Estadp</label> 
				<select class="form-control select2" style="width: 100%;" required>
					<option value="1">Habilitado</option>
					<option value="2">Deshabilitado</option>
				</select>
			</div>
			<div class="box-boton" style="padding-top: 0px;">
				<button type="button" id="btnCrear" class="btn btn-primary"><span><i class="fa fa-user"></i></span>Crear</button>
			</div>
		</div>
</div>

<script>
 $(document).ready(function(){
   $("#btnCrear").on('click',function(event){
   	 $(this).prop('disabled', true);
	 var nombre = $('#inputNombre').val();
	 var categoria = $('#categoria').val();
	 if(nombre=="" || categoria==null){
	 	var txt = "NO SE PUDO CREAR EL AUTOR\n"+
	  	   		  "--------------------------------------------\n"+
	  	   		  "Falta rellenar campos\n\n"+
	  	   		  "NOTA : Complete los campos de nombre y categoria";
	  	alert(txt);
	  	$("#btnCrear").prop('disabled', false);
	 }
	 else{
 	  json = JSON.stringify(categoria);
      $.ajax({
        url: '{{url("/admin/autor/store")}}',
        type:'post',
        data:{_token:'{{csrf_token()}}',
        name:nombre,
        categories:json},
        success: function(data)
        { 
      	 if(data=="0"){
      	   var txt = "NO SE PUDO CREAR EL AUTOR\n"+
      	   			 "--------------------------------------------\n"+
      	   			 "El nombre ingresado ya existe\n\n"+
      	   			 "NOTA : Debe usar otro nombre de autor";
      	   alert(txt);
      	 }else{
      	    $("#div-show").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
			$("#div-show").load('{{ url("/admin/autor/actualizarLista")}}');
      	 }
		$("#btnCrear").prop('disabled', false);
       }
	  });
	 }
   });
 });
</script>

