<div class="modal fade" id="modal-cliente" data-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario de Familia de Productos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['id'=>'form-cliente', 'files' => true,'enctype'=>"multipart/form-data"]) !!}
        {!! Form::hidden('id', null, ['id'=>'id']) !!}
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group" id="field-orden">
                {!! Form::label('orden', 'Orden:') !!}
                {!! Form::text('orden', null, ['id'=> 'orden', 'class' => 'form-control ', 'required' => 'required']) !!}
                <small id="error-orden" class="text-danger"></small>
            </div>

            <div class="form-group" id="field-url">
                {!! Form::label('url', 'URL del cliente:') !!}
                {!! Form::text('url', null, ['id'=> 'url', 'class' => 'form-control ', 'required' => 'required']) !!}
                <small id="error-url" class="text-danger"></small>
            </div>
            @foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
            <div class="form-group" id="field-nombre.{{$key}}">
              {!! Form::label('nombre['.$key.']', 'Nombre:') !!}
              {!! Form::text('nombre['.$key.']', null, ['id'=>'nombre.'.$key, 'class' => 'form-control', 'required' => 'required']) !!}
              <small id="error-nombre.{{$key}}" class="text-danger"></small>
            </div>             
            @endforeach            
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="file_cliente">Imagen para el cliente</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input " id="file_cliente" name="file_cliente">
                    <label class="custom-file-label" for="file_cliente"></label>
                  </div>
                </div>
            </div>  
            <small id="error-file_cliente" class="text-danger"></small></br>
            <img id="img_cliente" src="{{asset('images/thumbnails/366x442.png')}}" class="control" alt="Responsive image">
          </div>
        </div>              
      {!! Form::close() !!}
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardar_cliente">Guardar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>