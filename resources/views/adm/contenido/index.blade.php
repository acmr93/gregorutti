@extends('adm.layouts.master')

@section('title', $empresa_->nombre.' | '.ucfirst($seccion).' - Contenido')

@section('css')
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
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
		    	@if ($seccion == 'productos')
		      	<h3 class="card-title">{{ucfirst($seccion)}}</h3>	    	
		    	@else
		      	<h3 class="card-title">Contenido en {{ucfirst($seccion)}}</h3>	    	
		    	@endif
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
								@if ($seccion == 'productos')
									<a href="{{route('productos.show',$contenido->id)}}" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
								@else
									<a href="{{route(''.$seccion.'.contenido.id',$contenido->id)}}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
								@endif
									<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('¿Esta seguro de eliminar?')"><i class="fas fa-trash"></i></button>
									{!! Form::close() !!}	                      	
								</td>
							</tr>                  		
	                  	@endforeach
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

<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript">

$(".table").DataTable({
  processing: true,
  order: [[ 0, "desc" ]],
  scrollY:  "500px",
  scrollCollapse: true,
  language: leng,
  "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
  "columnDefs": [
    { "orderable": false, "targets": [3,4] }
  ]
});

</script>

@endsection

