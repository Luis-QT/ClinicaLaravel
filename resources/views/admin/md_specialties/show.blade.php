
<div class="box box-warning">
	<div class="box-header with-border">
		<h3 class="box-title">Listado de Especialidades</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<br>

	<div class="box-body table-responsive">

		<table class="table table-bordered table-striped  table-hover dataTable">
			<thead>
				<tr class="text-center box-success" style="background:#E7FAE2;">
					<th class="text-center">Nombre</th>
					<th class="text-center">Estado</th>
					<th class="text-center">Editar</th>
					<th class="text-center">Eliminar</th>
				</tr>
			</thead>
      <tbody>
        @foreach($specialties as $specialty)
        <tr>
          <td>{{$specialty->name}}</td>
          <td>{{$specialty->state->name}}</td>
          <td class="text-center"><button type="button"
              data-id="{{$specialty->id}}" class="btn btn-success editar"
              @if(!$editar) disabled @endif>
              <i class="fa fa-pencil"></i>
            </button></td>
          <td class="text-center"><button type="button"
              data-id="{{$specialty->id}}" data-name="{{$specialty->name}}"
              class="btn btn-danger eliminar" data-toggle="modal"
              data-target="#delted" @if(!$eliminar) disabled @endif>
              <i class="fa fa-trash"></i>
            </button></td>
        </tr>
        @endforeach
      </tbody>
		</table>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    @if($editar)
    $(".editar").on('click',function(event) {
      $id = $(this).data('id')
      $("#div-edit").html('<div class="box box-success box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $("#div-edit").load('{{ url("/admin/specialty/") }}/' + $id + '/edit');
    });
    @endif

    @if($eliminar)
    $(".eliminar").on('click',function(event) {
      $name = $(this).data('name')
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar el editorial ' + $name +'?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });
    $("#confirmaDelete").on('click',function(event){
      $id = $('#confirmaDelete').data('id');
      $.ajax({
       url: '{{url("/admin/autor/")}}/'+$id+'/destroy',
       type:'post',
       data:{_token:'{{csrf_token()}}',
       },
       success: function(data)
       { 
      	 if(data=="1"){
			$("#div-show").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
			$("#div-show").load('{{ url("/admin/autor/actualizarLista")}}');
      	 }else{
      	    alert(data);
      	    console.log(data);
      	}
      }
	 });
    })
    @endif
  });
</script>
<script>
  $(function () {
    $(".tabla-espacialidades").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
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
          "lengthMenu" : "Mostrar _MENU_ registros por pagina",
          "zeroRecords": "No se encontraron registros",
          "info" : "Página _PAGE_ de _PAGES_",
          "infoEmpty" : "No hay registros"
      },
    });
  });
</script>