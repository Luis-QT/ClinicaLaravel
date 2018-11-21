<div class="modal-dialog ">
    <div class="modal-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div id="tituloModalAgregar"><i class="fa fa-plus"></i> EDITAR MÉDICO
            <div class="pull-right">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           </div>
          </div>
          <div class="panel-body" style="padding: 15px;">
            <form role="form" method="POST" action="{{ url('/admin/doctors') }}/{{$doctor['id']}}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put" /> {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12 text-center">
                  <img src="{{ asset('') }}/{{$doctor->photo}}" width="200px">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="{{$doctor->name}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="lastName" value="{{$doctor->lastName}}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{$doctor->email}}" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="phone"  value="{{$doctor->phone}}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Especialidad</label>
                    <select class="form-control select2" name="specialty" style="width: 100%;">
                      @foreach($specialties as $specialty)
                        <option @if($doctor->specialty_id == $specialty->id) selected @endif value="{{$specialty->id}}">{{$specialty->name}}</option>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Direccion</label>
                    <textarea class="form-control" name="address">{{$doctor->address}}</textarea> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group text-center">
                   <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                       Editar Médico
                   </button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script> $(document).ready(function(){$('.select2').select2();}) </script>
