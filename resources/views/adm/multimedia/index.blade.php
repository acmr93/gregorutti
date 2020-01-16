@extends('adm.layouts.master')

@section('title', $empresa->nombre.'| '.ucfirst($seccion).' - '.ucfirst($tipo).'s')


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
		      	<h3 class="card-title">{{ucfirst($tipo)}}s en {{ucfirst($seccion)}}</h3>	    	
		    </div>
		    <!-- /.card-header -->
		    <!-- form start -->
		    <div class="card-body">
		    	
		    	<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>@if($tipo == 'slider') Orden @else Fecha de Creación @endif</th>
                      <th>Texto</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if($items->count() > 0)
    	              	@foreach ($items as $item)
	                    <tr>
	                      <td>@if($tipo == 'slider') {{$item->orden}} @else {{date('h:i a d-m-Y', strtotime($item->created_at))}} @endif</td>
	                      <td>
							@foreach (LaravelLocalization::getLocalesOrder() as $key => $lang)
								{!!$item->getTranslation('texto1', $key)!!}
					        @endforeach
	                      </td>
	                      <td>
                      		<a href="{{asset('loaded/'.$seccion.'/'.$item->nombre)}} " target="_blank">
								<img id="imagen" src="{{asset('loaded/'.$seccion.'/'.$item->nombre)}}" class="control">
							</a>
						  </td>
	                      <td>
	                      	{!! Form::open(['method' => 'DELETE', 'route' => ['file.destroy', $item->id], 'class' => 'form-horizontal']) !!}
	                      		<a href="{{route(''.$seccion.'.'.$tipo.'.id',$item->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>

	                      		<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Esta seguro de eliminar?')"><i class="fas fa-trash"></i></button>
	                      	{!! Form::close() !!}	                      	
	                      </td>
	                    </tr>                  		
	                  	@endforeach
	               	@else
						<tr>
							<td colspan="5" class="text-muted text-center">
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
<a class="btn btn-info flotante" href="{{route(''.$seccion.'.'.$tipo.'.id')}}"><i class="fas fa-plus"></i></a>

@endsection

@section('js')

<script type="text/javascript">


</script>

@endsection

