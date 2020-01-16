<div class="modal fade" id="modal-metadato" data-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario de Metadato</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['id'=>'form-metadato']) !!}
        {!! Form::hidden('id', null, ['id'=>'id']) !!}
          <div > </div>
          @foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="form-group" id="field-keywords.{{$key}}">
                    {!! Form::label('keywords['.$key.']', 'Palabras ('.$lang['name'].')') !!}
                    {!! Form::textarea('keywords['.$key.']', null, ['id'=>'keywords.'.$key, 'class' => 'form-control', 'required' => 'required', 'rows'=>2]) !!}
                    <small id="error-keywords.{{$key}}" class="text-danger"></small>
                  </div>                  
                </div>
                <div class="col-12 col-md-6" id="field-description.{{$key}}">
                  <div class="form-group">
                    {!! Form::label('description['.$key.']', 'Descripción ('.$lang['name'].')') !!}
                    {!! Form::textarea('description['.$key.']', null, ['id'=>'description.'.$key, 'class' => 'form-control', 'required' => 'required', 'rows'=>2]) !!}
                    <small id="error-description.{{$key}}" class="text-danger"></small>
                  </div>
                </div>
              </div>              
          @endforeach

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