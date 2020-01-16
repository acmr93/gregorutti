<div class="modal fade" id="modal-user" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario de Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['id'=>'form-user']) !!}
        {!! Form::hidden('id', null, ['id'=>'id']) !!}

        <div class="form-group" id="field-name">
            {!! Form::label('name', 'Nombre:') !!}
            {!! Form::text('name', null, ['id'=> 'name', 'class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Nombre']) !!}
            <small class="text-danger"></small>
        </div>
        <div class="form-group" id="field-username">
            {!! Form::label('username', 'Nombre de usuario:') !!}
            {!! Form::text('username', null, ['id'=> 'username', 'class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Nombre']) !!}
            <small class="text-danger"></small>
        </div>
        <div class="form-group" id="field-email">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['id'=> 'email', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email']) !!}
            <small class="text-danger"></small>
        </div>
        <div class="form-group" id="field-rol">
            {!! Form::label('rol', 'Rol:') !!}
            {!! Form::select('rol',['admin' => 'Administrador', 'normal' => 'Normal'], null, ['id' => 'rol', 'class' => 'form-control ', 'required' => 'required', 'placeholder' => 'Seleccione']) !!}
            <small class="text-danger"></small>
        </div>
        <div class="form-group" id="field-password">
            {!! Form::label('password', 'Contraseña:') !!}
            {!! Form::password('password', ['id'=> 'password', 'class' => 'form-control', 'required' => 'required', 'placeholder' => '******']) !!}
            <small class="text-danger"></small>
        </div>
        <div class="form-group" id="field-password_confirmation">
            {!! Form::label('password_confirmation', 'Confirmación de contraseña:') !!}
            {!! Form::password('password_confirmation', ['id'=> 'password_confirmation', 'class' => 'form-control', 'required' => 'required', 'placeholder' => '******']) !!}
            <small class="text-danger"></small>
        </div>

      {!! Form::close() !!}
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>