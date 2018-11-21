<input type="hidden" id="doctor_id" value="{{$doctor->id}}">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div id="tituloModalAgregar"><i class="fa fa-plus"></i> HORARIOS MÉDICO
            <div class="pull-right">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           </div>
          </div>
          <div class="panel-body" style="padding: 15px;">
              <div class="row">
                <div class="col-md-12">
                   <button type="button" id="btnAgregarHorario" class="btn btn-primary pull-left" data-count="0" style="padding:8px 50px;">
                       Agregar Horario
                   </button>
                   <button type="button" id="btnGuardar" class="btn btn-success pull-right" style="padding:8px 50px;">
                       Guardar
                   </button>
                </div>
              </div>

              <div id="contenedor">
                @if(!$doctor->schedules->isEmpty())
                  @foreach($doctor->schedules as $i => $schedule)
                  <div id="schedule-{{$i}}" class="row div-horario" data-id="{{$schedule->id}}" data-to-delete="0">
                    <hr>
                    <button type="button" class="btn btn-danger btn-xs btn-cancel-schedule" data-id="{{$i}}"><span class="fa fa-remove"></span></button>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Consultorio</label>
                        <select class="form-control select2 office" style="width: 100%;">
                          <option value="">--Selec--</option>
                          @foreach($offices as $office)
                          <option value="{{$office->id}}" @if($schedule->office_id == $office->id) selected @endif>{{$office->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Dia</label>
                        <select class="form-control select2 day" style="width: 100%;">
                          <option value="">--Selec--</option>
                          <option value="1" @if($schedule->day_of_week == "1") selected @endif >Lunes</option>
                          <option value="2" @if($schedule->day_of_week == "2") selected @endif >Martes</option>
                          <option value="3" @if($schedule->day_of_week == "3") selected @endif >Miercoles</option>
                          <option value="4" @if($schedule->day_of_week == "4") selected @endif >Jueves</option>
                          <option value="5" @if($schedule->day_of_week == "5") selected @endif >Viernes</option>
                          <option value="6" @if($schedule->day_of_week == "6") selected @endif >Sabado</option>
                          <option value="7" @if($schedule->day_of_week == "7") selected @endif >Domingo</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Hora Inicio</label>
                        <input class="form-control datepicker-justHour startHour" value="{{ $schedule->arrival_time }}" type="text"></input>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Hora Fin</label>
                        <input class="form-control datepicker-justHour endHour" value="{{ $schedule->quitting_time }} type="text"></input>
                      </div>
                    </div>
                    </hr>
                  </div>
                  @endforeach
                @endif
              </div>
              
          </div>
        </div>
    </div>
</div>
<script> 
  $(document).ready(function(){
    $('.select2').select2();
    $('.datepicker-justHour').datetimepicker({
       format: 'HH:mm' 
    });

    $('.btn-cancel-schedule').click(function(){
        $('#schedule-'+$(this).data('id')).data('to-delete','1');
        $('#schedule-'+$(this).data('id')).html("");
    });

    $('#btnAgregarHorario').data('count',{{count($doctor->schedules)}});
    /*Eventos horarios*/

    $('#btnAgregarHorario').click(function(){
      $('#contenedor').append(
                '<div id="schedule-'+$('#btnAgregarHorario').data('count')+'"class="row div-horario" data-id="" data-to-delete="0">'+
                '</div>'
        );
      $('.div-horario:last').load('{{ url("/admin/doctors/addSchedule") }}');

      $('#btnAgregarHorario').data('count',$('#btnAgregarHorario').data('count')+1);
    });

    $(document).on('click','.btnEliminarHorario',function(){
        $(this).parent().data('to-delete','1');
        $(this).parent().html('');
    });

    $('#btnGuardar').click(function(){
      var doctor_id = $('#doctor_id').val();
      var horarios = new Array();
      $('.div-horario').each(function(){
          var horario         = new Object();
          horario.id          = $(this).data('id');
          horario.isToDelete  = $(this).data('to-delete');
          horario.office      = $(this).find('.office option:selected').val() ? $(this).find('.office option:selected').val() : false;
          horario.day         = $(this).find('.day option:selected').val() ? $(this).find('.day option:selected').val() : false;
          horario.startHour   = $(this).find('.startHour').val() ? $(this).find('.startHour').val() : false;
          horario.endHour     = $(this).find('.endHour').val() ? $(this).find('.endHour').val() : false;
          horarios.push(horario);
      });


      $.ajax({
         url: 'doctors/updateSchedule',
         type:'post',
         data:{_token : $('#token').val(),
               doctor_id  : doctor_id,
               horarios   : horarios
         },
         beforeSend : function(){
            console.log(horarios);
         },
         success: function(data){
            //alert("Proceso exitoso");
            //console.log(data);
            location.reload();    
         } 
      }).fail( function() {
          alert("Fallo en proceso");
      });

    });

  });
</script>
