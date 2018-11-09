<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Perfil de la Empresa</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/configurations') }}/{{$configuration['id']}}" enctype="multipart/form-data">
          <input type="hidden" name="_method" value="put" /> {{ csrf_field() }}
      <div class="box-body" style="padding-top: 20px;">
        <div class="form-group">
          <label class="col-sm-2 control-label">Nombre</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{$configuration->name}}">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Número de Registro</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="registryNumber" placeholder="Número de Registro" value="{{$configuration->registryNumber}}">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="email" placeholder="Email" value="{{$configuration->email}}">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Teléfono</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" name="phone" placeholder="Teléfono" value="{{$configuration->phone}}">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Dirección</label>

          <div class="col-sm-10">
            <textarea rows="4" class="form-control" name="address" type="text">{{$configuration->address}}</textarea>
          </div>
        </div>
        
        <div class="form-group">
	        <label for="image" class="col-sm-2 control-label">Logo</label>

	        <div class="col-sm-10">
	          <input type="file" name="image" id="imagefile">
	        </div>
	     </div>
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
      </div>
      <!-- /.box-footer -->
    </form>
</div>

