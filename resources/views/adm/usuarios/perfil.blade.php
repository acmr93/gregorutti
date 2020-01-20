@extends('admin.layouts.master')

@section('title', $empresa_->nombre.' | Perfil')

@section('css')

@endsection

@section('contenido')

<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="card card-primary">
		    <div class="card-header">
		      <h3 class="card-title">Perfil</h3>
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	{!! Form::open(['method' => 'POST', 'route' => 'perfil.update', 'class' => 'form-horizontal']) !!}

		    	{!! Form::hidden('id', $user->id) !!}

		        <div class="form-group" id="field-name">
		            {!! Form::label('name', 'Nombre:') !!}
		            {!! Form::text('name', $user->name , ['id'=> 'name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => 'Nombre']) !!}
		            <small class="text-danger">{{ $errors->first('name') }}</small>
		        </div>
		        <div class="form-group" id="field-username">
		            {!! Form::label('username', 'Usuario:') !!}
		            {!! Form::text('username', $user->username , ['id'=> 'username', 'class' => $errors->has('username') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => 'Usuario:']) !!}
		            <small class="text-danger">{{ $errors->first('username') }}</small>
		        </div>
		        <div class="form-group" id="field-email">
		            {!! Form::label('email', 'Email:') !!}
		            {!! Form::email('email', $user->email , ['id'=> 'email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => 'Email']) !!}
		            <small class="text-danger">{{ $errors->first('email') }}</small>
		        </div>
		        @if ($user->rol == 'admin')
			        <div class="form-group" id="field-rol">
			            {!! Form::label('rol', 'Rol:') !!}
			            {!! Form::select('rol',['admin' => 'Administrador', 'normal' => 'Normal'], $user->rol , ['id' => 'rol', 'class' => $errors->has('rol') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => 'Seleccione']) !!}
			            <small class="text-danger">{{ $errors->first('rol') }}</small>
			        </div>		        	
		        @endif
		        <div class="form-group" id="field-password">
		            {!! Form::label('password', 'Contraseña:') !!}
		            {!! Form::password('password', ['id'=> 'password', 'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => '******']) !!}
		            <small class="text-danger">{{ $errors->first('password') }}</small>
		        </div>
		        <div class="form-group" id="field-password_confirmation">
		            {!! Form::label('password_confirmation', 'Confirmación de contraseña:') !!}
		            {!! Form::password('password_confirmation', ['id'=> 'password_confirmation', 'class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control ',  'placeholder' => '******']) !!}
		            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
		        </div>

			</div>
		    <!-- /.card-body -->

		    <div class="card-footer">
		        <button type="submit" class="btn btn-primary float-right">Guardar</button>

		        {!! Form::close() !!}
		    </div>
		  </div>
		  <!-- /.card -->			
		</div>
	</div>
<!-- /.row -->

@endsection

@section('js')

<script type="text/javascript">

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#imagen').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#exampleInputFile").change(function() {
  readURL(this);
});

</script>

@endsection

