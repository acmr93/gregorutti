@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion).' - '.ucfirst($tipo).'s')

@section('css')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">

<style type="text/css">
.control {
    max-width:100%;
    max-height: 150px;
}
</style>
@endsection

@section('contenido')

<div class="row">
	<div class="col-md-12">
	  <!-- general form elements -->
	  <div class="card card-primary">
	    <div class="card-header">
		    <h3 class="card-title">{{ucfirst($tipo)}}s en {{ucfirst($seccion)}} Formulario</h3>	    	
	    </div>
	    <!-- /.card-header -->
	    <!-- form start -->
	    <div class="card-body">
	    	{!! Form::open(['method' => 'POST', 'route' => 'file.store', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

	    	{!! Form::hidden('seccion', (isset($item)?$item->seccion:$seccion)) !!}
	    	{!! Form::hidden('tipo', (isset($item)?$item->tipo:$tipo)) !!}
	    	
	    	{!! Form::hidden('id', (isset($item)?$item->id:null)) !!}

	    	<div class="row">
	    		<div class="col-md-6 col-sm-12">
	    			@if($tipo == 'slider')
				    	<div class="form-group{{ $errors->has('orden') ? ' has-error' : '' }}">
				    	    {!! Form::label('text', 'Orden:') !!}
				    	    {!! Form::text('orden',  (isset($item)?$item->orden:null), ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <small class="text-danger">{{ $errors->first('orden') }}</small>
				    	</div>
			    	@endif
				    @foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			        	<div class="form-group{{ $errors->has('texto1[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('texto1['.$key.']', 'Texto :') !!} {{-- ('.$lang['name'].') --}}
				    	    @if($seccion != 'galeria')
				    	    {!! Form::textarea('texto1['.$key.']', (isset($item) ? $item->getTranslation('texto1', $key) : null) , ['class' => 'form-control textarea', 'rows' => 3]) !!}
				    	    @else
				    	    {!! Form::text('texto1['.$key.']', (isset($item) ? $item->getTranslation('texto1', $key) : null) , ['class' => 'form-control']) !!}
				    	    @endif
				    	    <small class="text-danger">{{ $errors->first('texto1['.$key.']') }}</small>
				    	</div>
			        @endforeach
	    		</div>
	    		<div class="col-md-6 col-sm-12">
			    	<div class="form-group">
	                    <label for="exampleInputFile" class="{{$errors->has('archivo') ? 'text-danger' : ''}}" >Archivo</label>
	                    <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input {{$errors->has('archivo') ? 'is-invalid' : ''}}" id="exampleInputFile" name="archivo" {{(isset($item)?'':' required ')}}>
	                        <label class="custom-file-label" for="exampleInputFile">{{(isset($item)?$item->nombre:'Seleccione imagen')}}</label>
	                      </div>
	                    </div>
	                    <small class="text-danger">{{ $errors->first('archivo') }}</small>

	                </div>		               
                	@if(isset($item) && $item->nombre != null)

					<a href="{{asset('loaded/'.$seccion.'/'.$item->nombre)}} " target="_blank">
						<img id="imagen" src="{{asset('loaded/'.$seccion.'/'.$item->nombre)}}" class="control" alt="Responsive image">
					</a>
						
					@else
						<img id="imagen" src="{{asset('images/thumbnails/1366x652.png')}}" class="control" alt="Responsive image">
					@endif
	             		
	    		</div>
	    	</div>
		</div>
	    <!-- /.card-body -->
	  </div>
	  <!-- /.card -->			
	</div>
</div>
<!-- /.row -->
<button type="submit" class="btn btn-success flotante"><i class="fas fa-save"></i></button>
{!! Form::close() !!}

@endsection

@section('js') 
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('plugins/summernote/lang/summernote-es-ES.min.js')}}"></script>

<script type="text/javascript">
// Summernote
	$('.textarea').summernote({
		lang: 'es-ES',
		  toolbar: [
		    // [groupName, [list of button]]
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough', 'superscript', 'subscript']],
		    ['color', ['forecolor']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['insert', ['link', 'table', 'hr']],
		    ['view', [ 'codeview','undo', 'redo']],
		  ]
	})

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

