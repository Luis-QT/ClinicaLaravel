<div class="modal-dialog ">
    <div class="modal-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div><i class="fa fa-plus"></i> EDITAR CITA
              <div class="pull-right">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
            </div>
          </div>
          <div class="panel-body" style="padding: 15px;">
            <form role="form" method="POST" action="{{ url('/admin/meetings') }}/{{$meeting->id}}">
            <input type="hidden" name="_method" value="put" />
            {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Fecha</label>
                    <input type="text" name="date" value="{{$meeting->date}}" class="form-control datepicker-justDate" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Hora</label>
                    <input type="text" name="hour" value="{{$meeting->hour}}" class="form-control datepicker-justHour" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Paciente</label>
                    <input type="text" value="{{$meeting->patient->name.' '.$meeting->patient->lastName}}" class="form-control" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Médico</label>
                    <select class="form-control select2" name="doctor_id" style="width: 100%;" required>
                      @foreach($doctors as $doctor)
                        <option @if($meeting->doctor_id == $doctor->id) selected @endif value="{{$doctor->id}}">{{$doctor->name.' '.$doctor->lastName}}</option>
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
                      @foreach($offices as $office)
                        @if($office->keyword_state == 1)
                          <option @if($meeting->office_id == $office->id) selected @endif value="{{$office->id}}">{{$office->name}}</option>
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
                    <textarea class="form-control" name="observation" required>{{$meeting->observation}}</textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Estado de la cita</label>
                    <select class="form-control select2" name="keyword_state" style="width: 100%;" required>
                      @foreach($keywords as $keyword)
                          <option @if($meeting->keyword_state == $keyword->id) selected @endif value = "{{$keyword->id}}">
                            {{$keyword->name}}
                          </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group text-center">
                   <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                       Editar Cita
                   </button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script> 
  $(document).ready(function(){$('.select2').select2();}) 

  $('.datepicker-justHour').datetimepicker({
       format: 'HH:mm' 
    });

  $('.datepicker-justDate').datetimepicker({
        format: "YYYY/MM/DD"
    });
</script>
