<table class="table table-bordered table-hover">
	<tr>
		<th>#</th>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Paciente</th>
		<th>Medico</th>
		<th>Consultorio</th>
		<th>Estado</th>
	</tr>
	@foreach($meetings as $i => $meeting)
	<tr>
		<td>{{ $i + 1 }}</td>
		<td>{{ $meeting->date }}</td>
		<td>{{ $meeting->hour }}</td>
		<td>{{ $meeting->patient->name.' '.$meeting->patient->lastName }}</td>
		<td>{{ $meeting->doctor->name.' '.$meeting->doctor->lastName }}</td>
		<td>{{ $meeting->office->name}}</td>
		<td>
			@if($meeting->keyword_state == 1)
				<span class="label label-warning">Asignado</span>
			@else
				<span class="label label-success">Atendido</span>
			@endif
		</td>
	</tr>
	@endforeach
</table>

<script type="text/javascript">
  $(document).ready(function() {
    
  });
</script>
