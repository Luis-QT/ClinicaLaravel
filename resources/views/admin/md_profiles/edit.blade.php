<div class="box box-success">
	<form role="form" method="POST"
		action="{{ url('/admin/profiles') }}/{{$perfil['id']}}">
		<input type="hidden" name="_method" value="put" /> {{ csrf_field() }}
		<div class="box-header with-border">
			<h3 class="box-title">{{$perfil->name}}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool"
					data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive">
			<table class="table table-bordered tabla-perfil">
				<tr>
					<th>Función</th>
					<th>Ver</th>
					<th>Crear</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
				@foreach($matrizPerfil as $j=> $fila)
				@if($j==14)
				<tr>
					<th></th>
					<th>Ver</th>
					<th>Editar</th>
				</tr>
				@elseif($j==15)
				<tr>
					<th></th>
					<th>Ver</th>
					<th>Prestar</th>
					<th>Rechazar</th>
				</tr>
				@elseif($j==16)
				<tr>
					<th></th>
					<th>Ver</th>
					<th>Recibir</th>
					<th>Mas Tiempo</th>
				</tr>
				@elseif($j==17)
				<tr>
					<th></th>
					<th>Ver usuarios</th>
					<th>Ver castigos</th>
					<th>Castigar</th>
					<th>Detener Castigo</th>
				</tr>
				@endif
				<tr>
					<td>{{$fila[0]}}</td>
					@foreach($fila as $i => $columna)
						@if($i>0)
							<td><input type="checkbox" name="tipo{{$j}}{{$i}}" id="" value="1"
							@if($columna) checked @endif></td>
						@endif
					@endforeach
				</tr>
				@endforeach
			</table>
			<div class="box-boton">
				<button type="submit" class="btn btn-success"
				@if($perfil->id==1) disabled @endif
				><span><i class="fa fa-edit"></i></span>Guardar</button>
			</div>
		</div>
	</form>
</div>
<!-- /.box -->
