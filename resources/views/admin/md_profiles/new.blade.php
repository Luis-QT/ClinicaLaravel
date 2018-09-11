<form class="form-horizontal" method="POST" id="formularioCrear" action="{{ route('profiles.store') }}">
	{{ csrf_field() }}
	<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}" style="padding: 10px 15px;">
		<div class="input-group">
			<input type="text" class="form-control" id="name" name="name"> <span
				class="input-group-btn">
				<button type="submit" class="btn btn-primary btn-flat">Crear</button>
			</span>
		</div>
		@if($errors->has('name'))
			<div class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</div>
		@endif
	</div>
</form>
