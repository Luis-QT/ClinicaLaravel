<div class="modal-dialog ">
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
              <input type="hidden" id="doctor_id" value="{{$doctor->id}}">
              <button type="button" id="btnAgregarHorario" class="btn btn-success btn-sm" data-count="0"><span class="fa fa-plus">Agregar Horario</span></button>
              
              <div id="contenedor">

                <hr>
                <div class="row div-horario">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Dia</label>
                      <select class="form-control select2 day" style="width: 100%;">
                        <option value="">--Selec--</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miercoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sabado</option>
                        <option value="7">Domingo</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Hora Inicio</label>
                      <input class="form-control datepicker-justHour startHour" type="text"></input>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Hora Fin</label>
                      <input class="form-control datepicker-justHour endHour" type="text"></input>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-count="0"><span class="fa fa-remove"></span></button>

                </div>
              </div>
              <div class="row">
                <div class="form-group text-center">
                   <button type="button" id="btnGuardar" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                       Guardar
                   </button>
                </div>
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
      $('#schedule-'+$(this).data('id')).remove();
    });

    /*Eventos horarios*/

    $('#btnAgregarHorario').click(function(){
      $('#contenedor').append(
              '<hr>'+
                '<div class="row div-horario">'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label>Dia</label>'+
                      '<select class="form-control select2 day" style="width: 100%;">'+
                        '<option value="">--Selec--</option>'+
                        '<option value="1">Lunes</option>'+
                        '<option value="2">Martes</option>'+
                        '<option value="3">Miercoles</option>'+
                        '<option value="4">Jueves</option>'+
                        '<option value="5">Viernes</option>'+
                        '<option value="6">Sabado</option>'+
                        '<option value="7">Domingo</option>'+
                      '</select>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label>Hora Inicio</label>'+
                      '<input class="form-control datepicker-justHour startHour" type="text"></input>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-4">'+
                    '<div class="form-group">'+
                      '<label>Hora Fin</label>'+
                      '<input class="form-control datepicker-justHour endHour" type="text"></input>'+
                    '</div>'+
                  '</div>'+
                  '<button type="button" class="btn btn-danger btn-sm" data-count="0"><span class="fa fa-remove"></span></button>'
        );
      $('.datepicker-justHour').datetimepicker({
       format: 'HH:mm' 
      });

      $('.btn-cancel-schedule').click(function(){
        $('#schedule-'+$(this).data('id')).remove();
      });

      $('.select2').select2();

    });

    $('#btnGuardar').click(function(){

      var id = $('#doctor_id').val();

      var horarios = new Array();

       $('.div-horario').each(function(){
          var horario = new Object();
          horario.day = $(this).find('.day option:selected').val();
          horario.startHour = $(this).find('.startHour').val();
          horario.endHour = $(this).find('.endHour').val();
          horarios.push(horario);
      })

      console.log($('#token').val());

      $.ajax({
         url: 'doctors/updateSchedule',
         type:'post',
         data:{_token : $('#token').val(),
               id : id,
               horarios : horarios
         }
      }).done( function() {

        alert("Proceso exitoso");
        //location.reload();

      }).fail( function() {
          alert("Fallo en proceso");
      });

    });

  });
</script>
