@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Servicios')

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
		      	<h3 class="card-title">Servicios Formulario</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	{!! Form::open(['method' => 'POST', 'route' => 'servicios.store', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

		    	{!! Form::hidden('id', (isset($servicio)?$servicio->id:null)) !!}

		    	<div class="row">
		    		<div class="col-md-6 col-sm-12">
			    		<div class="form-group{{ $errors->has('orden') ? ' has-error' : '' }}">
				    	    {!! Form::label('text', 'Orden:') !!}
				    	    {!! Form::text('orden',  (isset($servicio)?$servicio->orden:null), ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <strong class="text-danger">{{ $errors->first('orden') }}</strong>
				    	</div>
		    		</div>
		    		<div class="col-md-6 col-sm-12">
		    			@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			          	<div class="form-group{{ $errors->has('titulo[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('titulo['.$key.']', 'Titulo:') !!}
				    	    {!! Form::text('titulo['.$key.']', (isset($servicio) ? $servicio->getTranslation('titulo', $key) : null) , ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <strong class="text-danger">{{ $errors->first('titulo['.$key.']') }}</strong>
				    	</div>
				        @endforeach
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-12">
		    			@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			          	<div class="form-group{{ $errors->has('texto[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('texto['.$key.']', 'Descripción:') !!}
				    	    {!! Form::textarea('texto['.$key.']', (isset($servicio) ? $servicio->getTranslation('texto', $key) : null) , ['class' => 'form-control', 'required' => 'required', 'rows' => 3]) !!}
				    	    <strong class="text-danger">{{ $errors->first('texto['.$key.']') }}</strong>
				    	</div>
				        @endforeach
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-12 col-md-6">
		    			<div class="form-group">
		                    <label for="exampleInputFile" class="{{$errors->has('imagen') ? 'text-danger' : ''}}">Imagen para el servicio</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" class="custom-file-input {{$errors->has('imagen') ? 'is-invalid' : ''}}" id="exampleInputFile" name="imagen[]" {{(isset($servicio)?'':'required')}}>
		                        <label class="custom-file-label" for="exampleInputFile">{{(isset($servicio)?$servicio->img[0]['nombre']:'Seleccione imagen')}}</label>
		                      </div>
		                    </div>
		                </div>	
	                    <small class="text-muted">Dimensiones recomendadas para diseño 367x440</small>  
		                <strong id="error-exampleInputFile" class="text-danger">{{ $errors->first('imagen') }}</strong></br>

	                	@if(isset($servicio) && $servicio->img != null)
							@foreach ($servicio->img as $key => $value)
								<img id="images" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control exampleInputFile">
							@endforeach
						@else
							<img id="imagen" src="{{asset('images/thumbnails/thumbnail.png')}}" class="control" alt="Responsive image">
						@endif
		    		</div>
		    		<div class="col-12 col-md-6">
		    			<div class="form-group">
		                    <label for="iconofile" class="{{$errors->has('icono') ? 'text-danger' : ''}}">Icono para el servicio</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" class="custom-file-input {{$errors->has('icono') ? 'is-invalid' : ''}}" id="iconofile" name="icono[]" >
		                        <label class="custom-file-label" for="iconofile">{{(isset($servicio)?$servicio->icon[0]['nombre']:'Seleccione imagen')}}</label>
		                      </div>
		                    </div>
		                </div>	
	                    <small class="text-muted">Dimensiones recomendadas para diseño 100x100</small>  
		                <strong id="error-iconofile" class="text-danger">{{ $errors->first('icono') }}</strong></br>

	                	@if(isset($servicio) && $servicio->icon != null)
							@foreach ($servicio->icon as $key => $value)
								<img id="images" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control iconofile">
							@endforeach
						@else
							<img id="imagen" src="{{asset('images/thumbnails/thumbnail.png')}}" class="control" alt="Responsive image">
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

<script type="text/javascript">

	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('#images').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#exampleInputFile").change(function() {
		var imgPath = this.value;
		var id = this.id;
		var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		if (ext == "png" || ext == "jpg" || ext == "jpeg"){
			document.getElementById('error-'+id).innerHTML = ''
			readURL(this);
			$('.flotante').attr('disabled', false);
		}
		else{
			$('.flotante').attr('disabled', 'disabled');
			document.getElementById('error-'+id).innerHTML = 'Por favor seleccione una imagen (jpg, jpeg, png).'
		}
	});

	function leerURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('.'+input.id).attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#iconofile").change(function() {
		var imgPath = this.value;
		var id = this.id;
		var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		if (ext == "png" || ext == "jpg" || ext == "jpeg"){
			document.getElementById('error-'+id).innerHTML = ''
			leerURL(this);
			$('.flotante').attr('disabled', false);
		}
		else{
			$('.flotante').attr('disabled', 'disabled');
			document.getElementById('error-'+id).innerHTML = 'Por favor seleccione una imagen (jpg, jpeg, png).'
		}
	});

</script>

@endsection

