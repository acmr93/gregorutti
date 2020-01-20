@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Empresa - Terminos y condiciones')

@section('css')
	<!-- summernote -->
	<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('contenido')

<div class="row">
  <div class="col-12">
    <!-- Custom Tabs -->
    <div class="card">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Términos y condiciones</h3>
        <ul class="nav nav-pills p-2 d-none">
		@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			<li class="nav-item"><a class="nav-link @if($key == 'es') active @endif" href="#tab_{{ $key }} " data-toggle="tab">{{ $lang['name'] }}</a></li>
        @endforeach
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
		{!! Form::open(['method' => 'PUT', 'route' => ['info.terminos'], 'class' => 'form-horizontal']) !!}
        <div class="tab-content">
			@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
	          <div class="tab-pane @if($key == 'es') active @endif" id="tab_{{ $key }}">
		        <div class="form-group{{ $errors->has('terminos[$key]') ? ' has-error' : '' }}">
		    	    {!! Form::label('terminos['.$key.']', 'Términos y condiciones' ) !!} <!-- ('.$lang['name'].') -->
		    	    {!! Form::textarea('terminos['.$key.']', (isset($empresa) ? $empresa->getTranslation('terminos', $key) : null), ['class' => 'form-control textarea']) !!}
		    	    <small class="text-danger">{{ $errors->first('terminos['.$key.']') }}</small>
		    	</div>
	          </div>
	        @endforeach
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- ./card -->
  </div>
  <!-- /.col -->
</div>

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
</script>

@endsection