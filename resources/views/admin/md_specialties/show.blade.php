<div class="box box-warning">
	<div class="box-header with-border">
		<h3 class="box-title">Listado de Especialidades</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
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
              data-id="{{$specialty->id}}" class="btn btn-sm btn-success editar"
              @if(!$editar) disabled @endif>
              <i class="fa fa-pencil"></i>
            </button></td>
          <td class="text-center"><button type="button"
              data-id="{{$specialty->id}}" data-name="{{$specialty->name}}"
              class="btn btn-sm btn-danger eliminar" data-toggle="modal"
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
    $(document).on('click','.editar',function(event) {
      $id = $(this).data('id')
      $("#div-edit").html('<div class="box box-success box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $("#div-edit").load('{{ url("/admin/specialties/") }}/' + $id + '/edit');
    });
    @endif

    @if($eliminar)
    $(document).on('click',".eliminar",function(event) {
      $name = $(this).data('name')
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar la especialidad ' + $name +'?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });

    $("#confirmaDelete").on('click',function(event){
      $id = $('#confirmaDelete').data('id');
      $.ajax({
       url: '{{url("/admin/specialties")}}/'+$id,
       type:'DELETE',
       data:{_token:'{{csrf_token()}}',
       },
       success: function(data)
       { 
      	 if(data=="1"){
      			location.reload();
      	 }else{
      	    alert(data);
      	}
      }
	 });

    })
    @endif
  });
</script>
