<div class="modal-dialog ">
    <div class="modal-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div id="tituloModalAgregar"><i class="fa fa-plus"></i> EDITAR USUARIO
            <div class="pull-right">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           </div>
          </div>
          <div class="panel-body" style="padding: 15px;">
            <form role="form" method="POST" action="{{ url('/admin/users') }}/{{$user['id']}}" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="put" /> {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12 text-center">
                  <img src="{{ asset('') }}/{{$user->photo}}" width="200px">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="lastName" value="{{$user->lastName}}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control select2" name="state" style="width: 100%;">
                      <option @if($user->keyword_state == 1) selected @endif value="1">Habilitado</option>
                      <option @if($user->keyword_state == 2) selected @endif value="2">Deshabilitado</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Perfil</label>
                    <select class="form-control select2" name="profile" style="width: 100%;">
                      @foreach($profiles as $profile)
                        <option @if($user->profile->id == $profile->id) selected @endif value="{{$profile->id}}">{{$profile->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Foto</label>
                  <input type="file" name="photo" style="color: transparent;">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="password2" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group text-center">
                   <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                       Editar Usuario
                   </button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script> $(document).ready(function(){$('.select2').select2();}) </script>