<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Editar</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>	
	</div>
		{{ csrf_field() }} {{ method_field('PUT') }}
		<div class="box-body">
			<div class="form-group">
				<label for="name">Nombre </label> <input type="text" 
					class="form-control" name="name" value="{{ $specialty->name }}"
					required>
			</div>
		    <div class="form-group">
		    	<label>Estado</label>
		    	<select class="form-control select2" style="width: 100%;" id="editCategoria" required>
		    		<option @if($specialty->keyword_state == 1) selected @endif>Habilitado</option>
					<option @if($specialty->keyword_state == 2) selected @endif>Deshabilitado</option>
		    	</select>
		    </div>
		    <div class="box-boton" style="padding-top: 0px;">
				<button type="button" data-id="{{$specialty->id}}" id="btnEditar" class="btn btn-success"><span><i class="fa fa-edit"></i></span>Editar</button>
			</div>
		</div>
</div>
<script> $(document).ready(function(){$('.select2').select2();}) </script>
<script>
 $(document).ready(function(){
   $("#btnEditar").on('click',function(event){
   	 $(this).prop('disabled', true);
     var id = $(this).data('id');
	 var nombre = $('#editNombre').val();
	 var categoria = $('#editCategoria').val();
	 json = JSON.stringify(categoria);


	 var nombre = $('#editNombre').val();
	 var categoria = $('#editCategoria').val();
	 if(nombre=="" || categoria==null){
	 	var txt = "NO SE PUDO EDITAR EL AUTOR\n"+
	  	   		  "--------------------------------------------\n"+
	  	   		  "Falta rellenar campos\n\n"+
	  	   		  "NOTA : Complete los campos de nombre y categoria";
	  	alert(txt);
   	 	$(this).prop('disabled', false);
	 }
	 else{
	  $.ajax({
	    url: '{{url("/admin/autor")}}/'+id+'/update',
	    type:'post',
	    data:{_token:'{{csrf_token()}}',
	    name:nombre,
	    categories:json},
	    success: function(data)
	    { 
	     if(data=="1"){
	  	   $("#div-show").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
			   $("#div-show").load('{{ url("/admin/autor/actualizarLista")}}');
	      }else{
	      	alert(data);
	      }
	      $('#btnEditar').prop('disabled', false);
	    }
	   });
	 }

     
   });
 });
</script>