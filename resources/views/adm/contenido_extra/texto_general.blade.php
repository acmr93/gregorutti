@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Texto en Secciones')

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
	    <div class="card-header">
		    <h3 class="card-title">Texto en Secciones</h3>	    	
	    </div>
	    <!-- /.card-header -->
	    <!-- form start -->
	    <div class="card-body">
	    	{!! Form::open(['method' => 'POST', 'route' => 'texto.save', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

	    	<div class="row">
	    		<div class="col-6">
		    		<div class="form-group">
		    		    {!! Form::label('servicios', 'Texto en Servicios:') !!}
		    		    {!! Form::textarea('servicios', $empresa->texto_secciones['servicios'], ['id'=> 'servicios', 'class' => $errors->has('servicios') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'rows'=>3]) !!}
		    		    <small class="text-danger">{{ $errors->first('servicios') }}</small>
		    		</div>
	    		</div>
	    		<div class="col-6">
		    		<div class="form-group">
		    		    {!! Form::label('productos', 'Texto en Productos:') !!}
		    		    {!! Form::textarea('productos', $empresa->texto_secciones['productos'], ['id'=> 'productos', 'class' => $errors->has('productos') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'rows'=>3]) !!}
		    		    <small class="text-danger">{{ $errors->first('productos') }}</small>
		    		</div>
	    		</div>
	    		<div class="col-6">
		    		<div class="form-group">
		    		    {!! Form::label('clientes', 'Texto en Clientes:') !!}
		    		    {!! Form::textarea('clientes', $empresa->texto_secciones['clientes'], ['id'=> 'clientes', 'class' => $errors->has('clientes') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'rows'=>3]) !!}
		    		    <small class="text-danger">{{ $errors->first('clientes') }}</small>
		    		</div>
	    		</div>
	    		<div class="col-6">
		    		<div class="form-group">
		    		    {!! Form::label('contacto', 'Texto en Contacto:') !!}
		    		    {!! Form::textarea('contacto', $empresa->texto_secciones['contacto'], ['id'=> 'contacto', 'class' => $errors->has('contacto') ? 'form-control is-invalid' : 'form-control', 'required' => 'required', 'rows'=>3]) !!}
		    		    <small class="text-danger">{{ $errors->first('contacto') }}</small>
		    		</div>
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

