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
    <h4 class="modal-title">Información del Usuario</h4>
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
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <td>Apellido</td>
                <td>{{ $user->lastName }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <td>Estado</td>
                <td>{{ $user->state->name }}</td>
              </tr>
              <tr>
                <td>Perfil</td>
                <td>{{ $user->profile->name }}</td>
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
            <img src="{{ asset('') }}/{{$user->photo }}" alt="User Image" style="height:200px;">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
