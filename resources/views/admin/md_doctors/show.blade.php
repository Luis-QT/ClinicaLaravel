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
              <a type="button" target="_blank" href="{{ url('/admin/doctors/viewPDF') }}" class="btn btn-default"><i class="fa fa-eye"></i> Vista PDF</a>
              <a type="button" href="{{ url('/admin/doctors/exportPDF') }}" class="btn btn-default"><i class="fa fa-file-pdf"></i> PDF</a>
              <a type="button" href="{{ url('/admin/doctors/exportExcel') }}" class="btn btn-default"><i class="fas fa-file-excel"></i> EXCEL</a>
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
					<th>Especialidad</th>
          <th>Dias que atiende</th>
          <th>Horarios</th>
          <th>Visualizar</th>
					<th>Editar</th>
          <th>Eliminar</th>
				</thead>
        <tbody>
				@foreach($doctors as $i => $doctor)
          <tr>
  					<td>{{ $i+1 }}</td>
  					<td>{{ $doctor->name }}</td>
  					<td>{{ $doctor->lastName }}</td>
            <td>{{ $doctor->email }}</td>
            <td>{{ $doctor->specialty->name }}</td>
            <td>
              @php
                $days = [' ','Lu','Ma','Mi','Ju','Vi','Sa','Do'];
                for($i = 1; $i<=7; $i++){
                  $schedules = App\Schedule::getSchedulesOfDay($i,$doctor->schedules->toArray());
                  if($schedules){
                    echo '<span class="badge" data-toggle="tooltip" data-placement="top" data-html="true" title="';
                    foreach($schedules as $schedule){
                      echo 'De: '.$schedule['arrival_time'].' a: '.$schedule['quitting_time']."\n";
                    }
                    echo '">'.$days[$i].'</span>';
                  }
                }
              @endphp
            </td>
            <td class="text-center"><button type="button" data-id="{{$doctor->id}}"
                data-toggle="modal" data-target="#modalSchedule"
                class="btn btn-primary btn-sm horarios">
                <i class="fa fa-calendar-check-o"></i>
              </button></td>
            <td class="text-center"><button type="button" data-id="{{$doctor->id}}"
                data-toggle="modal" data-target="#modalInfo"
                class="btn btn-warning btn-sm visualizar">
                <i class="fa fa-eye"></i>
              </button></td>
  					<td class="text-center"><button type="button" data-id="{{$doctor->id}}"
                data-toggle="modal" data-target="#modalEdit"
  							class="btn btn-success btn-sm editar" @if(!$editar) disabled @endif>
  							<i class="fa fa-pencil"></i>
  						</button></td>
  					<td class="text-center"><button type="button" data-id="{{$doctor->id}}"
  							data-name="{{$doctor->name}}" class="btn btn-sm btn-danger eliminar"
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

@include('admin.md_doctors.modalAdd')
@include('admin.md_doctors.modalDelete')


<div class="modal fade modalInfo" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
</div>
<div class="modal fade modalSchedule" id="modalSchedule" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;"></div>
<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
</div>



<script type="text/javascript">
  $(document).ready(function() {
    @if($editar)
    $(document).on('click',".editar",function(event) {
      $id = $(this).data('id');
      $(".modalEdit").html('<div class="box box-success box-solid"><div class="box-header with-border"><h3 class="box-title">Editar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalEdit").load('{{ url("/admin/doctors/") }}/' + $id + '/edit');
    });
    @endif

    $(document).on('click',".visualizar",function(event) {
      $id = $(this).data('id');
      $(".modalInfo").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Visualizar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalInfo").load('{{ url("/admin/doctors/") }}/' + $id + '/info');
    });

    $(document).on('click',".horarios",function(event) {
      $id = $(this).data('id');
      $(".modalSchedule").html('<div class="box box-warning box-solid"><div class="box-header with-border"><h3 class="box-title">Visualizar</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"></div><div class="overlay"><i class="fa fa-refresh fa-spin"></i></div></div>')
      $(".modalSchedule").load('{{ url("/admin/doctors/") }}/' + $id + '/modalSchedule');
    });

    @if($eliminar)
    $(document).on('click',".eliminar",function(event) {
      $name = $(this).data('name')
      $('.modal-body').html('<p>¿Esta seguro que quiere eliminar el médico ' + $name +'?</p>');
      $('#confirmaDelete').data('id',$(this).data('id'))
    });
    @endif

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
