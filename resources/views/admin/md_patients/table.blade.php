<table class="table table-bordered table-hover dataTable">
                        
<thead>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Telefono</th>
    <th>Direccion</th>
    <th>E-Mail</th>
	<th>Genero</th>
    <th></th>
    <th></th>
</thead>
<tbody>
@foreach($patients as $patient)
<tr>
	<td>{{ $patient->name.' '.$patient->lastName }}</td>
	<td>
		@php
			try{
				$date 	= new DateTime($patient->birthdate); 
				$today 	= new DateTime();
				$diff 	= $date->diff($today);
				echo $diff->y." años";
			}catch(Exception $e){
				echo "Sin edad";
			}
		@endphp
	</td>
	<td>{{ $patient->phone }}</td>
	<td>{{ $patient->address }}</td>
	<td>{{ $patient->email }}</td>
	<td>{{ $patient->gender == 0 ? 'Masculino' : 'Femenino' }}</td>
	<td>
			<button type="button" data-id="{{$patient->id}}"
	                data-toggle="modal" data-target="#modalEdit"
	  							class="btn btn-success editar">
	  							<i class="fa fa-pencil"></i>
			</button>
	</td>
	<td>
	  		<button type="button" data-id="{{$patient->id}}"
	  			data-name="{{$patient->name.' '.$patient->lastName}}" class="btn btn-danger eliminar"
	  			data-toggle="modal" data-target="#modalDelete">
	  			<i class="fa fa-trash"></i>
	  		</button>
	</td>
	</tr> 
@endforeach
</tbody>
</table>

<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
</div>

<script type="text/javascript">
	$(document).ready(function(){
	  	$(document).on('click',".editar",function(event) {
      		$id = $(this).data('id');
      		$(".modalEdit").load('{{ url("/admin/patients/") }}/' + $id + '/edit');
    	});

	    $(".eliminar").on('click',function(event){
	        $("#name-delete-patient").html($(this).data("name"));

	        $urlEliminar = 'patients/'+$(this).data("id");
	        $("#form-delete").attr('action',$urlEliminar);
	    });


	});

	
</script>