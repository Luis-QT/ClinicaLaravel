<hr>
<button type="button" class="btn btn-danger btn-xs btnEliminarHorario" data-count="0"><span class="fa fa-remove"></span></button>
  <div class="col-md-3">
    <div class="form-group">
      <label>Consultorio</label>
      <select class="form-control select2 office" style="width: 100%;">
        <option value="">--Selec--</option>
        @foreach($offices as $office)
        <option value="{{$office->id}}">{{$office->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-3">
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
  <div class="col-md-3">
    <div class="form-group">
     <label>Hora Inicio</label>
      <input class="form-control datepicker-justHour startHour" type="text"></input>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label>Hora Fin</label>
      <input class="form-control datepicker-justHour endHour" type="text"></input>
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
  });
</script>