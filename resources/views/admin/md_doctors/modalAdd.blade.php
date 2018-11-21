<div class="modal fade modalAgregar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div id="tituloModalAgregar"><i class="fa fa-plus"></i> AGREGAR MÉDICO
                <div class="pull-right">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
               </div>
              </div>
              <div class="panel-body" style="padding: 15px;">
                <form method="POST" action="{{ route('doctors.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="lastName" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="phone" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Especialidad</label>
                        <select class="form-control select2" name="specialty" style="width: 100%;" required>
                          @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Horario</label>
                        <button type="button" class="add-schedule" data-count="0"><span class="fa fa-plus"></span></button>
                        <div class="container-schedules"></div>
                        <input type="text" name="schedules" class="form-control days-of-week" pattern="(1\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(2\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(3\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(4\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(5\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(6\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?(7\s((([01][0-9])|(2[0-3])):[0-5][0-9]-(([01][0-9])|(2[0-3])):[0-5][0-9]\s)+;)?" required />
                        <!-- Ejm: 1 09:00-20:00 ;2 13:00-22:00 15:22-19:00 ;-->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="photo" style="color: transparent;">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Direccion</label>
                        <textarea class="form-control" name="address" required></textarea> 
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="form-group text-center">
                       <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                           Agregar Médico
                       </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
<!--
<script src="{{URL::asset('plugins/dayofweekselector/dayofweekselector.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::asset('plugins/dayofweekselector/dayofweekselector.css')}}">

<script> 
  $('.range-hour').daterangepicker({
      autoUpdateInput: false,
      timePicker: true,
      timePicker24Hour: true,
      locale: {
          cancelLabel: 'Clear',
          format: 'HH:mm'
      }
    });

    $('.range-hour').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('HH:mm') + ' - ' + picker.endDate.format('HH:mm'));
      
      $dates = $(this).val().split(' - ');
      var params = {
            'from_date'   : $dates[0],
            'to_date'     : $dates[1]
      }
    });
</script>
-->
<script type="text/javascript">
  $('.add-schedule').click(function(){
      $select      = "<div class='form-group'><select class='form-control' style='width: 100%;'><option value=''>--Selec--</option><option value='1'>Lunes</option><option value='2'>Martes</option><option value='3'>Miercoles</option><option value='4'>Jueves</option><option value='5'>Viernes</option><option value='6'>Sabado</option><option value='7'>Domingo</option></select></div>";
      $arrivingHour = "<div class='form-group'><input class='form-control datepicker-justHour' type='text'></input></div>";
      $quitingHour  = "<div class='form-group'><input class='form-control datepicker-justHour' type='text'></input></div>";
      $buttonConfirm = "<button type='button' class='btn-confirm-schedule'><span class='fa fa-check'></span></button>";
      $buttonCancel = "<button type='button' class='btn-cancel-schedule'><span class='fa fa-window-close'></span></button>";

    $('.container-schedules').append("<div id='schedule-"+$(this).data('count')+"'>"+$select+$arrivingHour+$quitingHour+$buttonConfirm+"<button type='button' class='btn-cancel-schedule' data-id='"+$(this).data('count')+"'><span class='fa fa-window-close'></span></button></div>");
    
    $(this).data('count',$(this).data('count')+1);

    $('.datepicker-justHour').datetimepicker({
       format: 'HH:mm' 
    });

    $('.btn-cancel-schedule').click(function(){
      $('#schedule-'+$(this).data('id')).remove();
    });
  });
</script>