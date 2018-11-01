<div class="box box-success">

	<div class="box-header with-border">
		<h3 class="box-title">Editar</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>	
	</div>
		<form role="form" method="POST"
		action="{{ url('/admin/specialties') }}/{{$specialty['id']}}">
			<input type="hidden" name="_method" value="put" /> {{ csrf_field() }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Nombre </label> <input type="text" 
						class="form-control" name="name" value="{{ $specialty->name }}"
						required>
				</div>
			    <div class="form-group">
			    	<label>Estado</label>
			    	<select class="form-control select2" name="state" style="width: 100%;" required>
			    		<option @if($specialty->keyword_state == 1) selected @endif value="1">Habilitado</option>
						<option @if($specialty->keyword_state == 2) selected @endif value="2">Deshabilitado</option>
			    	</select>
			    </div>
			    <div class="box-boton" style="padding-top: 0px;">
					<button type="submit" class="btn btn-success"><span><i class="fa fa-edit"></i></span>Editar</button>
				</div>
			</div>
		</form>
</div>
<script> $(document).ready(function(){$('.select2').select2();}) </script>
