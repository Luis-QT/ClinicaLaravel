<div class="modal fade modalAgregar" d="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div><i class="fa fa-plus"></i> AGREGAR CITA
                <div class="pull-right">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
              </div>
            </div>
            <div class="panel-body" style="padding: 15px;">
              <form role="form" method="POST" action="{{ url('/admin/meetings')}}">
              {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Fecha</label>
                      <input type="text" name="date" class="form-control datepicker-justDate" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Hora</label>
                      <input type="text" name="hour" class="form-control datepicker-justHour" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Paciente</label>
                      <select class="form-control select2" name="patient_id" style="width: 100%;" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($patients as $patient)
                          <option value="{{$patient->id}}">{{$patient->name.' '.$patient->lastName}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Médico</label>
                      <select class="form-control select2" name="doctor_id" style="width: 100%;" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($doctors as $doctor)
                          <option value="{{$doctor->id}}">{{$doctor->name.' '.$doctor->lastName}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Consultorio</label>
                      <select class="form-control select2" name="office_id" style="width: 100%;" required>
                        <option value="">-- Seleccione --</option>
                        @foreach($offices as $office)
                          @if($office->keyword_state == 1)
                            <option value="{{$office->id}}">{{$office->name}}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Observacion</label>
                      <textarea class="form-control" name="observation" required></textarea>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="keyword_state" value="3">
                <div class="row">
                  <div class="form-group text-center">
                     <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                         Agregar Cita
                     </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
</div>
<script> 
  $(document).ready(function(){$('.select2').select2();}) 

  $('.datepicker-justHour').datetimepicker({
       format: 'hh:mm' 
    });

  $('.datepicker-justDate').datetimepicker({
        format: "YYYY/MM/DD"
    });
</script>
