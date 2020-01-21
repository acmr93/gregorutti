@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Emails de la Empresa')

@section('css')

@endsection

@section('contenido')

	<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="card card-primary">
		    <!-- form start -->
		    <div class="card-body">
		    	{!! Form::open(['method' => 'PUT', 'route' => ['info.emails'], 'class' => 'form-horizontal']) !!}

		    	<H4 class="text-center mb-3 border-bottom border-top bg-gradient-primary ">Ingrese a qué mail desea redirigir los formularios que contiene el sitio.</H4>
		    	<div class="form-group">
		    	    {!! Form::label('email_contacto', 'Contacto - ') !!}
		    	    <span class="text-muted"><a href="{{route('contacto')}}">ir al Formulario</a></span>
		    	    {!! Form::text('email_contacto', (isset($emails)?$emails->email_contacto:null), ['id'=> 'email_contacto', 'class' => $errors->has('email_contacto') ? 'form-control is-invalid' : 'form-control']) !!}
		    	    <small class="text-danger">{{ $errors->first('email_contacto') }}</small>
		    	</div>
		    	<div class="form-group">
		    	    {!! Form::label('email_presupuesto', 'Presupuesto - ') !!}
		    	    <span class="text-muted"><a href="{{route('presupuesto')}}">ir al Formulario</a></span>
		    	    {!! Form::text('email_presupuesto', (isset($emails)?$emails->email_presupuesto:null), ['id'=> 'email_presupuesto', 'class' => $errors->has('email_presupuesto') ? 'form-control is-invalid' : 'form-control']) !!}
		    	    <small class="text-danger">{{ $errors->first('email_presupuesto') }}</small>
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

</script>

@endsection