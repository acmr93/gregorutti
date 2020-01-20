@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Home - Contenido Extra')

@section('css')
	<!-- Select2 -->
	<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
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
		    <h3 class="card-title">Contenido Extra en Home Formulario</h3>	    	
	    </div>
	    <!-- /.card-header -->
	    <!-- form start -->
	    <div class="card-body">
	    	{!! Form::open(['method' => 'POST', 'route' => 'home.contenido.save', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

	    	<div class="row">
	    		<div class="col-12">
	    			<div class="form-group{{ $errors->has('destacados[]') ? ' has-error' : '' }}">
	    			    {!! Form::label('destacados[]', 'Seleccione los proyectos destacados a mostrar:') !!}
	    			    {!! Form::select('destacados[]', $proyectos, $empresa->contenido_home['destacados'], ['id' => 'destacados', 'class' => 'form-control select21', 'required' => 'required', 'multiple']) !!}
	    			    <small class="text-danger">{{ $errors->first('destacados[]') }}</small>
	    			</div>
	    		</div>
	    		<div class="col-12">
		    		<div class="form-group{{ $errors->has('servicios[]') ? ' has-error' : '' }}">
		    		    {!! Form::label('servicios[]', 'Seleccione  los servicios a mostrar:') !!}
		    		    {!! Form::select('servicios[]', $servicios, $empresa->contenido_home['servicios'], ['id' => 'servicios', 'class' => 'form-control select2', 'required' => 'required', 'multiple']) !!}
		    		    <small class="text-muted">Solo se podran seleccionar aquellos que tengan una segunda imagen como icono.</small>
		    		    <small class="text-danger">{{ $errors->first('servicios[]') }}</small>
		    		</div>
	    		</div>
	    		<div class="col-md-6 col-sm-12">
			    	<div class="form-group">
	                    <label for="exampleInputFile" class="{{$errors->has('archivo') ? 'text-danger' : ''}}" >Imagen de Fondo a mostrar en recuadro de presupuesto:</label>
	                    <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input {{$errors->has('archivo') ? 'is-invalid' : ''}}" id="exampleInputFile" name="archivo" {{($empresa->contenido_home != null?'':' required ')}}>
	                        <label class="custom-file-label" for="exampleInputFile">{{(isset($empresa) && $empresa->contenido_home != null?$empresa->contenido_home['img_presupuesto']:'Seleccione imagen')}}</label>
	                      </div>
	                    </div>
	                    <small class="text-danger">{{ $errors->first('archivo') }}</small>

	                </div>		               
                	@if(isset($empresa) && $empresa->contenido_home != null)
						<img id="imagen" src="{{asset('loaded/home/'.$empresa->contenido_home['img_presupuesto'])}}" class="control" alt="Responsive image">
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
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">

$(document).ready(function() {

	$('#destacados').select2({ placeholder: "Seleccione"});
	function formatVentajas (servicios) {
	  if (!servicios.id) {
	    return servicios.text;
	  }
	  servicios.text = servicios.titulo.es;
	  var baseUrl = "{{asset('loaded/servicios')}}";
	  var $servicios = $(
	    '<span><img src="' + baseUrl + '/' + servicios.icon[0].nombre + '"  width="5%" /> ' + servicios.titulo.es + '</span>'
	  );
	  return $servicios;
	};

	$.ajax({
	    url: ruta+"/servicios/getServicios",
	    type: 'GET',
	    dataType: 'json',
	    success: function (jsonObject){
	        $('#servicios').select2({ 
				placeholder: "Seleccione",
	        	data: jsonObject,
	        	templateResult: formatVentajas
	        });
	     }
	});


});


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

