<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Lista de Usuarios</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="clearfix div-top-table">
            <div class="pull-left">
              <a type="button" target="_blank" href="{{ url('/admin/users/viewPDF') }}" class="btn btn-default"><i class="fa fa-eye"></i> Vista PDF</a>
              <a type="button" href="{{ url('/admin/users/exportPDF') }}" class="btn btn-default"><i class="fa fa-file-pdf"></i> PDF</a>
              <a type="button" href="{{ url('/admin/users/exportExcel') }}" class="btn btn-default"><i class="fas fa-file-excel"></i> EXCEL</a>
            </div>
            <div class="pull-right">
              <button data-toggle="modal" data-target=".modalAgregar" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
            </div>
        </div>
		<div class="table-responsive">
			<table class="table table-bordered table-hover dataTable">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Perfil</th>
					<th>Estado</th>
          <th>Visualizar</th>
          <th>Editar</th>
					<th>Eliminar</th>
				</thead>
        <tbody>
				@foreach($users as $i => $user)
          <tr>
  					<td>{{ $i+1 }}</td>
  					<td>{{ $user->name }}</td>
  					<td>{{ $user->lastName }}</td>
  					<td>{{ $user->email }}</td>
  					<td>{{ $user->profile->name }}</td>
  					<td>{{ $user->state->name }}</td>
            <td class="text-center"><button type="button" data-id="{{$user->id}}"
                data-toggle="modal" data-target="#modalInfo"
                class="btn btn-warning btn-sm visualizar">
                <i class="fa fa-eye"></i>
              </button></td>
  					<td><button type="button" data-id="{{$user->id}}"
                data-toggle="modal" data-target="#modalEdit"
  							class="btn btn-success editar" @if(!$editar) disabled @endif>
  							<i class="fa fa-pencil"></i>
  						</button></td>
  					<td><button type="button" data-id="{{$user->id}}"
  							data-name="{{$user->name}}" class="btn btn-danger eliminar"
  							data-toggle="modal" data-target="#delted"
  							@if(!$eliminar) disabled @endif>
  							<i class="fa fa-trash"></i>
  						</button></td>
  				</tr>
        @endforeach
        </tbody>
			</table>
		</div>
	</div>
</div>

@include('admin.md_users.modalAdd')
@include('admin.md_users.modalDelete')

<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
</div>

<div class="modal fade modalInfo" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
</div>


<script type="text/javascript">
  $(document).ready(function() {
    @if($editar)
    $(document).on('click',".editar",function(event) {
      $id = $(this).data('id');
      $(".modalEdit").html('<div class="box box-success box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalEdit").load('{{ url("/admin/users/") }}/' + $id + '/edit');
    });
    @endif

    $(document).on('click',".visualizar",function(event) {
      $id = $(this).data('id');
      $(".modalInfo").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Visualizar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalInfo").load('{{ url("/admin/users/") }}/' + $id + '/info');
    });

    @if($eliminar)
    $(document).on('click',".eliminar",function(event) {
      $name = $(this).data('name')
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar el usuario ' + $name +'?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });
    @endif

    $("#confirmaDelete").on('click',function(event){
      $id = $('#confirmaDelete').data('id');

      $.ajax({
        url: '{{ url("/admin/users") }}/'+$id,
        type: 'DELETE',
        data: {'_token': '{{csrf_token()}}'},
        success: function(data) {
        	console.log(data);
           if(data!="1"){
           	 alert(data);
           }else{
           	 location.reload();
           }
        }
      })
    })
  });
</script>
