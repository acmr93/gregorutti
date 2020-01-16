@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| Empresa - Redes Sociales')

@section('css')

@endsection

@section('contenido')

<div class="row">
	<div class="col-md-12">
	  <!-- general form elements -->
	  <div class="card card-primary">
	    <!-- form start -->
	    <div class="card-body">
	    	{!! Form::open(['method' => 'PUT', 'route' => ['info.redes'], 'class' => 'form-horizontal']) !!}

	    	<H4 class="text-center mb-3 border-bottom border-top bg-gradient-primary ">Enlaces de Redes Sociales</H4>

			<div class="row">
		    	<div class="col-12">
		   			<spam class="text-danger">{{ $errors->first('tipo') }} {{ $errors->first('enlace') }}</spam>
					<table id="redes" class=" table table-borderless">
						<tbody>
							@if ($empresa->redes_sociales != null)
								@foreach($empresa->redes_sociales as $red => $value)
									<tr>
										<td >
											{!! Form::select('tipo[]', ['facebook'=>'Facebook','instagram'=>'Instagram', 'twitter' => 'Twitter'] , $value['tipo'] , ['id' => 'tipo[]', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Seleccione']) !!}
										</td>
										<td >
			    				    		{!! Form::text('enlace[]', $value['enlace'] , ['id' => 'enlace[]','class' => 'form-control', 'required' => 'required', 'placeholder' => 'Enlace', 'onkeypress'=>'return soloNumeros(event)']) !!}
			    				    		<span class="text-muted">Contenido oculto en el HREF de los Iconos.</span>
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
								<td colspan="3" >
									<button type="button" class="btn btn-block btn-sm btn-success addsocial"><i class="fas fa-plus"></i></button>
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

	$(".addsocial").on("click", function () {
	    var newRow = $('<tr>'+
	    '<td>{!! Form::select('tipo[]', ['facebook'=>'Facebook','instagram'=>'Instagram', 'twitter' => 'Twitter'] , null , ['id' => 'tipo[]', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Seleccione']) !!}</td>'+
	    '<td>{!! Form::text('enlace[]', null , ['id' => 'enlace[]','class' => 'form-control enlace', 'required' => 'required', 'placeholder' => 'Enlace']) !!}<span class="text-muted">Contenido oculto en el HREF de los Iconos.</span></td>'+
	    '<td><button type="button" class="delphone btn btn-sm btn-danger"><i class="fas fa-minus"></i></button></td></tr>');
	    $("#redes").append(newRow);
	});

	$("#redes").on("click", ".delphone", function (event) {
	    $(this).closest("tr").remove();       
	});

</script>

@endsection