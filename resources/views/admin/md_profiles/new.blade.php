<form class="form-horizontal" method="POST" id="formularioCrear" action="{{ url('/admin/profiles') }}">
	{{ csrf_field() }}
	<div class="input-group margin">
		<input type="text" class="form-control" id="name" name="name"> <span
			class="input-group-btn">
			<button type="button" id="btnCrear" class="btn btn-primary btn-flat">Crear</button>
		</span>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnCrear').on('click',function(){
			var name = $('#name').val();
			if(name==""){
				alert('Faltan rellenar campos en el formulario:\n- Nombre');
			}else{
				$.ajax({
				  url: '{{url("/admin/profiles/verificarCrear")}}',
		          type:'post',
		          data: $('#formularioCrear').serialize(),
		          success: function(data)
		          {	
		          	//Si data es 1 se creo , si es otro valor se realizo con exito
		          	if(data=="1"){
		          		$('#formularioCrear').submit();
		          	}else{
		          		alert(data);
		          	}
		          }
				});
			}
		});
	});
</script>sw