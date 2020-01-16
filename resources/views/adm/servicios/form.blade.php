@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| Servicios')

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
						@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
			          	<div class="form-group{{ $errors->has('titulo[$key]') ? ' has-error' : '' }}">
				    	    {!! Form::label('titulo['.$key.']', 'Titulo:') !!}
				    	    {!! Form::text('titulo['.$key.']', (isset($servicio) ? $servicio->getTranslation('titulo', $key) : null) , ['class' => 'form-control', 'required' => 'required']) !!}
				    	    <strong class="text-danger">{{ $errors->first('titulo['.$key.']') }}</strong>
				    	</div>
				        @endforeach
		    		</div>
		    		<div class="col-md-6 col-sm-12">
				    	<div class="form-group">
		                    <label for="exampleInputFile" class="{{$errors->has('archivo') ? 'text-danger' : ''}}">Imagen para el servicio</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" class="custom-file-input {{$errors->has('archivo') ? 'is-invalid' : ''}}" id="exampleInputFile" name="archivo[]" {{(isset($servicio)?'':'required')}}>
		                        <label class="custom-file-label" for="exampleInputFile">{{(isset($servicio)?$servicio->img[0]['nombre']:'Seleccione imagen')}}</label>
		                      </div>
		                    </div>
		                </div>	
		                <strong id="error-exampleInputFile" class="text-danger">{{ $errors->first('archivo') }}</strong></br>

	                	@if(isset($servicio) && $servicio->img != null)
							@foreach ($servicio->img as $key => $value)
								<img id="images" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control exampleInputFile">
							@endforeach
						@else
							<img id="images" src="{{asset('images/thumbnails/1128x898.png')}}" class="control exampleInputFile">
						@endif
		                		    		
		    		</div>
		    	</div>
				<div class="row">
			    	<div class="col-12">
			    		<h6 class="{{$errors->has('sub_servicio') ||  $errors->has('file_subservicio')? 'text-danger' : ''}}">Subservicios:</h6>
			   			<spam class="text-danger">{{ $errors->first('sub_servicio') }} {{ $errors->first('file_subservicio') }} </spam>
						<table id="subservicios" class=" table table-borderless">
							<tbody>
								@if ( isset($servicio) && $servicio->texto != null)
									@php $count = 0; @endphp
									@foreach($servicio->texto as $subservicio => $value)
										@php $count++; @endphp
										<tr>
											{!! Form::hidden('id_sub[]', $value['id']) !!}
											<td  class="align-middle" width="50%">
				    				    		{!! Form::text('sub_servicio[]', $value['subservicio'] , ['id' => 'sub_servicio[]','class' => 'form-control', 'placeholder' => 'Subservicios:']) !!}
											</td>
											<td  class="align-middle">
						    				    {!! Form::file('file_subservicio[]', ['id'=>'file_'.$count, 'class' => 'archivo-old']) !!}
						    				    <strong id="error-file_{{$count}}" class="text-danger"></strong>
											</td>
											<td>
												<img src="{{asset('loaded/servicios/'.$value['img'])}}" class="control file_{{$count}}">
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
	    '<td class="align-middle" width="50%">{!! Form::text('sub_new[]', null , ['id' => 'sub_new[]','class' => 'form-control', 'placeholder' => 'Subservicio', 'required' => 'required']) !!}</td>'+
	    '<td class="align-middle"><input id="new_file'+file_count+'" class="archivo " required name="file_subnew[]" type="file"><strong id="error-new_file'+file_count+'" class="text-danger"></strong></td>'+
	    '<td><img src="{{asset('images/thumbnails/1128x898.png')}}" class="control new_file'+file_count+'"></td>'+
	    '<td class="align-middle"><button type="button" class="del btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td></tr>');
	    $("#subservicios").append(newRow);
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

	$("#subservicios").on("click", ".del", function (event) {
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

