@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| Proyectos')

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
		      	<h3 class="card-title">Proyectos</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	
		    	<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Orden</th>
                      <th>Título</th>
                      <th>Subtexto</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if($proyectos->count() > 0)
    	              	@foreach ($proyectos as $proyecto)
							<tr>
								<td>{{$proyecto->orden}}</td>
								<td>
									@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
										{{$proyecto->getTranslation('titulo', $key)}}
									@endforeach
								</td>
								<td>
									@if ($proyecto->texto != null)
										@foreach ($proyecto->texto as $key => $value)
										<div class="col-auto">
											<img id="imagen" src="{{asset('loaded/proyectos/'.$value['img'])}}" class="control">
											{{$value['subproyecto']}}
										</div>
										@endforeach										
									@endif
									
								</td>
								<td>
									@if ($proyecto->img != null)
										@foreach ($proyecto->img as $key => $value)
											<a href="{{asset('loaded/proyectos/'.$value['nombre'])}} " target="_blank">
												<img id="imagen" src="{{asset('loaded/proyectos/'.$value['nombre'])}}" class="control">
											</a>	
										@endforeach										
									@endif
								</td>
								<td>
									{!! Form::open(['method' => 'DELETE', 'route' => ['proyectos.destroy', $proyecto->id], 'class' => 'form-horizontal']) !!}
									<a href="{{route('proyectos.form.id',$proyecto->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
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
		        <a class="btn btn-info float-right" href="{{route('proyectos.form.id')}}"><i class="fas fa-plus"></i></a>
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

