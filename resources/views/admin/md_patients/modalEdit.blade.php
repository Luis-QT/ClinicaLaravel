<div class="modal fade modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
      <form method="POST" id="form-edit">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="modal-content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div id="tituloModalAgregar"><i class="fa fa-plus"></i> Editar Paciente
                <div class="pull-right">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
               </div>
              </div>
              <div class="panel-body" style="padding: 15px;">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" name="edit_name" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Apellido</label>
                      <input type="text" name="edit_lastName" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Fecha de nacimiento</label>
                      <input type="text" name="edit_birthdate" class="form-control datepicker" required  maxlength="10">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Telefono</label>
                      <input type="text" name="edit_phone" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" name="edit_address" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="edit_email" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sexo</label>
                      <br>
                      <select class="form-control" name="edit_gender" required>
                        <option value="">Seleccione</option>
                        <option value='0'>Masculino</option>
                        <option value='1'>Femenino</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group text-center">
                     <button type="submit" class="btn btn-primary" style="padding:8px 50px;margin-top:25px;">
                         Editar paciente
                     </button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </form>
    </div>
</div>
