<table class="table table-bordered table-hover dataTable">
                        
<thead>
    <th>Nombre</th>
    <th>Edad</th>
    <th>Telefono</th>
    <th>Direccion</th>
    <th>E-Mail</th>
	<th>Genero</th>
    <th></th>
</thead>
@foreach($patients as $patient)
<tbody>
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
	<td>{{ $patient->genero == 0 ? 'Masculino' : 'Femenino' }}</td>
	<td>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span>
			</button>
			<ul class="dropdown-menu">
				<li>
					<a class="editPatient" data-toggle="modal" data-target="#modalEdit" 
					data-my_name="{{$patient->name}}" data-my_lastname="{{$patient->lastName}}"data-my_birthdate="{{$patient->birthdate}}" 
					data-my_phone="{{$patient->phone}}" data-my_address="{{$patient->address}}" data-my_email="{{$patient->email}}" data-my_genre="{{$patient->	genero}}" 
					data-my_id="{{$patient->id}}"><i class="fa fa-edit"></i> Editar</a>
				</li>
				<li>
					<a class="deletePatient" data-toggle="modal" data-target="#modalDelete" 
					data-my_name="{{$patient->name.' '.$patient->lastName}}" data-my_id="{{$patient->id}}"><i class="fa fa-trash"></i> Eliminar</a>
				</li>
			</ul>
		</div>
	</td>
</tbody>
@endforeach
</table>

<script type="text/javascript">
	$(document).ready(function(){
	  	$(".editPatient").on('click',function(event){
	        $("input[name='edit_name']").val($(this).data("my_name"));
	        $("input[name='edit_lastName']").val($(this).data("my_lastname"));
	        $("input[name='edit_birthdate']").val($(this).data("my_birthdate"));
	        $("input[name='edit_phone']").val($(this).data("my_phone"));
	        $("input[name='edit_address']").val($(this).data("my_address"));
	        $("input[name='edit_email']").val($(this).data("my_email"));
	        $("select[name='edit_genero']").val($(this).data("my_genre"));
	        
	        $urlEditar = 'patients/'+$(this).data("my_id");
	        $("#form-edit").attr('action',$urlEditar);

	        console.log($(this).data("my_id"));
	    });

	    $(".deletePatient").on('click',function(event){
	        $("#name-delete-patient").html($(this).data("my_name"));

	        $urlEliminar = 'patients/'+$(this).data("my_id");
	        $("#form-delete").attr('action',$urlEliminar);
	    });


	});

	$(".dataTable").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "stateSave": false, //Guarda el estado actual de la pagina
        "language" : {
            "sProcessing" : "Procesando...",
            "sLenghtMenu" : "Mostrar _MENU_ registros",
            "sZeroRecords" : "No se encontraron resultados",
            "sEmptyTable" : "Ningún dato disponible en esta tabla",
            "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered" : "(filtrado de un total de _MAX_ registros",
            "sInfoPosFix" : "",
            "sSearch" : "Buscar: ",
            "sUrl" : "" ,
            "sInfoThousands": ",",
            "sLoadingRecords" : "Cargando...",
            "oPaginate": {
                "sFirst" : "Primero",
                "sLast" : "Último",
                "sNext" : "Siguiente" ,
                "sPrevious" : "Anterior"
            },
            "oAria" : {
                "sSortAscending" : ": Actibar para ordenar la columna de manera ascendente",
                "sSordtDescending" : ": Activar para ordenar la columna de manera descendente"
            },
            "lengthMenu" : "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron registros",
            "info" : "Página _PAGE_ de _PAGES_",
            "infoEmpty" : "No hay registros"
        },
    });
</script>