@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| Proyectos')

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
		      	<h3 class="card-title">Proyectos Formulario</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	{!! Form::open(['method' => 'POST', 'route' => 'proyectos.store', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

		    	{!! Form::hidden('id', (isset($proyecto)?$proyecto->id:null)) !!}

		    	<div class="row">
		    		<div class="col-md-6 col-sm-12">
			    		<div class="form-group{{ $errors->has('orden') ? ' has-error' : '' }}">
				    	    {!! Form::label('text', 'Orden:') !!}
				    	    {!! Form::text('orden',  (isset($proyecto)?$proyecto->orden:null), ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <strong class="text-danger">{{ $errors->first('orden') }}</strong>
				    	</div>
						@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			          	<div class="form-group{{ $errors->has('titulo[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('titulo['.$key.']', 'Titulo:') !!}
				    	    {!! Form::text('titulo['.$key.']', (isset($proyecto) ? $proyecto->getTranslation('titulo', $key) : null) , ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <strong class="text-danger">{{ $errors->first('titulo.'.$key) }}</strong>
				    	</div>
				        @endforeach
		    		</div>
		    		<div class="col-md-6 col-sm-12">
				    	<div class="form-group">
		                    <label for="exampleInputFile" class="{{$errors->has('archivo') ? 'text-danger' : ''}}">Imagen para el proyecto</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" class="custom-file-input {{$errors->has('archivo') ? 'is-invalid' : ''}}" id="exampleInputFile" name="archivo[]" {{(isset($proyecto)?'':'required')}}>
		                        <label class="custom-file-label" for="exampleInputFile">{{(isset($proyecto)?$proyecto->img[0]['nombre']:'Seleccione imagen')}}</label>
		                      </div>
		                    </div>
		                </div>	
		                <strong id="error-exampleInputFile" class="text-danger">{{ $errors->first('archivo') }}</strong></br>

	                	@if(isset($proyecto) && $proyecto->img != null)
							@foreach ($proyecto->img as $key => $value)
								<img id="images" src="{{asset('loaded/proyectos/'.$value['nombre'])}}" class="control exampleInputFile">
							@endforeach
						@else
							<img id="images" src="{{asset('images/thumbnails/85x85.png')}}" class="control exampleInputFile">
						@endif
		                		    		
		    		</div>
		    	</div>
				<div class="row">
			    	<div class="col-12">
			    		<h6 class="{{$errors->has('sub_proyecto') ||  $errors->has('file_subproyecto')? 'text-danger' : ''}}">Subproyectos:</h6>
			   			<spam class="text-danger">{{ $errors->first('sub_proyecto') }} {{ $errors->first('file_subproyecto') }} </spam>
						<table id="subproyectos" class=" table table-borderless">
							<tbody>
								@if ( isset($proyecto) && $proyecto->texto != null)
									@php $count = 0; @endphp
									@foreach($proyecto->texto as $subproyecto => $value)
										@php $count++; @endphp
										<tr>
											{!! Form::hidden('id_sub[]', $value['id']) !!}
											<td  class="align-middle">
				    				    		{!! Form::textarea('sub_proyecto[]', $value['subproyecto'] , ['id' => 'sub_proyecto[]','class' => 'form-control', 'placeholder' => 'Subproyectos:', 'rows' => 2]) !!}
											</td>
											<td  class="align-middle">
						    				    {!! Form::textarea('texto_old[]',  $value['texto'] , ['id' => 'texto_old[]','class' => 'form-control', 'placeholder' => 'Texto', 'required' => 'required', 'rows' => 2]) !!}
											</td>
											<td>
												{!! Form::file('file_subproyecto[]', ['id'=>'file_'.$count, 'class' => 'archivo-old']) !!}
						    				    <strong id="error-file_{{$count}}" class="text-danger"></strong>
												<img src="{{asset('loaded/proyectos/'.$value['img'])}}" class="control file_{{$count}}">
											</td>
											<td class="align-middle">
												<button type="button" class="del btn btn-sm btn-danger"><i class="fas fa-minus"></i></button>
											</td>
										</tr>	
									@endforeach									
								@endif
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4" >
										<button type="button" class="btn btn-block btn-sm btn-success add"><i class="fas fa-plus"></i></button>
									</td>
								</tr>
							</tfoot>
						</table>
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
		var file_count = 0;
	$(".add").on("click", function () {
		file_count++;
	    var newRow = $('<tr>'+
	    '<td class="align-middle">{!! Form::textarea('sub_new[]', null , ['id' => 'sub_new[]','class' => 'form-control', 'placeholder' => 'Subproyecto', 'required' => 'required', 'rows' => 2]) !!}</td>'+
	    '<td class="align-middle">{!! Form::textarea('texto_new[]', null , ['id' => 'texto_new[]','class' => 'form-control', 'placeholder' => 'Texto', 'required' => 'required', 'rows' => 2]) !!}</td>'+
	    '<td><input id="new_file'+file_count+'" class="archivo " required name="file_subnew[]" type="file"><strong id="error-new_file'+file_count+'" class="text-danger"></strong><img src="{{asset('images/thumbnails/85x85.png')}}" class="control new_file'+file_count+'"></td>'+
	    '<td class="align-middle"><button type="button" class="del btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td></tr>');
	    $("#subproyectos").append(newRow);
	    	function readURL(input) {
			  if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    reader.onload = function(e) {
			      $('.'+input.id).attr('src', e.target.result);
			    }
			    reader.readAsDataURL(input.files[0]);
			  }
			}
			$(".archivo").change(function() {
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
	});

	$("#subproyectos").on("click", ".del", function (event) {
	    $(this).closest("tr").remove();       
	});

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

	$(".archivo-old").change(function() {
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

