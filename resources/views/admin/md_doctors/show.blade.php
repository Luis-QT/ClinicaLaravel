<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Lista de Médicos</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="clearfix div-top-table">
            <div class="pull-left">
              <a type="button" target="_blank" href="{{ url('/admin/theses/viewPDF') }}" class="btn btn-default"><i class="fa fa-eye"></i> Vista PDF</a>
              <a type="button" href="{{ url('/admin/theses/exportPDF') }}" class="btn btn-default"><i class="fa fa-file-pdf"></i> PDF</a>
              <a type="button" href="{{ url('/admin/theses/exportExcel') }}" class="btn btn-default"><i class="fas fa-file-excel"></i> EXCEL</a>
            </div>
            <div class="pull-right">
              <button data-toggle="modal" data-target=".modalAgregar" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
            </div>
        </div>
		<div class="table-responsive">
			<table class="table table-bordered table-hover  dataTable">
				<thead>
					<th>#</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Telefono</th>
          <th>Especialidad</th>
          <th>Dirección</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</thead>
				@foreach($doctors as $i => $doctor)
				<tbody>
					<td>{{ $i+1 }}</td>
					<td>{{ $doctor->name }}</td>
					<td>{{ $doctor->lastName }}</td>
          <td>{{ $doctor->email }}</td>
          <td>{{ $doctor->phone }}</td>
					<td>{{ $doctor->specialty->name }}</td>
					<td>{{ $doctor->address }}</td>
					<td><button type="button" data-id="{{$doctor->id}}"
              data-toggle="modal" data-target="#modalEdit"
							class="btn btn-success editar" @if(!$editar) disabled @endif>
							<i class="fa fa-pencil"></i>
						</button></td>
					<td><button type="button" data-id="{{$doctor->id}}"
							data-name="{{$doctor->name}}" class="btn btn-danger eliminar"
							data-toggle="modal" data-target="#delted"
							@if(!$eliminar) disabled @endif>
							<i class="fa fa-trash"></i>
						</button></td>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>

@include('admin.md_doctors.modalAdd')
@include('admin.md_doctors.modalDelete')

<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
</div>


<script type="text/javascript">
  $(document).ready(function() {
    @if($editar)
    $(".editar").on('click',function(event) {
      $id = $(this).data('id');
      $(".modalEdit").html('<div class="box box-success box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalEdit").load('{{ url("/admin/doctors/") }}/' + $id + '/edit');
    });
    @endif

    $(".eliminar").on('click',function(event) {
      $name = $(this).data('name')
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar el médico ' + $name +'?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });

    $("#confirmaDelete").on('click',function(event){
      $id = $('#confirmaDelete').data('id');

      $.ajax({
        url: '{{ url("/admin/doctors") }}/'+$id,
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
