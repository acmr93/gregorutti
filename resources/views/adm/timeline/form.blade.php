@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Empresa - Timeline')

@section('css')

@endsection

@section('contenido')

<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="card card-primary">
		    <div class="card-header">
		      <h3 class="card-title">Contenido de Timeline en Empresa</h3>
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	{!! Form::open(['method' => 'POST', 'route' => 'timeline.store', 'class' => 'form-horizontal', 'files' => true,'enctype'=>"multipart/form-data"]) !!}

		    	{!! Form::hidden('id', (isset($timeline)?$timeline->id:null)) !!}

		    	<div class="form-group{{ $errors->has('epoca') ? ' has-error' : '' }}">
		    	    {!! Form::label('text', 'Epoca / Año:') !!}
		    	    {!! Form::text('epoca',  (isset($timeline)?$timeline->epoca:null), ['class' => 'form-control', 'required' => 'required']) !!}
		    	    <small class="text-danger">{{ $errors->first('epoca') }}</small>
		    	</div>
		    	<div class="form-group{{ $errors->has('texto') ? ' has-error' : '' }}">
		    	    {!! Form::label('texto', 'Descripción:') !!}
		    	    {!! Form::textarea('texto', (isset($timeline)?$timeline->texto:null), ['class' => 'form-control textarea', 'required' => 'required', "rows"=>"4"]) !!}
		    	    <small class="text-danger">{{ $errors->first('texto') }}</small>
		    	</div>
			</div>
		    <!-- /.card-body -->

		    <div class="card-footer">
		        <button type="submit" class="btn btn-primary float-right">Guardar</button>

		        {!! Form::close() !!}
		    </div>
		  </div>
		  <!-- /.card -->			
		</div>
	</div>
<!-- /.row -->

@endsection

@section('js') 
<script type="text/javascript">


</script>

@endsection

