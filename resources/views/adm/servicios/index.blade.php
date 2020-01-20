@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | Servicios')

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
		      	<h3 class="card-title">Servicios</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	
		    	<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Orden</th>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Imagenes</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if($servicios->count() > 0)
    	              	@foreach ($servicios as $servicio)
							<tr>
								<td>{{$servicio->orden}}</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$servicio->getTranslation('titulo', $key)}}
									@endforeach
								</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$servicio->getTranslation('texto', $key)}}
									@endforeach
								</td>
								<td>
									@if ($servicio->img != null)
										@foreach ($servicio->img as $key => $value)
											<a href="{{asset('loaded/servicios/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
									@if ($servicio->icon != null)
										@foreach ($servicio->icon as $key => $value)
											<a href="{{asset('loaded/servicios/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/servicios/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
								</td>
								<td>
									{!! Form::open(['method' => 'DELETE', 'route' => ['servicios.destroy', $servicio->id], 'class' => 'form-horizontal']) !!}
									<a href="{{route('servicios.form.id',$servicio->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
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
		    <div class="card-footer">
		        <a class="btn btn-info float-right" href="{{route('servicios.form.id')}}"><i class="fas fa-plus"></i></a>
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

