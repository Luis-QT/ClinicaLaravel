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
                <form method="POST" action="{{ route('doctors.store') }}">
                {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="lastName" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="phone" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Especialidad</label>
                        <select class="form-control select2" name="specialty" style="width: 100%;">
                          @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Direccion</label>
                        <textarea class="form-control" name="address"></textarea> 
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