<table class="table table-bordered table-hover">
	<tr>
		<th>#</th>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Paciente</th>
		<th>Medico</th>
		<th>Consultorio</th>
		<th>Estado</th>
		<th>Editar</th>
		<th>Eliminar</th>
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
			@elseif($meeting->keyword_state == 2)
				<span class="label label-success">Atendido</span>
			@else
				<span class="label label-success">{{$meeting->keyword->name}}</span>
			@endif
		</td>
		<td>
			<button type="button" data-id="{{$meeting->id}}"
	                data-toggle="modal" data-target="#modalEdit"
	  							class="btn btn-success editar">
	  							<i class="fa fa-pencil"></i>
			</button>
		</td>
		<td>
	  		<button type="button" data-id="{{$meeting->id}}"
	  			data-name="{{$meeting->patient->name.' '.$meeting->patient->lastName}}" class="btn btn-danger eliminar"
	  			data-date="{{$meeting->date.' '.$meeting->hour}}"
	  			data-toggle="modal" data-target="#delted">
	  			<i class="fa fa-trash"></i>
	  		</button>
	  	</td>
	</tr>
	@endforeach
</table>

<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
</div>

<script type="text/javascript">
  $(document).ready(function() {
  	$(document).on('click',".editar",function(event) {
      $id = $(this).data('id');
      $(".modalEdit").load('{{ url("/admin/meetings/") }}/' + $id + '/edit');
    });
    
    $(document).on('click',".eliminar",function(event) {
      $name = $(this).data('name');
      $date = $(this).data('date');
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar la cita del paciente <strong>' + $name +'</strong> del dia <strong>'+$date+'</strong> ?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });

    $("#confirmaDelete").on('click',function(event){
      $id = $('#confirmaDelete').data('id');

      $.ajax({
        url: '{{ url("/admin/meetings") }}/'+$id,
        type: 'DELETE',
        data: {'_token': '{{csrf_token()}}'},
        success: function(data) {
        	location.reload();
        }
      })
    })
  });
</script>
