@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Datos de la Empresa')

@section('css')
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
	    <!-- form start -->
	    <div class="card-body">
	    	{!! Form::open(['method' => 'PUT', 'route' => ['info.general'], 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

	    	<H4 class="text-center mb-3 border-bottom border-top bg-gradient-primary ">Logotipos & Favicon</H4>
	    	<small class="text-danger">{{ $errors->first('archivo.*') }}</small>
    		<div class="row">
    			<div class="col-md-4">
    				<div class="form-group">
    				    @if(isset($header))
							<a href="{{asset('images/logos/'.$header->nombre)}} " target="_blank">
								<img src="{{asset('images/logos/'.$header->nombre)}}" class="control header_file" alt="Responsive image">
							</a>
						@else
							<img src="#" class="control header_file" alt="Responsive image">
						@endif
						</br>
						{!! Form::hidden('tipo_file[]', 'header') !!}
    				    {!! Form::label('archivo[]', 'Logo Header', ['class' => 'mt-2']) !!}
    				    {!! Form::file('archivo[]', ['id'=>'header_file', 'class' => 'archivo']) !!}
    				    <small class="text-danger">{{ $errors->first('archivo[]') }}</small>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="form-group">
    					@if(isset($footer))
							<a href="{{asset('images/logos/'.$footer->nombre)}} " target="_blank">
								<img src="{{asset('images/logos/'.$footer->nombre)}}" class="control footer_file" alt="Responsive image">
							</a>
						@else
							<img src="#" class="control footer_file" alt="Responsive image">
						@endif
						</br>
						{!! Form::hidden('tipo_file[]', 'footer') !!}
    				    {!! Form::label('archivo[]', 'Logo Footer', ['class' => 'mt-2']) !!}
    				    {!! Form::file('archivo[]', ['id'=>'footer_file', 'class' => 'archivo']) !!}
    				    <small class="text-danger">{{ $errors->first('archivo[]') }}</small>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="form-group">
    					@if(isset($favicon))
							<a href="{{asset('images/logos/'.$favicon->nombre)}} " target="_blank">
								<img src="{{asset('images/logos/'.$favicon->nombre)}}" class="control favicon" alt="Responsive image">
							</a>
						@else
							<img src="#" class="control favicon" alt="Responsive image">
						@endif
						</br>
						{!! Form::hidden('tipo_file[]', 'favicon') !!}
    				    {!! Form::label('archivo[]', 'Favicon', ['class' => 'mt-2']) !!}
    				    {!! Form::file('archivo[]', ['id'=>'favicon', 'class' => 'archivo']) !!}
    				    <small class="text-danger">{{ $errors->first('archivo[]') }}</small>
    				</div>
    			</div>
    		</div>
	    	<H4 class="text-center mb-3 border-bottom border-top bg-gradient-primary ">Domicilio</H4>

	    	<div class="row">
				<div class="col-md-8">
					<div class="form-group">
			    	    {!! Form::label('calle', 'Calle') !!}
			    	    {!! Form::text('calle', (isset($empresa)?$empresa->domicilio[0]['calle']:null), ['id'=> 'calle', 'class' => $errors->has('calle') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('calle') }}</small>
			    	</div>
				</div>		    	
				<div class="col-md-4">
					<div class="form-group">
			    	    {!! Form::label('altura', 'Altura') !!}
			    	    {!! Form::text('altura', (isset($empresa)?$empresa->domicilio[0]['altura']:null), ['id'=> 'altura', 'class' => $errors->has('altura') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('altura') }}</small>
			    	</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
			    	    {!! Form::label('codigo', 'Código Postal') !!}
			    	    {!! Form::text('codigo', (isset($empresa)?$empresa->domicilio[0]['codigo']:null), ['id'=> 'codigo', 'class' => $errors->has('codigo') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('codigo') }}</small>
			    	</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
			    	    {!! Form::label('pais', 'País') !!}
			    	    {!! Form::text('pais', (isset($empresa)?$empresa->domicilio[0]['pais']:null), ['id'=> 'pais', 'class' => $errors->has('pais') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('pais') }}</small>
			    	</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
			    	    {!! Form::label('provincia', 'Provincia') !!}
			    	    {!! Form::text('provincia', (isset($empresa)?$empresa->domicilio[0]['provincia']:null), ['id'=> 'provincia', 'class' => $errors->has('provincia') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('provincia') }}</small>
			    	</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
			    	    {!! Form::label('localidad', 'Localidad') !!}
			    	    {!! Form::text('localidad', (isset($empresa)?$empresa->domicilio[0]['localidad']:null), ['id'=> 'localidad', 'class' => $errors->has('localidad') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('localidad') }}</small>
			    	</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
			    	    {!! Form::label('detalles', 'Detalles') !!}
			    	    {!! Form::text('detalles', (isset($empresa)?$empresa->domicilio[0]['detalles']:null), ['id'=> 'detalles', 'class' => $errors->has('detalles') ? 'form-control is-invalid' : 'form-control']) !!}
			    	    <small class="text-danger">{{ $errors->first('detalles') }}</small>
			    	</div>
				</div>
	    	</div>
	    	<H4 class="text-center mb-3 border-bottom border-top bg-gradient-primary ">Enlaces de Ubicación</H4>
	    	<div class="form-group">
	    	    {!! Form::label('ubicacion_maps', 'Ubicación de Google Maps:') !!}
	    	    {!! Form::text('ubicacion_maps', (isset($empresa)?$empresa->ubicacion_maps:null), ['id'=> 'ubicacion_maps', 'class' => $errors->has('ubicacion_maps') ? 'form-control is-invalid' : 'form-control']) !!}
	    	    <small class="text-danger">{{ $errors->first('ubicacion_maps') }}</small>
	    	</div>
	    	<div class="form-group">
	    	    {!! Form::label('enlance_maps', 'Enlace de Google Maps:') !!}
	    	    {!! Form::text('enlance_maps', (isset($empresa)?$empresa->enlance_maps:null), ['id'=> 'enlance_maps', 'class' => $errors->has('enlance_maps') ? 'form-control is-invalid' : 'form-control']) !!}
	    	    <small class="text-danger">{{ $errors->first('enlance_maps') }}</small>
	    	</div>

			<div class="row">
		    	<div class="col-12">
		    		<h6 class="{{$errors->has('tipo_telf') ||  $errors->has('num_hide') || $errors->has('num_show') ? 'text-danger' : ''}}">Telefonos:</h6>
		   			<spam class="text-danger">{{ $errors->first('tipo_telf') }} {{ $errors->first('num_hide') }} {{ $errors->first('num_hide') }}</spam>
					<table id="telefonos" class=" table table-borderless">
						<tbody>
							@if ($empresa->telefonos != null)
								@foreach($empresa->telefonos as $telefono => $value)
									<tr>
										<td >
											{!! Form::select('tipo_telf[]', ['telefono'=>'Teléfono','whatsapp'=>'Whatsapp'] , $value['tipo'] , ['id' => 'tipo_telf[]', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Seleccione']) !!}
										</td>
										<td >
			    				    		{!! Form::text('num_hide[]', $value['numero'] , ['id' => 'num_hide[]','class' => 'form-control', 'required' => 'required', 'placeholder' => 'Número', 'onkeypress'=>'return soloNumeros(event)']) !!}
			    				    		<span class="text-muted">Contenido oculto en el HREF. Solo números</span>
										</td>
										<td >
			    				    		{!! Form::text('num_show[]', $value['visible'] , ['id' => 'num_show[]','class' => 'form-control', 'placeholder' => 'Elemento Visible']) !!}
			    				    		<span class="text-muted">Contenido visible. En caso de permanecer vacío, se utilizará el primer campo.</span>
										</td>
										<td >
			    				    		<div class="form-check">
			    				    		  {!! Form::hidden('tel_clickeable[]', $value['clickeable']) !!}				    				    		  
					                          <input class="form-check-input" type="checkbox"  value="" onchange="checking(this)" {{ $value['clickeable'] > 0 ? 'checked' : ''}}>
					                          <label class="form-check-label">¿Es clickeable?</label>
					                        </div>
										</td>
										<td>
											<button type="button" class="delphone btn btn-sm btn-danger"><i class="fas fa-minus"></i></button>
										</td>
									</tr>	
								@endforeach									
							@endif
						</tbody>
						<tfoot>
							<tr>
								<td colspan="5" >
									<button type="button" class="btn btn-block btn-sm btn-success addphone"><i class="fas fa-plus"></i></button>
								</td>
							</tr>
						</tfoot>
					</table>
		    	</div>
		    	<div class="col-12">
		    		<h6 class="{{$errors->has('email') ? 'text-danger' : ''}}">Emails:</h6>
		   			<spam class="text-danger">{{ $errors->first('email') }}</spam>
					<table id="emails" class=" table table-borderless">
						<tbody>
							@if ($empresa->emails != null)
								@foreach($empresa->emails as $email)
									<tr>
										<td >
											{!! Form::email('email[]', $email, ['id' => 'email[]','class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email']) !!}
										</td>
										<td class="text-center">
											<button type="button" class="delemail btn btn-sm btn-danger"><i class="fas fa-minus"></i></button>
										</td>
									</tr>	
								@endforeach
							@endif
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" >
									<button type="button" class="btn btn-block btn-sm btn-success addemail"><i class="fas fa-plus"></i></button>
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

	$(".addphone").on("click", function () {
	    var newRow = $('<tr>'+
	    '<td>{!! Form::select('tipo_telf[]', ['telefono'=>'Teléfono','whatsapp'=>'Whatsapp'] , null , ['id' => 'tipo_telf[]', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Seleccione']) !!}</td>'+
	    '<td>{!! Form::text('num_hide[]', null , ['id' => 'num_hide[]','class' => 'form-control num_hide', 'required' => 'required', 'placeholder' => 'Número', 'onkeypress'=>'return soloNumeros(event)']) !!}<span class="text-muted">Contenido oculto en el HREF. Solo números</span></td>'+
	    '<td>{!! Form::text('num_show[]', null , ['id' => 'num_show[]','class' => 'form-control', 'placeholder' => 'Elemento Visible']) !!}<span class="text-muted">Contenido visible. En caso de permanecer vacío, se utilizará el primer campo.</span></td>'+
	    '<td><div class="form-check">{!! Form::hidden('tel_clickeable[]', 0) !!}<input class="form-check-input" onchange="checking(this)" type="checkbox" value=""><label class="form-check-label">¿Es clickeable?</label></div></td><td><button type="button" class="delphone btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td></tr>');
	    $("#telefonos").append(newRow);
	});

	$("#telefonos").on("click", ".delphone", function (event) {
	    $(this).closest("tr").remove();       
	});

	$(".addemail").on("click", function () {
	    var newRow = $('<tr>'+
	    '<td>{!! Form::email('email[]', null, ['id' => 'email[]','class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email']) !!}</td>'+
	    '<td class="text-center"><button type="button" class="delemail btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td></tr>');
	    $("#emails").append(newRow);
	});

	$("#emails").on("click", ".delemail", function (event) {
	    $(this).closest("tr").remove();       
	});

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
  readURL(this);
});


function checking(check) {
 	if ($(check).closest('div').find('input[type=hidden]:first').val() == 1)
 		$(check).closest('div').find('input[type=hidden]:first').val(0);
 	else 
 		$(check).closest('div').find('input[type=hidden]:first').val(1);
}

function soloNumeros(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = "1234567890";
	especiales = "8-37-39-46";

	tecla_especial = false
	for(var i in especiales){
		if(key == especiales[i]){
			tecla_especial = true;
			break;
		}
	}

	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}

</script>

@endsection