@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| '.ucfirst($seccion).' - Contenido')

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
		      	<h3 class="card-title">Contenido en {{ucfirst($seccion)}}</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	
		    	<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Orden</th>
                      <th>Título</th>
                      <th>Texto</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if($contenido->count() > 0)
    	              	@foreach ($contenido as $contenido)
							<tr>
								<td>{{$contenido->orden}}</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$contenido->getTranslation('titulo', $key)}}
									@endforeach
								</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{ str_limit($contenido->getTranslation('texto1', $key), $limit = 60, $end = '...') }}
									@endforeach
								</td>
								<td>
									@if ($contenido->img != null)
										@foreach ($contenido->img as $key => $value)
											<a href="{{asset('loaded/contenido/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/contenido/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
								</td>
								<td>
									{!! Form::open(['method' => 'DELETE', 'route' => ['contenido.destroy', $contenido->id], 'class' => 'form-horizontal']) !!}
									<a href="{{route(''.$seccion.'.contenido.id',$contenido->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
										<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Esta seguro de eliminar?')"><i class="fas fa-trash"></i></button>
									{!! Form::close() !!}	                      	
								</td>
							</tr>                  		
	                  	@endforeach
	               	@else
						<tr>
							<td colspan=" 5" class="text-muted text-center">
								Ningún dato disponible en esta tabla
							</td>
						</tr>
                  	@endif
                  </tbody>
                </table>
			</div>
		    <!-- /.card-body -->
		  </div>
		  <!-- /.card -->			
		</div>
	</div>
<!-- /.row -->
<a class="btn btn-info flotante" href="{{route(''.$seccion.'.contenido.id')}}"><i class="fas fa-plus"></i></a>

@endsection

@section('js')

<script type="text/javascript">


</script>

@endsection

