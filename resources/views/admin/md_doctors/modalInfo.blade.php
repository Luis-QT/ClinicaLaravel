<style type="text/css">
  body{
    font-size: 15px;
  }
  .sub-title{
    font-size: 20px;
  }
</style>
<div class="modal-dialog" role="document">
  <div class="modal-content modal-user">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Información del Médico</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-7">
        <div class="box-user">
          <div class="sub-box">
            <div class="sub-title">Datos Personales</div>
            <table class="table table-striped tabla-lista-derecha">
              <tr>
                <td>Nombre</td>
                <td>{{ $doctor->name }}</td>
              </tr>
              <tr>
                <td>Apellido</td>
                <td>{{ $doctor->lastName }}</td>
              </tr>
              <tr>
                <td>Teléfono</td>
                <td>{{ $doctor->phone }}</td>
              </tr>
              <tr>
                <td>Especialidad</td>
                <td>{{ $doctor->specialty->name }}</td>
              </tr>
              <tr>
                <td>Dirección</td>
                <td>{{ $doctor->address }}</td>
              </tr>
              <tr>
                <td>Dias que atiende</td>
                <td>
                  <table class="table table-striped tabla-lista-derecha">
                    @php
                      $days = [' ','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
                      for($i = 1; $i<=7; $i++){
                        $schedules = App\Schedule::getSchedulesOfDay($i,$doctor->schedules->toArray());
                        if($schedules){
                          echo '<tr><td>'.$days[$i].'</td><td>';
                          foreach($schedules as $schedule){
                            echo $schedule['arrival_time'].'-'.$schedule['quitting_time']."\n";
                          }
                          echo '</td></tr>';
                        }
                      }
                    @endphp
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <div class="sub-box">
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box-user">
          <div class="sub-box" style="text-align: center">
            <img src="{{ asset('') }}/{{$doctor->photo }}" alt="User Image" style="height:200px;">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
