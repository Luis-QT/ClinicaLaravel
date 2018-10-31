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
				<label for="name">Nombre </label> <input type="text" id="editNombre" 
					class="form-control" name="name" value="{{ $author->name }}"
					required>
			</div>
			<?php
		      $id_1 = $id_2 = $id_3 = $id_4 =$id_5 = $id_6 = false;
		      foreach ($author->categories as $category) {
		         switch ($category->name) {
		            case 'libro':$id_1 = true;break;
		            case 'revista':$id_2 = true;break;
		            case 'tesis/tesina':$id_3 = true;break;
		            case 'compendio':$id_4 = true;break;
		            case 'colaborador':$id_5 = true;break;
		            case 'asesor':$id_6 = true;break;
		            default:
		         }
		      }
		    ?>
		    <div class="form-group">
		    	<label>Categoria</label>
		    	<select class="form-control select2" multiple="multiple" data-placeholder="Seleccione la categoria"	name="category[]" style="width: 100%;" id="editCategoria" required>
		    		@if($id_1)
		    		<option selected>libro</option> @else
					<option>libro</option>@endif @if($id_2)
					<option selected>revista</option> @else
					<option>revista</option>@endif @if($id_3)
					<option selected>tesis/tesina</option> @else
					<option>tesis/tesina</option>@endif @if($id_4)
					<option selected>compendio</option> @else
					<option>compendio</option>@endif @if($id_5)
					<option selected>colaborador</option> @else
					<option>colaborador</option>@endif @if($id_6)
					<option selected>asesor</option> @else
					<option>asesor</option>@endif
		    	</select>
		    </div>
		    <div class="box-boton" style="padding-top: 0px;">
				<button type="button" data-id="{{$author->id}}" id="btnEditar" class="btn btn-success"><span><i class="fa fa-edit"></i></span>Editar</button>
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